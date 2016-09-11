<?php

require_once dirname(__FILE__) . '/../../vendor/symfony/lib/helper/UrlHelper.php';
require_once dirname(__FILE__) . '/../../vendor/symfony/lib/helper/TagHelper.php';

class sfWidgetFormInputAdd extends sfWidgetFormInput {

  protected function configure($options = array(), $attributes = array()) {
    $this->addRequiredOption('routing');
    $this->addRequiredOption('object');
    $this->addRequiredOption('delete_routing');
    $this->addRequiredOption('delete_confirm');
    $this->addOption('icon', null);
    $this->addOption('use_ajax_file', null);
    parent::configure($options, $attributes);
  }

  public function render($name, $value = null, $attributes = array(), $errors = array()) {
    $ctx = sfContext::getInstance();
    $request = $ctx->getRequest();
    $controller = $ctx->getController();

    if (is_null($this->getOption('icon'))) {
      $this->setOption('icon', sprintf('http://%s%s/sfDoctrinePlugin/images/new.png', $request->getHost(), $request->getRelativeUrlRoot()));
    } else {
      $this->setOption('icon', sprintf('http://%s%s/images/%s', $request->getHost(), $request->getRelativeUrlRoot(), $this->getOption('icon')));
    }

    $html = parent::render($name, $value, $attributes, $errors);

    $img = $this->renderTag('img', array('src' => $this->getOption('icon')));

    if ($this->getOption('object')->getPrimaryKey()) {  // jeśli obiekt jest juz zapisany w bazie
      $link = self::getLink($this->getOption('routing'), $this->getOption('object'), $img);

      $html .= $link;

      // AJAX
      if ($this->getOption('use_ajax_file')) {
        $url = url_for($this->getOption('routing'), array('product_property_id' => $this->getOption('object')->getPrimaryKey(), 'value_name' => ''));
        $object_id = $this->getOption('object')->getPrimaryKey();
        $delete_confirm = $this->getOption('delete_confirm');
        include($this->getOption('use_ajax_file')); // includowanie skryptu JS
      }
    }

    return $html;
  }

  static private function getLink($routing, $object, $label) {
    $url = '#';
//        $link =  link_to($label, $url, array('id' => 'link_add', 'absolute' => true));
    $link = '<a href="' . $url . '" id="link_add">' . $label . '</a>';
    return $link;
  }

}