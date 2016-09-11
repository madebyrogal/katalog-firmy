<?php
/**
 * Akeeba Engine
 * The modular PHP5 site backup engine
 *
 * @copyright Copyright (c)2006-2015 Nicholas K. Dionysopoulos
 * @license   GNU GPL version 3 or, at your option, any later version
 * @package   akeebaengine
 *
 */

namespace Akeeba\Engine\Archiver;

// Protection against direct access
defined('AKEEBAENGINE') or die();

use Psr\Log\LogLevel;
use Akeeba\Engine\Factory;

/**
 * Direct Transfer Over SFTP archiver class
 *
 * Transfers the files to a remote SFTP server instead of putting them in
 * an archive
 *
 */
class Directsftp extends Base
{
	/** @var resource SFTP resource handle */
	private $_sftphandle = false;

	/** @var resource SSH2 connection resource handle */
	private $_connection = false;

	/** @var string SFTP hostname */
	private $_host;

	/** @var string SFTP port */
	private $_port;

	/** @var string SFTP username */
	private $_user;

	/** @var string SFTP password */
	private $_pass;

	/** @var string Private key file */
	private $_privkey;

	/** @var string Private key file */
	private $_pubkey;

	/** @var string FTP initial directory */
	private $_initdir;

	/** @var string Current remote directory, including the remote directory string */
	private $_currentdir;

	/** @var bool Could we connect to the server? */
	public $connect_ok = false;

	/**
	 * Initialises the archiver class, seeding the remote installation
	 * from an existent installer's JPA archive.
	 *
	 * @param string $sourceJPAPath     Absolute path to an installer's JPA archive
	 * @param string $targetArchivePath Absolute path to the generated archive (ignored in this class)
	 * @param array  $options           A named key array of options (optional)
	 *
	 * @return  void
	 */
	public function initialize($targetArchivePath, $options = array())
	{
		Factory::getLog()->log(LogLevel::DEBUG, __CLASS__ . " :: new instance");

		$registry = Factory::getConfiguration();

		$this->_host    = $registry->get('engine.archiver.directsftp.host', '');
		$this->_port    = $registry->get('engine.archiver.directsftp.port', '22');
		$this->_user    = $registry->get('engine.archiver.directsftp.user', '');
		$this->_pass    = $registry->get('engine.archiver.directsftp.pass', '');
		$this->_privkey = $registry->get('engine.archiver.directsftp.privkey', '');
		$this->_pubkey  = $registry->get('engine.archiver.directsftp.pubkey', '');
		$this->_initdir = $registry->get('engine.archiver.directsftp.initial_directory', '');

		if (isset($options['host']))
		{
			$this->_host = $options['host'];
		}

		if (isset($options['port']))
		{
			$this->_port = $options['port'];
		}

		if (isset($options['user']))
		{
			$this->_user = $options['user'];
		}

		if (isset($options['pass']))
		{
			$this->_pass = $options['pass'];
		}

		if (isset($options['privkey']))
		{
			$this->_privkey = $options['privkey'];
		}

		if (isset($options['pubkey']))
		{
			$this->_pubkey = $options['pubkey'];
		}

		if (isset($options['initdir']))
		{
			$this->_initdir = $options['initdir'];
		}

		// You can't fix stupid, but at least you get to shout at them
		if (strtolower(substr($this->_host, 0, 7)) == 'sftp://')
		{
			Factory::getLog()->log(LogLevel::WARNING, 'YOU ARE *** N O T *** SUPPOSED TO ENTER THE sftp:// PROTOCOL PREFIX IN THE FTP HOSTNAME FIELD OF THE DirectSFTP ARCHIVER ENGINE.');
			Factory::getLog()->log(LogLevel::WARNING, 'I am trying to fix your bad configuration setting, but the backup might fail anyway. You MUST fix this in your configuration.');

			$this->_host = substr($this->_host, 7);
		}

		$this->connect_ok = $this->_connectSFTP();

		Factory::getLog()->log(LogLevel::DEBUG, __CLASS__ . " :: SFTP connection status: " . ($this->connect_ok ? 'success' : 'FAIL'));
	}

	/**
	 * Returns a string with the extension (including the dot) of the files produced
	 * by this class.
	 *
	 * @return string
	 */
	public function getExtension()
	{
		return '';
	}


