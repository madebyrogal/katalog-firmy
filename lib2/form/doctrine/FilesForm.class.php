<?php

/**
 * Files form.
 *
 * @package    stgcms2
 * @subpackage form
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FilesForm extends BaseFilesForm
{

  public $rootId = null;
  public $Model = 'Files';
  private $allovedMimeTypes = array(
      'application/pdf', //PDF
      //'text/plain',   //TEXT PLAIN
      //'application/x-httpd-php',   //PHP
      'application/octet-stream', //OCTET STREAM
      'text/xml', //XML
      'image/png', //PNG
      'image/jpeg', //JPG
      'image/gif', //GIF
  );

  public function configure()
  {

    $this->getWidgetSchema()->setHelps(stgHelp::getInstance()->getHelps($this));

    unset(
            $this['slug'],
            $this['root_id'],
            $this['lft'],
            $this['rgt'],
            $this['level'],
            $this['created_at'],
            $this['updated_at']
    );

    $this->embedI18n(Lang::getInstance()->getNotDeleted()->toArray());

    $this->widgetSchema['file'] = new sfWidgetFormInputFile(array(
                'label' => 'Plik',
            ));


//    $this->widgetSchema['file'] = new sfWidgetFormInputFileEditable(array(
    $this->widgetSchema['file'] = new sfWidgetFormInputFileEditableExtended(array(
                'label' => 'Plik',
                'file_src' => '/uploads/files/' . $this->getObject()->getFile(),
                'name' => $this->getObject()->__toString(),
                'is_file' => $this->getObject()->isFile(),
                'is_image' => false,
                'edit_mode' => !$this->isNew(),
                'with_delete' => false,
            ));

    $files_settings = sfConfig::get('mod_files_settings_files');
    $this->validatorSchema['file'] = new sfValidatorFile(array(
                'required' => false,
                'path' => sfConfig::get('sf_upload_dir') . '/files',
                'max_size' => $files_settings['max_size'],
                    //'mime_types'    =>  $this->getAllowedMimeTypes()
                    //'mime_types' => 'web_images', //XXX UWAGA: Trzeba będzie jakoś mądrze filtrować typy plików
            ));

    //Tajemniczy STUFF, który Pawel robi, zeby miec drzewko kategorii :)
    $this->widgetSchema['parent_id'] = new sfWidgetFormDoctrineChoice(array(
                'model' => $this->Model,
                'order_by' => array('root_id, lft', ''),
                'method' => 'getIndentedName'
            ));
    $this->validatorSchema['parent_id'] = new sfValidatorDoctrineChoice(array(
                'required' => false,
                'model' => $this->Model
            ));
    $this->setDefault('parent_id',
            $this->object->getRootId()
    );
    $this->widgetSchema->setLabel('parent_id', 'Pozycja');

  }

  public function updateParentIdColumn($parentId)
  {
    $this->rootId = $parentId;
  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $node = $this->object->getNode();

    if ($this->rootId != $this->object->getRootId() || !$node->isValidNode())
    {
      if (empty($this->rootId))
      {
        //save as a root
        if ($node->isValidNode())
        {
          $node->makeRoot($this->object['id']);
          $this->object->save($con);
        }
        else
        {
          $this->object->getTable()->getTree()->createRoot($this->object); //calls $this->object->save internally
        }
      }
      else
      {
        //form validation ensures an existing ID for $this->parentId
        $parent = $this->object->getTable()->find($this->rootId);
        $method = ($node->isValidNode() ? 'move' : 'insert') . 'AsFirstChildOf';
        $node->$method($parent); //calls $this->object->save internally
      }
    }
  }

  public function getAllowedMimeTypes()
  {
    return $this->allovedMimeTypes;
  }

}
