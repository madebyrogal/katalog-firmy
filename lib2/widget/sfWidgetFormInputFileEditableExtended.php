<?php

class sfWidgetFormInputFileEditableExtended extends sfWidgetFormInputFileEditable
{
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);

    $this->addOption('name', 'Plik');
    $this->addOption('is_file', false);
  }

  protected function getFileAsTag($attributes)
  {
    if ($this->getOption('is_image'))
    {
      return false !== $this->getOption('file_src') ? $this->renderTag('img', array_merge(array('src' => $this->getOption('file_src')), $attributes)) : '';
    }
    else
    {
      if ($this->getOption('is_file')) {
        return sprintf('<img src="/images/file.png" /><a href="%1$s">'.$this->getOption('name').'</a>', $this->getOption('file_src'));
      }
      else {
        return sprintf('<img src="/images/folder.png" />');
      }
    }
  }
}