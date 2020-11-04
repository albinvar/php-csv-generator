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
	
	public function getArray() {
		
		return var_dump($this->createArray());
		
		}
	};