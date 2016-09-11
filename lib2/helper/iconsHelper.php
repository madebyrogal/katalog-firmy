<?php

function icon_first() {
  return image_tag('icons/old-go-first.png', array('alt'=>'Do pierwszych','title'=>'Do pierwszych'));
}

function icon_previous() {
  return image_tag('icons/old-go-previous.png', array('alt'=>'Do poprzednich','title'=>'Do poprzednich'));
}

function icon_next() {
  return image_tag('icons/old-go-next.png', array('alt'=>'Do następnych','title'=>'Do następnych'));
}

function icon_last() {
  return image_tag('icons/old-go-last.png', array('alt'=>'Do ostatnich','title'=>'Do ostatnich'));
}

function icon_yes() {
  return image_tag('icons/gtk-yes.png', array('alt'=>'Tak','title'=>'Tak'));
}

function icon_no() {
  return image_tag('icons/gtk-no.png', array('alt'=>'Nie','title'=>'Nie'));
}

function icon_default() {
  return image_tag('icons/bookmark-new.png', array('alt'=>'Domyślny','title'=>'Domyślny'));
}