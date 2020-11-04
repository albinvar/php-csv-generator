<?php
//php-csv class

class PhpCsv {
	
	private $csv;
	
	public function setCsv($file) {
		
		$data = file_get_contents($file);
		$csv = str_getcsv($data);
		$this->csv = $csv;
		
		}
		
	public function createArray() {
		
		
		}
	
	public function getCsv() {
		
		var_dump($this->csv);

		
		}
	};