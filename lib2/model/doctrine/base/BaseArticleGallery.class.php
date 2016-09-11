<?php

/**
 * BaseArticleGallery
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $article_id
 * @property integer $gallery_id
 * @property Articles $Articles
 * @property Galleries $Galleries
 * 
 * @method integer        getArticleId()  Returns the current record's "article_id" value
 * @method integer        getGalleryId()  Returns the current record's "gallery_id" value
 * @method Articles       getArticles()   Returns the current record's "Articles" value
 * @method Galleries      getGalleries()  Returns the current record's "Galleries" value
 * @method ArticleGallery setArticleId()  Sets the current record's "article_id" value
 * @method ArticleGallery setGalleryId()  Sets the current record's "gallery_id" value
 * @method ArticleGallery setArticles()   Sets the current record's "Articles" value
 * @method ArticleGallery setGalleries()  Sets the current record's "Galleries" value
 * 
 * @package    sell4
 * @subpackage model
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseArticleGallery extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('of_article_gallery');
        $this->hasColumn('article_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('gallery_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));

        $this->option('connection', 'globocam_classic');
        $this->option('type', 'INNODB');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Articles', array(
             'local' => 'article_id',
             'foreign' => 'article_id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Galleries', array(
             'local' => 'gallery_id',
             'foreign' => 'gallery_id',
             'onDelete' => 'CASCADE'));
    }
}