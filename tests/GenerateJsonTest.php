<?php

use PhpCsv\Generator;
use \PHPUnit\Framework\TestCase;

require_once("./vendor/autoload.php");


class GenerateJsonTest extends TestCase
{
	public function test_convert_array_to_json()
	{
		$columns = ['Name', 'Age'];
		$array = [ 
			['John', 28],
			['Johana', 23],
			['Adam', 32],
		];
		$object = new Generator();
		$object->setArray($array, $columns);
		
		$jsonString = $object->exportJson();
		
		return $this->assertTrue(!is_null(json_decode($jsonString)));
	}
}