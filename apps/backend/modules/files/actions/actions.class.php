<?php

require_once dirname(__FILE__) . '/../lib/filesGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/filesGeneratorHelper.class.php';

/**
 * files actions.
 *
 * @package    stgcms2
 * @subpackage files
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class filesActions extends autoFilesActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->collections_array = StgTree::getTreeAsCollectionsArray('Files');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $this->object = $this->getRoute()->getObject();
    
    $this->object->getNode()->delete();
    $this->redirect($request->getReferer());
  }

  /*
   * Wykonuje update drzewa AJAXem
   */
  public function executeTreeUpdate(sfWebRequest $request)
  {
    StgTree::treeUpdate($request, 'Files');
  }

  public function executeNewFolder(sfWebRequest $request)
  {
    $this->form = new FilesForm();
    unset ( $this->form['file']);
    $this->files = Doctrine::getTable('Files')->findAll();
  }

  protected function addSortQuery($query)
  {
    //don't allow sorting; always sort by tree and lft
    $query->addOrderBy('root_id, lft');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $pic = $request->getFiles($form->getName());
    $quota = stgConfig::get('system_user_quota');

    $current = T::du(sfConfig::get('sf_upload_dir'));    

    if (!empty($pic['file']['name']) && ($pic['file']['size'] + $current) >= $quota)
    {
      $this->getUser()->setFlash('error', 'Nie masz już miejsca na dodawanie plików. Spróbuj dodać mniejszy.');
      $this->redirect('@files');
    }
    else
    {
      $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
      if ($form->isValid())
      {
        $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

        $files = $form->save();

        $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $files)));

        if ($request->hasParameter('_save_and_add'))
        {
          $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

          $this->redirect('@files_new');
        }
        else
        {
          $this->getUser()->setFlash('notice', $notice);

//          $this->redirect(array('sf_route' => 'files', 'sf_subject' => $files));
          $this->redirect(array('sf_route' => 'files_edit', 'sf_subject' => $files));
        }
      }
      else
      {
        $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
      }
    }
  }

}