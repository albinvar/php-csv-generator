<?php

use PhpCsv\Generator;

require_once("./vendor/autoload.php");

$columns = ['Name', 'Class', 'Rollno'];
$array = [ 
	['Albin', 12, 2],
	['Sam', 12, 48],
	['Jayashakar', null, 33],
];


$object = new Generator();
//$object->setArray($array, $columns);
//$object->makeCsv();
//echo $object->getCsv();
//echo $object->exportJson();


$object->setCsvFile('test.csv');
$array = $object->getArray();

//var_dump($array);

//$object->exportCsv('test2.csv');