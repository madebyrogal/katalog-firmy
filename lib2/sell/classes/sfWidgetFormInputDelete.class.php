<?php
require_once dirname(__FILE__).'/../../vendor/symfony/lib/helper/UrlHelper.php';
require_once dirname(__FILE__).'/../../vendor/symfony/lib/helper/TagHelper.php';

class sfWidgetFormInputDelete extends sfWidgetFormInput
{

    protected function configure($options = array(), $attributes = array())
    {
        $this->addRequiredOption('routing');
        $this->addRequiredOption('object');
//        $this->addRequiredOption('label');
        $this->addOption('confirm', null);
        $this->addOption('icon', null);
        $this->addOption('use_ajax_file', null);
        parent::configure($options, $attributes);
    }

    public function render($name, $value = null, $attributes = array(), $errors = array())
    {
        $ctx = sfContext::getInstance();
        $request = $ctx->getRequest();
        $controller = $ctx->getController();
        if (is_null($this->getOption('confirm')))
        {
            $this->setOption('confirm', __('Are you sure you want to delete this item?'));
        }

        if (is_null($this->getOption('icon')))
        {

            $this->setOption('icon', sprintf('http://%s%s/sfDoctrinePlugin/images/delete.png', $request->getHost(), $request->getRelativeUrlRoot()));

        } else
        {
            $this->setOption('icon', sprintf('http://%s%s/images/%s', $request->getHost(), $request->getRelativeUrlRoot(), $this->getOption('icon')));
        }

        $html = parent::render($name, $value, $attributes, $errors);

        $img = $this->renderTag('img', array('src' => $this->getOption('icon')));

//        $link = '<a href="'.$controller->genUrl($this->getOption('url')).'?id='.$this->getOption('model_id').'" onclick="if (confirm(\''.$this->getOption('confirm').'\')) { return true; };return false;">'.$img.'</a>';
        $link = self::getLink($this->getOption('routing'),$this->getOption('object'),$img,$this->getOption('confirm'));

        $html .= $link;

        // AJAX
        if ($this->getOption('use_ajax_file'))
        {
          $object_id = $this->getOption('object')->getPrimaryKey();
          include($this->getOption('use_ajax_file')); // includowanie skryptu JS
        }

        return $html;

    }

    static private function getLink($routing,$object,$label,$confirm = 'Are you sure?')
    {
        $url = url_for($routing,$object);
//        $link =  link_to($label, $url, array('id' => 'myid', 'confirm' => $confirm, 'absolute' => true));
        $link =  link_to($label, $url, array('class' => 'link_delete', 'id' => 'link_delete_'.$object->getPrimaryKey(), 'confirm' => $confirm, 'absolute' => true));
        return $link;
    }

}