<?php

require_once dirname(__FILE__) . '/../lib/articlesGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/articlesGeneratorHelper.class.php';

class articlesActions extends autoArticlesActions
{
    protected $module = 'articles';
//    protected $tree_key = 'ARTICLES_TREE';
//    protected $tree_key = array('ARTICLES_TREE',
//        'SECURE_ART_CATEGORY_INSTALLER', //solver - to jest współdzielone i musi zostać, dopóki nie zrobimy refactoringu
//        'SECURE_ART_CATEGORY_DESIGNER', //solver - to jest współdzielone i musi zostać, dopóki nie zrobimy refactoringu
//        'SECURE_ART_CATEGORY_USER', //solver - to jest współdzielone i musi zostać, dopóki nie zrobimy refactoringu
//        'SECURE_ART_CATEGORY_SERVICEMAN' //solver - to jest współdzielone i musi zostać, dopóki nie zrobimy refactoringu
//        );

    public function executeEdit(sfWebRequest $request)
    {
        if ($this->getRoute()->getObject()->getIsEditable())
        {
            $this->articles = $this->getRoute()->getObject();
            
            $this->version_id = $request->getParameter('version');
            $version = $this->articles->getVersionByPk($this->version_id);

            if($version)
            {
                $this->articles->setAuthorId($version->getAuthorId());
                $this->articles->setArtcategoryId($version->getArtcategoryId());
                $this->articles->setTitle($version->getTitle());
                $this->articles->setContent($version->getContent());
            }

            $this->form = $this->configuration->getForm($this->articles);
            $this->form->createWidgetArtcategoryId(ArtCategories::getArtCategoriesTreeKeys(), true);
        }
        else
        {
            $this->redirect($request->getReferer());
        }
    }

