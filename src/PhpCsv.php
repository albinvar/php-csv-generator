<?php

namespace App;

class PhpCsv {
	
	private $file;
	private $data;
	public $resultArray;
	
	public function setCsv($file) {
		
		$data = file_get_contents($file);
		$this->file = $file;
		$this->data = $data;
		
		}
		
	public function setArray($array) {
		
	$this->setArray = $array;
	
		
		}
		
	public function createArray() {
		
		$string = $this->data;
		$delimiter=',';
		$header = NULL;
        $data = [];
        $rows = explode(PHP_EOL, $string); 
        $header = $rows[0];//creates a copy of csv header array
unset($rows[0]);//removes the header from $csv_data since no longer needed
foreach($rows as $row){
	var_dump($header);
	var_dump($row);
    $row = array_combine($header, $row);// adds header to each row as key
    var_dump($row);//do something here with each row
}
//foreach($records as $test) {
            //var_dump($element);
            //$test[] = array_combine($header, $element);

//}

        
		}
	
	public function createCsv($array) {
	
	
	$pathToGenerate = 'array.csv'; 
    $header=null;
    $createFile = fopen($pathToGenerate,"w+");
	 
    foreach ($array as $row) {

        if(!$header) {

            fputcsv($createFile,array_keys($row));
            fputcsv($createFile, $row);  
            $header = true;
        }
        else {

            fputcsv($createFile, $row);
        }
    }
    fclose($createFile);
	echo "success";
	}
	
	public function getArray() {
		
		return $this->createArray();
		
		}
		
	public function getCsv($array) {
		
		return $this->createCsv($array);
		
		}
	
	};