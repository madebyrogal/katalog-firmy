<?php

/**
 * ArticleCustomFieldValue form.
 *
 * @package    sell4
 * @subpackage form
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ArticleCustomFieldValueForm extends BaseArticleCustomFieldValueForm {

    public function  __construct($article) {
        $this->article = $article;

        parent::__construct();
    }

    public function configure() {
        unset(
                $this['id'],
                $this['article_id'],
                $this['field_id'],
                $this['value']
        );

        $this->widgetSchema->setLabel(false);

        $this->createFields();

    }

    protected function createFields() {
        // pobrac wszystkie pola
        $fields = ArticleCustomFieldTable::getInstance()->findAll();

        // pobrac wartosci pol
        if($this->article->getPrimaryKey()) {
            $values = ArticleCustomFieldValueTable::getInstance()->getCustomFields($this->article->getPrimaryKey());
        }

        // wyswietlic wszystkie pola
        foreach($fields as $field) {

            $fieldName = $field->getName();
            $fieldType = $field->getType();
            $fieldValue = null;

            // skojarzyc pole z wartoscia
            if(isset($values)) {
                foreach($values as $value) {
                    if($value->ArticleCustomField->getName() == $fieldName) {
                        $fieldValue = $value->getValue();
                        break;
                    }
                }
            }

            switch($fieldType) {

                case 'TYPE_STRING':
                    $this->widgetSchema[$fieldName] = new sfWidgetFormInputText();
                    $this->validatorSchema[$fieldName] = new sfValidatorString(array('max_length' => 255, 'required' => false));
                    $this->defaults[$fieldName] = $fieldValue == null ? '' : $fieldValue;

                    break;

                case 'TYPE_DATE':
                    $this->widgetSchema[$fieldName] = new sfWidgetFormDateTime();
                    $this->validatorSchema[$fieldName] = new sfValidatorDateTime(array('required' => false));
                    $this->defaults[$fieldName] = $fieldValue == null ? time() : $fieldValue;

                    break;

                case 'TYPE_CHOICE':
                    $choices = self::getChoices($field->getRecordKey());
                    $this->widgetSchema[$fieldName] = new sfWidgetFormChoice(array('choices' => $choices));
                    $this->validatorSchema[$fieldName] = new sfValidatorChoice(array('choices' => array_keys($choices), 'required' => false));
                    $this->defaults[$fieldName] = $fieldValue == null ? '' : $fieldValue;

                    break;
            }
        }
    }

    public static function getChoices($record_key) {

      $choices = array();

      switch ($record_key) {
        case 'FACEBOOK_LIKE':
          $choices['FACEBOOK_LIKE_NONE'] = 'brak';
          $choices['FACEBOOK_LIKE_SHOW'] = 'pokaż';
//          $choices['FACEBOOK_LIKE_TOP'] = 'nad treścią';
//          $choices['FACEBOOK_LIKE_BOTTOM'] = 'pod treścią';
//          $choices['FACEBOOK_LIKE_TOP_BOTTOM'] = 'nad treścią i pod treścią';
          break;

        case 'TWITTER_LIKE':
          $choices['TWITTER_LIKE_NONE'] = 'brak';
          $choices['TWITTER_LIKE_SHOW'] = 'pokaż';
//          $choices['TWITTER_LIKE_TOP'] = 'nad treścią';
//          $choices['TWITTER_LIKE_BOTTOM'] = 'pod treścią';
//          $choices['TWITTER_LIKE_TOP_BOTTOM'] = 'nad treścią i pod treścią';
          break;

        default:
          break;

      }
      return $choices;

    }
}
