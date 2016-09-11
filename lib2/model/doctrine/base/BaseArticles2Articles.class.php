<?php

/**
 * BaseArticles2Articles
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $article_1_id
 * @property integer $article_2_id
 * @property Articles $Article_1
 * @property Articles $Article_2
 * 
 * @method integer           getArticle1Id()   Returns the current record's "article_1_id" value
 * @method integer           getArticle2Id()   Returns the current record's "article_2_id" value
 * @method Articles          getArticle1()     Returns the current record's "Article_1" value
 * @method Articles          getArticle2()     Returns the current record's "Article_2" value
 * @method Articles2Articles setArticle1Id()   Sets the current record's "article_1_id" value
 * @method Articles2Articles setArticle2Id()   Sets the current record's "article_2_id" value
 * @method Articles2Articles setArticle1()     Sets the current record's "Article_1" value
 * @method Articles2Articles setArticle2()     Sets the current record's "Article_2" value
 * 
 * @package    sell4
 * @subpackage model
 * @author     Wojciech Piestrak <wojtek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseArticles2Articles extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('of_articles_2_articles');
        $this->hasColumn('article_1_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('article_2_id', 'integer', null, array(
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
        $this->hasOne('Articles as Article_1', array(
             'local' => 'article_1_id',
             'foreign' => 'article_id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Articles as Article_2', array(
             'local' => 'article_2_id',
             'foreign' => 'article_id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}