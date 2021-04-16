<?php

use PhpCsv\Generator;

require_once("./vendor/autoload.php");

$array = [ 
	['Name', 'Class', 'Rollno'],
	['Albin', 12, 2],
	['Sam', 12, 48],
	['Jayashakar', 12, 33],
];


$object = new Generator();
$object->setArray($array);
$object->createCsv();
echo $object->exportJson();

//$object->exportCsv('test2.csv');