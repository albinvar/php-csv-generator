<?php

namespace PhpCsv;

class Generator
{
	
	protected $array;
	
	protected $columns;
	
	protected $csv;
	
	protected $delimiter = ',';
	
	
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
    
    public function setArray(Array $array, Array $columns=null)
    {
    	$this->columns = $columns;
        $this->array = $array;
        $this->parseArray();
    }
    
    public function parseArray()
    {
    	$this->validateArray();
    }
    
    public function makeCsv()
    {
    	if(!isset($this->array) && !isset($this->columns))
	    {
			throw new \Exception("Properties not correctly assigned");
		}
		
        $delimiterBreak = PHP_EOL;
        $lines = null;
        
        if(isset($this->columns))
        {
        	$columns = [$this->columns];
	        array_splice($this->array, 0, 0, $columns);
        }
        
        foreach($this->array as $values)
        {
            $lines[] = implode($this->delimiter, $values);
        }
        
        $this->csv = implode($delimiterBreak, $lines);
        
        return true;
    }
    
    public function getCsv()
    {
    	if(!isset($this->csv))
	    {
			throw new \Exception('Please convert the data to csv first.');
		}
	    
		return $this->csv;
    }
    
    public function exportCsv($fileName, $type=true)
    {
        $file = fopen($fileName, "w") or die("Unable to open file!");
        fwrite($file, $this->csv);
        fclose($file);
        if ($type === true) {
            $this->downloadStream($fileName);
        }
    }
    
    private function downloadStream($filename)
    {
        
        //Define header information
        header('Content-Description: CSV File Download');
        header('Content-Type: application/csv');
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: 0");
        header('Content-Disposition: attachment; filename="'.basename($filename).'"');
        header('Content-Length: ' . filesize($filename));
        header('Pragma: public');

        //Clear system output buffer
        flush();

        //Read the size of the file
        readfile($filename);
        
        unlink($fileName);
        
        return true;
    }
    
    private function parseCsv($data)
    {
        $delimiterBreak = PHP_EOL;
        $array =[];
        
        $lines = explode($delimiterBreak, $data);
        
        foreach ($lines as $line) {
            $array[] = explode($this->delimiter, $line);
        }
        
        $header = $array[0];
        unset($array[0]);
        $array = ['header' => $header, 'body' => $array];
        
        $this->array = $array;
        
        return true;
    }
    
    private function validateArray()
    {
    	//check if property columns is null.
    	if(is_null($this->columns))
	    {
			$columnCount = count($this->array);
		} elseif(!is_array($this->columns)) {
			throw new \Exception("Columns must be an array");
		} else {
			$columnCount = count($this->columns);
		}
		
		//check if array is an array.
    	if (!is_array($this->array))
	    {
			throw new \Exception("Recived parameter is not an array");
		} 
		
		$elementCount = array_map('count', $this->array);
		
		$count = array_sum($elementCount) % $columnCount;
		if($count !== 0)
		{
			throw new \Exception("The type of array is invalid.");
		}
		
		return true;
    }
    
    public function exportJson($fileName=null, $type=true)
    {
        if (isset($this->array)) {
            $data = $this->array;
        }
        $encoded = json_encode($data, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT);
        
        if ($fileName == null) {
            return $encoded;
        } else {
            $file = fopen($fileName, "w") or die("Unable to open file!");
            fwrite($file, $encoded);
            fclose($file);
            if ($type === true) {
                return $this->downloadStream($fileName);
            }
        }
    }
    
    private function jsonEncoder()
    {
        $encoded = json_encode($this->array);
        return $encoded;
    }
    
    private function jsonDecoder()
    {
        $decoded = json_decode($this->array);
        return $decoded;
    }
}
