<?php
//php-csv class

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
		
	private function createArray() {
		
		$string = $this->data;
		$delimiter=',';
		$header = NULL;
        $data = [];
        $rows = explode(PHP_EOL, $string); 
        foreach($rows as $row_str) {
            $row = str_getcsv($row_str);
            if(!$header)
            {
               $header = $row;
            }
            else
            {
                if(count($header)!=count($row)){ continue; }

                $data[] = array_combine($header, $row);
            }
        }
        $this->resultArray = $data;
        return $this->resultArray;
        
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