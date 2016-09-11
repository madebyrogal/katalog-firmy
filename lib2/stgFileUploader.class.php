<?php

/**
 * Klasa uploadujaca AJAXowo pliki
 *
 * @package    stgcms2
 * @subpackage lib
 * @author     Bartek Tomżyński <bartekt@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class stgFileUploader {

    function __construct() {

        if (!isset($_GET['qqfile'])) {
        }
    }

    /**
     * Returns array('success'=>true) or array('error'=>'error message')
     */
    function handleUpload() {

        return $this->save();
    }

    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    function save() {
        $input = fopen("php://input", "r");

        $temp_file = tempnam(sys_get_temp_dir(), '');
        $temp = fopen($temp_file, 'w');

        $realSize = stream_copy_to_stream($input, $temp);
        fclose($input);

        if ($realSize != $this->getSize()) {
            return false;
        }

        return array(
            'file' => array(
                'name' => $this->getName(),
                'type' => mime_content_type($temp_file),
                'tmp_name' => $temp_file,
                'error' => UPLOAD_ERR_OK,
                'size' => $this->getSize()
            )
        );
    }

    function getName() {
        return $_GET['qqfile'];
    }

    function getSize() {
        if (isset($_SERVER["CONTENT_LENGTH"])) {
            return (int) $_SERVER["CONTENT_LENGTH"];
        } else {
            throw new Exception('Getting content length is not supported.');
        }
    }

}

