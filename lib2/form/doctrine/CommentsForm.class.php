<?php

/**
 * Comments form.
 *
 * @package    stgcms2
 * @subpackage form
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CommentsForm extends BaseCommentsForm
{
    public function configure()
    {
        unset(
                $this['created_at'],
                $this['updated_at']
        );

        $this->widgetSchema['cancel_url']   =   new sfWidgetFormInputHidden();
        $this->validatorSchema['cancel_url']    = new sfValidatorString();

        if(sfContext::getInstance()->getConfiguration()->getApplication() == 'frontend')
        {
            $this->widgetSchema['articles_list'] = new sfWidgetFormInputHidden();
            $this->widgetSchema['galleries_list'] = new sfWidgetFormInputHidden();
        }
        $this->widgetSchema['email']    = new sfWidgetFormInput(array('label' => 'Adres email:'));
        $this->widgetSchema['title']    = new sfWidgetFormInput(array('label' => 'Tytuł komentarza:'));
        $this->widgetSchema['author']    = new sfWidgetFormInput(array('label' => 'Autor:'));
        $this->widgetSchema['content']    = new sfWidgetFormTextarea(array('label' => 'Treść:'));

        if (Tools::getValueKey('comments_show_captcha'))
        {
            $this->widgetSchema['captcha'] = new sfWidgetCaptchaGD();
            $this->validatorSchema['captcha'] = new sfCaptchaGDValidator();
        }

        $this->validatorSchema['email'] = new sfValidatorEmail(array(
                        'required'  =>  false
                ), array(
                        'invalid' => 'Niepoprawny adres e-mail.',
                        'required'  =>  'Pole wymagane.'
        ));

        
    }

    public function getCancelLink()
    {
        $url = "/";
        $articles = $this->getObject()->getArticles();
        foreach($articles as $key => $article)
        {
            $url = url_for('article_show',$article);
        }
        return $url;
    }
}
