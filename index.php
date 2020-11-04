<?php
//index.php

require 'PhpCsv.php';


$object = new PhpCsv();
$object->setCsv("test.csv");
$object->createArray();