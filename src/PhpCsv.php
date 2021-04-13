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
		var_dump($data);
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