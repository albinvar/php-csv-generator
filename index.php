<?php

use PhpCsv\Generator;

require_once("./vendor/autoload.php");

$columns = ['Name', 'Class', 'Rollno'];
$array = [ 
	['Albin', 12, 2],
	['Sam', 12, 48],
	['Jayashakar', 12, 33],
];


$object = new Generator();
$object->setArray($columns, $array);
$object->createCsv();
echo $object->exportJson();

//$object->exportCsv('test2.csv');