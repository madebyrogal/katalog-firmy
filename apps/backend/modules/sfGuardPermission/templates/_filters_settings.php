<?php
$moduleName = sfContext::getInstance()->getModuleName();
$internalUri = sfContext::getInstance()->getRouting()->getCurrentInternalUri(true);
$tmp = explode('?',$internalUri);
$routeName = substr($tmp[0],1);
unset($tmp);
unset($internalUri);
?>
