<?php

namespace PhpCsv;

class Generator
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
    
    public function setArray($columns, $array)
    {
    	$this->columns = $columns;
        $this->array = $array;
        $this->parseArray();
    }
    
    public function parseArray()
    {
    	$this->validateArray();
        if (is_array($this->array)) {
        } else {
            return false;
        }
    }
    
    public function createCsv()
    {
        $delimiterBreak = PHP_EOL;
        $delimiter = ',';
        $lines = null;
        
        foreach ($this->array as $values) {
            $lines[] = implode($delimiter, $values);
        }
        
        $this->string = implode($delimiterBreak, $lines);
        return $this->string;
    }
    
    public function exportCsv($fileName, $type=true)
    {
        $file = fopen($fileName, "w") or die("Unable to open file!");
        fwrite($file, $this->string);
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
        $delimiter = ',';
        $array =[];
        
        $lines = explode($delimiterBreak, $data);
        
        foreach ($lines as $line) {
            $array[] = explode($delimiter, $line);
        }
        
        $header = $array[0];
        unset($array[0]);
        $array = ['header' => $header, 'body' => $array];
        
        $this->array = $array;
    }
    
    private function validateArray()
    {
		$elementCount = array_map('count', $this->array);
		
		$count = array_sum($elementCount) % count($this->columns);
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
