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
		echo $this->jsonEncoder($this->array);
		
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
		$array =[];
		
		$lines = explode($delimiterBreak, $data);
		
		foreach($lines as $line)
		{
			$array[] = explode($delimiter, $line);
		}
		
		$header = $array[0];
		unset($array[0]);
		$array = ['header' => $header, 'body' => $array];
		
		$this->array = $array;
	}
	
	private function jsonEncoder($data)
	{
		$encoded = json_encode($data);
		return $encoded;
	}
	
	private function jsonDecoder($data)
	{
		$decoded = json_decode($data);
		return $decoded;
	}
	
}