	/**
	 * The most basic file transaction: add a single entry (file or directory) to
	 * the archive.
	 *
	 * @param bool   $isVirtual        If true, the next parameter contains file data instead of a file name
	 * @param string $sourceNameOrData Absolute file name to read data from or the file data itself is $isVirtual is
	 *                                 true
	 * @param string $targetName       The (relative) file name under which to store the file in the archive
	 *
	 * @return boolean True on success, false otherwise
	 */
	protected function _addFile($isVirtual, &$sourceNameOrData, $targetName)
	{
		// Are we connected to a server?
		if ( !is_resource($this->_sftphandle))
		{
			if ( !$this->_connectSFTP())
			{
				return false;
			}
		}

		// See if it's a directory
		$isDir = $isVirtual ? false : is_dir($sourceNameOrData);

		if ($isDir)
		{
			// Just try to create the remote directory
			return $this->_makeDirectory($targetName);
		}
		else
		{
			// We have a file we need to upload
			if ($isVirtual)
			{
				// Create a temporary file, upload, rename it
				$tempFileName = Factory::getTempFiles()->createRegisterTempFile();

				if (function_exists('file_put_contents'))
				{
					// Easy writing using file_put_contents
					if (@file_put_contents($tempFileName, $sourceNameOrData) === false)
					{
						$this->setError('Could not store virtual file ' . $targetName . ' to ' . $tempFileName . ' using file_put_contents() before uploading.');

						return false;
					}
				}
				else
				{
					// The long way, using fopen() and fwrite()
					$fp = @fopen($tempFileName, 'wb');

					if ($fp === false)
					{
						$this->setError('Could not store virtual file ' . $targetName . ' to ' . $tempFileName . ' using fopen() before uploading.');

						return false;
					}
					else
					{
						$result = @fwrite($fp, $sourceNameOrData);

						if ($result === false)
						{
							$this->setError('Could not store virtual file ' . $targetName . ' to ' . $tempFileName . ' using fwrite() before uploading.');

							return false;
						}

						@fclose($fp);
					}
				}

				// Upload the temporary file under the final name
				$res = $this->_upload($tempFileName, $targetName);

				// Remove the temporary file
				Factory::getTempFiles()->unregisterAndDeleteTempFile($tempFileName, true);

				return $res;
			}
			else
			{
				// Upload a file
				return $this->_upload($sourceNameOrData, $targetName);
			}
		}
	}

	/**
	 * "Magic" function called just before serialization of the object. Disconnects
	 * from the FTP server and allows PHP to serialize like normal.
	 *
	 * @return array The variables to serialize
	 */
	public function _onSerialize()
	{
		$this->_sftphandle = false;
		$this->_connection = false;
		$this->_currentdir = null;

		return array_keys(get_object_vars($this));
	}

	/**
	 * Tries to connect to the remote SFTP server and change into the initial directory
	 *
	 * @return bool True is connection successful, false otherwise
	 */
	protected function _connectSFTP()
	{
		Factory::getLog()->log(LogLevel::DEBUG, 'Connecting to remote SFTP server');

		$this->_connection = false;
		$this->_sftphandle = false;

		if ( !function_exists('ssh2_connect'))
		{
			$this->setWarning('Your web server does not have the SSH2 PHP module, therefore can not connect to SFTP servers.');

			Factory::getLog()->log(LogLevel::WARNING, 'Your web server does not have the SSH2 PHP module, therefore can not connect to SFTP servers.');

			return false;
		}

		$this->_connection = ssh2_connect($this->_host, $this->_port);

		if ( !empty($this->_privkey) && !empty($this->_pubkey))
		{
			if ( !ssh2_auth_pubkey_file($this->_connection, $this->_user, $this->_pubkey, $this->_privkey, $this->_pass))
			{
				$this->setWarning('Could not authenticate access to SFTP server; check your certificate paths and passphrase');

				Factory::getLog()->log(LogLevel::WARNING, 'Could not authenticate access to SFTP server; check your certificate paths and passphrase');

				$this->_connection = false;

				return false;
			}
		}
		else
		{
			if ( !ssh2_auth_password($this->_connection, $this->_user, $this->_pass))
			{
				$this->setWarning('Could not authenticate access to SFTP server; check your username and password');

				Factory::getLog()->log(LogLevel::WARNING, 'Could not authenticate access to SFTP server; check your username and password');

				$this->_connection = false;

				return false;
			}
		}

		$this->_sftphandle = ssh2_sftp($this->_connection);

		$this->resetErrors();

		return true;
	}

