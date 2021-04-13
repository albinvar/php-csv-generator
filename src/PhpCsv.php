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
		$data = file_get_contents($file);
		
		$this->file = $file;
		$this->data = $data;
	}
	
	
	public function setArray($array)
	{
		$this->setArray = $array;
	}
	
}