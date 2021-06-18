<?php

use PhpCsv\Generator;
use \PHPUnit\Framework\TestCase;

require_once("./vendor/autoload.php");


class GenerateCsvTest extends TestCase
{
	public function test_convert_array_to_csv()
	{
		
		$columns = ['Name', 'Age'];
		$array = [ 
			['John', 28],
			['Johana', 23],
			['Adam', 32],
		];
		$object = new Generator();
		$object->setArray($array, $columns);
		$object->makeCsv();
		
		$expectedOutput = "Name,Age\nJohn,28\nJohana,23\nAdam,32";
		
		return $this->assertTrue(strpos($object->getCsv(),$expectedOutput) !== false);
	}
}