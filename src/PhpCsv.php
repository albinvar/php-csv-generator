<?php

namespace App;

class PhpCsv
{
	
	public function __construct()
	{
		//
	}
	
	public function setCsv($file)
	{
		$this->file = $file;
		$data = file_get_contents($file);
		$this->parseCsv($data);
	}
	
	public function setArray($array)
	{
		$this->setArray = $array;
	}
	
	public function createArray()
	{
		//
	}
	
	public function createCsv()
	{
		//
	}
	
	private function parseCsv($data)
	{
		$delimiterBreak = PHP_EOL;
		$delimiter = ',';
		
		$lines = explode($delimiterBreak, $data);
		var_dump($lines);
	}
	
	private function jsonEncoder($data)
	{
		$encoded = json_decode($data);
		return $encoded;
	}
	
	private function jsonDecoder($data)
	{
		$decoded = json_decode($data);
		return $decoded;
	}
	
}