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
		//$this->jsonEncoder();
		
	}
	
	public function setArray($array)
	{
		$this->array = $array;
		$this->parseArray();
	}
	
	public function parseArray()
	{
		if(is_array($this->array))
		{
		} else {
			return false;
		}
	}
	
	public function createCsv()
	{
		$delimiterBreak = PHP_EOL;
		$delimiter = ',';
		$lines = null;
		
		foreach($this->array as $values)
		{
			$lines[] = implode($delimiter, $values);
		}
		
		$this->string = implode($delimiterBreak, $lines);
		return $this->string;
	}
	
	public function exportCsv($fileName)
	{
		$file = fopen($fileName, "w") or die("Unable to open file!");
		fwrite($file, $this->string);
		fclose($file);
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
		
		$this->data = $array;
	}
	
	private function jsonEncoder()
	{
		$encoded = json_encode($this->data);
		return $encoded;
	}
	
	private function jsonDecoder()
	{
		$decoded = json_decode($this->data);
		return $decoded;
	}
	
}