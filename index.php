<?php
//index.php

require 'PhpCsv.php';


$object = new PhpCsv();
$object->setCsv("test.csv");
$object->getArray();

$new = new PhpCsv();
$array = $object->getArray();
$new->setArray($array);
$new->getCsv($object->getArray());
