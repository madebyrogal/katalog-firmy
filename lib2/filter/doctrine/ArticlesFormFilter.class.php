<?php

/**
 * Articles filter form.
 *
 * @package    stgcms2
 * @subpackage filter
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ArticlesFormFilter extends BaseArticlesFormFilter
{
    public function configure()
    {
        $this->widgetSchema['title']     = new sfWidgetFormFilterInput(array('with_empty' => false));
        $this->validatorSchema['title']  = new sfValidatorPass(array('required' => false));

        $this->widgetSchema['artcategory_id'] = new sfWidgetFormDoctrineChoice(array(
            'model' => $this->getRelatedModelName('ArtCategories'),
            'add_empty' => true,
            'method' => 'getIndentedName',
            'query' => ArtCategoriesTable::getInstance()->getIndentedChoicesQuery()
        ));
        $this->validatorSchema['artcategory_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ArtCategories'), 'column' => 'artcategory_id'));
    }

    public function addTitleColumnQuery(Doctrine_Query $query, $field, $values)
    {

        if (is_array($values) && isset($values['text']) && !empty($values['text']))
        {
            $query->leftJoin($query->getRootAlias().'.Translation t');
            $query->andWhere('t.title like ?', '%' . $values['text'] . '%');
//            $query->andWhere($query->getRootAlias().'.title LIKE ?', '%' . $values['text'] . '%');
        }
    }

    public function getFields()
    {
        return parent::getFields() + array('title' => 'Nazwa');
    }
}
