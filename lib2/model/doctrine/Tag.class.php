<?php

/**
 * Tag
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    sell4
 * @subpackage model
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Tag extends BaseTag
{
    /**
     * zwraca sformatowana liste tagow
     * @param string $pre element wyswietlany przed kazdym tagiem
     * @param string $post element wyswietlany po kazdym tagu
     * @return string sformatowana lista tagow
     */
    public static function getAllTagsFormated($pre = '', $post = ', ') {

        $tags = Doctrine_Core::getTable('Tag')->fetchAllActive();

        $output = '';

        foreach($tags as $tag) {
            $output .= $pre . $tag->getName() . $post;
        }
    }

    public function getArticlesQuery()
    {
        $q = Doctrine_Query::create()
            ->from('Articles a')
            ->leftJoin('a.Tags t')
            ->leftJoin('a.Galleries g')
            ->andWhere('t.id = ?', $this->getPrimaryKey())
            ->andWhere('a.is_public = ?',true)
            ->orderBy('a.created_at desc');

        return $q;
    }
}