    public function executeUpdate(sfWebRequest $request)
    {
        if ($this->getRoute()->getObject()->getIsEditable())
        {
            parent::executeUpdate($request);
        }
        else
        {
            $this->redirect($request->getReferer());
        }
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            $this->saveTags($request, $form);

            $customFields = $form->getValue('ArticleCustomField');
            $category = $form->getValue('artcategory_id');

            try
            {
                if ($request->hasParameter('_publish') || $request->hasParameter('_is_ajax_request'))
                {
                    $articles = $form->saveAndPublish();
                }
                else
                {
                    $articles = $form->save();
                }

                $this->saveCustomFields($articles, $customFields, $category);
            }
            catch (Doctrine_Validator_Exception $e)
            {

                $errorStack = $form->getObject()->getErrorStack();

                $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
                foreach ($errorStack as $field => $errors)
                {
                    $message .= "$field (" . implode(", ", $errors) . "), ";
                }
                $message = trim($message, ', ');

                $this->getUser()->setFlash('error', $message);
                return sfView::SUCCESS;
            }

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $articles)));



            if ($request->hasParameter('_save_and_add'))
            {
                $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

                $this->redirect($this->module.'_new');
            }
            else
            {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect(array('sf_route' => $this->module.'_edit', 'sf_subject' => $articles));
            }
        }
        else
        {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }

    public function executeDeleteVersion(sfWebRequest $request)
    {
        $object = $this->getRoute()->getObject();
        $article = $object->getArticles();
        if(!$object->getIsActive())
        {
            $object->delete();
        }

        $this->redirect($this->module.'_edit', $article);

    }

    public function executeDeleteAllVersions(sfWebRequest $request)
    {
        $params = $request->getPostParameters();
        if(isset($params['version']))
        {
            $ids = array_keys($params['version']);
        }
        else
        {
            $ids = array();
        }

        if(count($ids) > 0)
        {
            $versions = ArticlesVersionTable::getInstance()->getVersionByIds($ids, false);
            foreach($versions as $version)
            {
                if(!$version->getIsActive())
                {
                    $version->delete();
                }
            }
        }
        $this->getUser()->setFlash('notice', 'Wersje zostały usunięte');
        $object = ArticlesTable::getInstance()->find($params['id']);
        if($params['module'] == 'articles')
        {            
            $this->redirect('articles_edit', $object);
        }
        elseif($params['module'] == 'catalog_product')
        {
            $this->redirect('catalog_product_edit', $object);
        }


    }

    public function executeDelete(sfWebRequest $request)
    {
        if ($this->getRoute()->getObject()->getIsDeletable())
        {
            parent::executeDelete($request);
        }
        else
        {
            $this->redirect($request->getReferer());
        }
    }


    public function executeSetActiveVersion(sfWebRequest $request)
    {
        $object = $this->getRoute()->getObject();
        $object->PublicArticle();

        $this->redirect($this->module.'_edit', $object->getArticles());

    }

    public function executeListSettings(sfWebRequest $request)
    {
        $object = $this->getRoute()->getObject();
        $this->redirect('@settings_articles?article_id='.$object->getPrimaryKey());
    }


    protected function executeBatchDelete(sfWebRequest $request)
    {
        $ids = $request->getParameter('ids');

        $count = Doctrine_Query::create()
                ->from('Articles')
                ->andWhereIn('article_id', $ids)
                ->addWhere('is_deletable = true')
                ->execute();


        $deleted_cnt = 0;
        foreach ($count as $article)
        {
            $deleted_cnt += $article->delete();
        }

        if ($deleted_cnt >= count($count))
        {
            $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
        }
        else
        {
            $this->getUser()->setFlash('error', 'A problem occurs when deleting the selected items.');
        }

//        $this->redirect('@'.$this->redirect_default_routing);
        $this->redirect('@'.$this->module);
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = $this->configuration->getForm();
        $this->form->createWidgetArtcategoryId(ArtCategories::getArtCategoriesTreeKeys(), true);
        $this->articles = $this->form->getObject();
        if ($request->getParameter('artcategory_id') > 0)
        {
            $this->form->setDefault('artcategory_id', $request->getParameter('artcategory_id'));
        }
    }

    public function executeBatchUnpublic(sfWebRequest $request)
    {
        $ids = $request->getParameter('ids');
        $q = Doctrine_Query::create()
                ->from('Articles a')
                ->whereIn('a.article_id', $ids);
        foreach ($q->execute() as $category)
        {
            $category->setPublic(false);
        }
        $this->getUser()->setFlash('notice', 'Wybrane teksty zostały ustawione na niepubliczne.');
        $this->redirect('@'.$this->module);
    }

    public function executeBatchPublic(sfWebRequest $request)
    {
        $ids = $request->getParameter('ids');
        $q = Doctrine_Query::create()
                ->from('Articles a')
                ->whereIn('a.article_id', $ids);
        foreach ($q->execute() as $category)
        {
            $category->setPublic(true);
        }
        $this->getUser()->setFlash('notice', 'Wybrane teksty ustawione na publiczne.');
        $this->redirect('@'.$this->module);
    }

    public function executeListPublic(sfWebRequest $request)
    {
        $article = $this->getRoute()->getObject();
        $article->setPublic(true);
        $this->getUser()->setFlash('notice', 'Wybrany tekst został opublikowany.');
        $this->redirect('@'.$this->module);
    }

    public function executeListUnpublic(sfWebRequest $request)
    {
        $article = $this->getRoute()->getObject();
        $article->setPublic(false);
        $this->getUser()->setFlash('notice', 'Wybrany tekst został oznaczony jako nieopublikowany.');
        $this->redirect('@'.$this->module);
    }

    public function executeSwitchPublic(sfWebRequest $request)
    {
        $article = $this->getRoute()->getObject();
        if ($article->getIsPublic())
        {
            $article->setPublic(false);
            $this->getUser()->setFlash('notice', 'Wybrany tekst został oznaczony jako nieopublikowany.');
        }
        else
        {
            $article->setPublic(true);
            $this->getUser()->setFlash('notice', 'Wybrany tekst został opublikowany.');
        }
        $this->redirect('@'.$this->module);
    }

    protected function saveTags(sfWebRequest $request, sfForm $form)
    {
        $tags = $form->getValue('Tags');

        if ($tags['remove_tags'])
        {
            foreach (preg_split('/\s*,\s*/', $tags['remove_tags']) as $tag)
            {
                if($tag != '')
                    $form->getObject()->removeTag($tag);
            }
        }
        if ($tags['new_tags'])
        {
            foreach (preg_split('/\s*,\s*/', $tags['new_tags']) as $tag)
            {
                if($tag != '')
                    $form->getObject()->addTag($tag);
            }
        }
    }

    protected function saveCustomFields($article, $customFields, $category)
    {

        $article->saveCustomFields($customFields, $category);

    }
}
