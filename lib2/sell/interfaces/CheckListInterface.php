<?php

interface CheckListInterface
{

    public function getObject();

    public function getIsDone();

    public function setDone();

    public function valid();

    public function getName();

    public function getDescription();

}