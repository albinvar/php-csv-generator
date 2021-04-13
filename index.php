<?php

use App\PhpCsv;

require_once("./vendor/autoload.php");

$object = new PhpCsv();
$object->setCsv("test.csv");
$object->createArray();