	/**
	 * Changes to the requested directory in the remote server. You give only the
	 * path relative to the initial directory and it does all the rest by itself,
	 * including doing nothing if the remote directory is the one we want. If the
	 * directory doesn't exist, it creates it.
	 *
	 * @param $dir string The (realtive) remote directory
	 *
	 * @return bool True if successful, false otherwise.
	 */
	protected function _sftp_chdir($dir)
	{
		// Calculate "real" (absolute) SFTP path
		$realdir = substr($this->_initdir, -1) == '/' ? substr($this->_initdir, 0, strlen($this->_initdir) - 1) : $this->_initdir;
		$realdir .= '/' . $dir;
		$realdir = substr($realdir, 0, 1) == '/' ? $realdir : '/' . $realdir;

		if ($this->_currentdir == $realdir)
		{
			// Already there, do nothing
			return true;
		}

		$result = @ssh2_sftp_stat($this->_sftphandle, $realdir);

		if ($result === false)
		{
			// The directory doesn't exist, let's try to create it...
			if ( !$this->_makeDirectory($dir))
			{
				return false;
			}
		}

		// Update the private "current remote directory" variable
		$this->_currentdir = $realdir;

		return true;
	}

	protected function _makeDirectory($dir)
	{
		$alldirs     = explode('/', $dir);
		$previousDir = substr($this->_initdir, -1) == '/' ? substr($this->_initdir, 0, strlen($this->_initdir) - 1) : $this->_initdir;
		$previousDir = substr($previousDir, 0, 1) == '/' ? $previousDir : '/' . $previousDir;

		foreach ($alldirs as $curdir)
		{
			$check = $previousDir . '/' . $curdir;

			if ( !@ssh2_sftp_stat($this->_sftphandle, $check))
			{
				if (ssh2_sftp_mkdir($this->_sftphandle, $check, 0755, true) === false)
				{
					$this->setError('Could not create directory ' . $check);

					return false;
				}
			}

			$previousDir = $check;
		}

		return true;
	}

	/**
	 * Uploads a file to the remote server
	 *
	 * @param $sourceName string The absolute path to the source local file
	 * @param $targetName string The relative path to the targer remote file
	 *
	 * @return bool True if successful
	 */
	protected function _upload($sourceName, $targetName)
	{
		// Try to change into the remote directory, possibly creating it if it doesn't exist
		$dir = dirname($targetName);

		if ( !$this->_sftp_chdir($dir))
		{
			return false;
		}

		// Upload
		$realdir = substr($this->_initdir, -1) == '/' ? substr($this->_initdir, 0, strlen($this->_initdir) - 1) : $this->_initdir;
		$realdir .= '/' . $dir;
		$realdir  = substr($realdir, 0, 1) == '/' ? $realdir : '/' . $realdir;
		$realname = $realdir . '/' . basename($targetName);

		$fp = @fopen("ssh2.sftp://{$this->_sftphandle}$realname", 'w');

		if ($fp === false)
		{
			Factory::getLog()->log(LogLevel::WARNING, "Could not open remote file $realname for writing");

			return false;
		}

		$localfp = @fopen($sourceName, 'rb');

		if ($localfp === false)
		{
			Factory::getLog()->log(LogLevel::WARNING, "Could not open local file $sourceName for reading");
			@fclose($fp);

			return false;
		}

		$res = true;

		while ( !feof($localfp) && ($res !== false))
		{
			$buffer = @fread($localfp, 65567);
			$res    = @fwrite($fp, $buffer);
		}

		@fclose($fp);
		@fclose($localfp);

		if ($res === false)
		{
			// If the file was unreadable, just skip it...
			if (is_readable($sourceName))
			{
				$this->setError('Uploading ' . $targetName . ' has failed.');

				return false;
			}
			else
			{
				$this->setWarning('Uploading ' . $targetName . ' has failed because the file is unreadable.');

				return true;
			}
		}

		return true;
	}
}