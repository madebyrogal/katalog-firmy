<?php

class stgFormFormatter extends sfWidgetFormSchemaFormatter {

  protected
    $rowFormat = '%error%<div class="stgFormRow"><div class="stgFormLabel">%label%</div><div class="stgFormField">%field% %help%</div><div class="clear-both"></div></div>%hidden_fields%',
    $helpFormat = '<div class="stgFormFieldHelp">%help%</div>',
    $errorRowFormat = '<div>%errors%<br /></div>',
    $errorListFormatInARow = '<ul class="stgFormErrors">%errors%</ul>',
    $errorRowFormatInARow =  '<li class="error">&darr; %error% &darr;</li>',
    $namedErrorRowFormatInARow = '<li class="error">&darr; %error% &darr;</li>';

  public static function setFormatter($widgetSchema, $validatorSchema) {
    $widgetSchema->addFormFormatter('stg', new stgFormFormatter($widgetSchema, $validatorSchema));
    $widgetSchema->setFormFormatterName('stg');
  }
}