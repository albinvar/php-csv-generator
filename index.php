<?php

use App\PhpCsv;

require_once("./vendor/autoload.php");

$array = [ 
	['Name', 'Class', 'Rollno'],
	['Albin', 12, 2],
	['Sam', 12, 48],
	['Jayashakar', 12, 33],
];


$object = new PhpCsv();
$object->setArray($array);
$object->createCsv();
$object->exportCsv('test2.csv');

