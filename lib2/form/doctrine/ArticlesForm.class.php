<?php

/**
 * Articles form.
 *
 * @package    stgcms2
 * @subpackage form
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ArticlesForm extends BaseArticlesForm
{

    public function configure()
    {
        
        $this->getWidgetSchema()->setHelps(stgHelp::getInstance()->getHelps($this));

        $this->removeFields();

        $this->widgetSchema['files_list'] = new sfWidgetFormSelectDoubleList(
            array
            (
                'choices' => FilesTable::getInstance()->getOptionsList(),
                'label_associated' => 'Pliki powiązane',
                'label_unassociated' => 'Pliki niepowiązane'
            )
        );

        $this->widgetSchema['galleries_list'] = new sfWidgetFormSelectDoubleList(
            array
            (
                'choices' => GalleriesTable::getInstance()->getOptionsList(),
                'label_associated' => 'Galerie przypisane',
                'label_unassociated' => 'Galerie nieprzypisane'
            )
        );

        $this->embedI18n(Lang::getInstance()->getNotDeleted()->toArray());

        $metas = new MetasForm($this->getObject()->getMetas());
        $this->embedForm('Metas', $metas);

        $tags = new TagForm();
        $this->embedForm('Tags', $tags);

        $customFields = new ArticleCustomFieldValueForm($this->getObject());
        $this->embedForm('ArticleCustomField', $customFields);

        $this->widgetSchema['created_at'] = new sfWidgetFormJQueryDate();
        $this->widgetSchema['created_at']->setOption('culture', 'pl');
        $this->setDefault('created_at', time());

    }


    public function createWidgetArtcategoryId($tree_key = null, $hide_root = true)
    {
        $this->widgetSchema['artcategory_id'] = new sfWidgetFormDoctrineChoice(array(
            'model' => 'ArtCategories',
            'order_by' => array('root_id, lft', ''),
            'method' => 'getIndentedName',
            'query' => ArtCategoriesTable::getInstance()->getIndentedChoicesQuery($tree_key, $hide_root)
        ));
    }

    protected function removeFields()
    {
        unset(
            $this['updated_at'],
            $this['record_key'],
            $this['is_editable'],
            $this['is_deletable'],
            $this['meta_id'],
            $this['tags_list'],
            $this['article_custom_fields_list'],
            $this['comments_list']
            //$this['catalog_flag_list']
        );

    }

    protected function doSave($con = null)
    {
        $this->saveEmeddedForms();

        parent::doSave($con);

        if($this->isNew())
        {
            ArticlesVersion::saveVersion($this->getObject(), true);
        }
        else
        {
            ArticlesVersion::saveVersion($this->getObject(), false);
            $this->getObject()->ReturnToActiveVersion();
        }
        $metas = $this->embeddedForms['Metas']->getObject();
        $metas->generateMetas($this->object);


    }

    protected function doSaveAndPublish($con = null)
    {
        $this->saveEmeddedForms();

        parent::doSave($con);
        ArticlesVersionTable::getInstance()->UnActiveArticleVersionAll($this->getObject()->getPrimaryKey());
        if($this->isNew())
        {
            ArticlesVersion::saveVersion($this->getObject(), true);
        }
        else
        {
            ArticlesVersion::saveVersion($this->getObject(), true);
        }
        $metas = $this->embeddedForms['Metas']->getObject();
        $metas->generateMetas($this->object);

    }

    public function saveAndPublish($con = null)
    {
        if (!$this->isValid())
        {
            throw $this->getErrorSchema();
        }

        if (null === $con)
        {
            $con = $this->getConnection();
        }

        try
        {
            $con->beginTransaction();

            $this->doSaveAndPublish($con);

            $con->commit();
        }
        catch (Exception $e)
        {
            $con->rollBack();

            throw $e;
        }

        return $this->getObject();
    }

    public function saveEmeddedForms()
    {
        unset($this->values['Tags']);
        unset($this->embeddedForms['Tags']);

        unset($this->values['ArticleCustomField']);
        unset($this->embeddedForms['ArticleCustomField']);
    }
}
