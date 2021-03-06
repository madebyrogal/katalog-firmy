<?php

/**
 * ArticleCustomFieldValue
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    sell4
 * @subpackage model
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class ArticleCustomFieldValue extends BaseArticleCustomFieldValue
{
    public function  __toString() {
        if($this->ArticleCustomField->type == 'TYPE_DATE') {
            return date('j.m.Y', $this->value);
        } else {
            return $this->value;
        }
    }
}
