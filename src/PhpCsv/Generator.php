<?php

	/**
	*   Php Csv Generator
	*   Author : Albin Varghese
	*   Date : 18-06-2021
	*/

namespace PhpCsv;

class Generator
{
   /**
	*
    * @var array
    */
	protected $array;
	
    /**
	*
    * @var array
    */
    protected $columns;
    
    /**
	*
    * @var string
    */
    protected $csv;
    
    /**
	*
    * @var string
    */
    protected $json;
    
    /**
	*
    * @var string
    */
    protected $file;
    
    /**
	*
    * @var string
    */
    protected $delimiter = ',';
    
    
    public function __construct()
    {
        //
    }
    
    /**
	 * Set the csv string and parse data.
	 *
	 * @param String $data [Must be the csv string]
	 * @return void
	 */
    public function setCsv(String $data)
    {
        $this->csv = $data;
        $this->parseCsv($data);
    }
    
    /**
	 * Set the csv file by using the path.
	 *
	 * @param String $path [path to the csv file]
	 * @return void
	 */
    public function importCsv(String $path)
    {
        $this->file = $path;
        
        if (!file_exists($this->file)) {
            throw new \Exception('File not found');
        }
        
        $data = file_get_contents($this->file);
        $this->parseCsv($data);
    }
    
    
    /**
	 * Set array to be processed for creating csv string.
	 *
	 * @param Array $array [data contents of the csv string]
	 * @param Array $columns [headings for the csv data]
	 * @return void
	 */
    public function setArray(array $array, array $columns=null)
    {
        $this->columns = $columns;
        $this->array = $array;
        $this->parseArray();
    }
    
    /**
	 * Parse and validate array set using setArray() method
	 *
	 * @return void
	 */
    public function parseArray()
    {
    	//needs improvement.
        $this->validateArray();
    }
    
    /**
	 * Creates csv string from array.
	 *
	 * @return bool
	 */
    public function makeCsv()
    {
        if (!isset($this->array) && !isset($this->columns)) {
            throw new \Exception("Properties not correctly assigned");
        }
        
        $delimiterBreak = PHP_EOL;
        $lines = null;
        
        if (isset($this->columns)) {
            $columns = [$this->columns];
            array_splice($this->array, 0, 0, $columns);
        }
        
        foreach ($this->array as $values) {
            $lines[] = implode($this->delimiter, $values);
        }
        
        $this->csv = implode($delimiterBreak, $lines);
        
        return true;
    }
    
    /**
	 * Returns csv string prepared from makeCsv().
	 *
	 * @return string
	 */
    public function getCsv()
    {
        if (!isset($this->csv)) {
            throw new \Exception('Please convert the data to csv first.');
        }
        
        return $this->csv;
    }
    
    /**
	 * Converts csv string to file and Download it or store in a specific location.
	 *
	 * @param String $fileName [filename to be used for the exported file]
	 * @param Bool $type [export type]
	 * @return void
	 */
    public function exportCsv($fileName='data.csv', $type=true)
    {
        $file = fopen($fileName, "w") or throw new \Exception("Unable to open file!");
        fwrite($file, $this->csv);
        fclose($file);
        if ($type === true) {
            $this->downloadStream($fileName);
        }
    }
    
    /**
	 * Stream exported file to users browser.
	 *
	 * @param String $fileName [filename to be used for the exported file]
	 * @return bool
	 */
    private function downloadStream($filename)
    {
        header('Content-Description: CSV File Download');
        header('Content-Type: application/csv');
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: 0");
        header('Content-Disposition: attachment; filename="'.basename($filename).'"');
        header('Content-Length: ' . filesize($filename));
        header('Pragma: public');
        flush();
        readfile($filename);
        unlink($filename);
        
        return true;
    }
    
    /**
	 * Converts csv string to php array.
	 *
	 * @param String $fileName [filename to be used for the exported file]
	 * @return bool
	 */
    private function parseCsv($data)
    {
        $delimiterBreak = PHP_EOL;
        $array =[];
        
        $lines = explode($delimiterBreak, $data);
        
        foreach ($lines as $line) {
            $array[] = explode($this->delimiter, $line);
        }
        
        $this->array = $array;
        
        return true;
    }
    
    /**
	 * Returns created array.
	 *
	 * @return array
	 */
    public function getArray()
    {
        return $this->array;
    }
    
    /**
	 * Validate's array to be in the correct form.
	 *
	 * @return bool
	 */
    private function validateArray()
    {
        //check if property columns is null.
        if (is_null($this->columns)) {
            $columnCount = count($this->array);
        } elseif (!is_array($this->columns)) {
            throw new \Exception("Columns must be an array");
        } else {
            $columnCount = count($this->columns);
        }
        
        //check if array is an array.
        if (!is_array($this->array)) {
            throw new \Exception("Recived parameter is not an array");
        }
        
        $elementCount = array_map('count', $this->array);
        
        $count = array_sum($elementCount) % $columnCount;
        if ($count !== 0) {
            throw new \Exception("The type of array is invalid.");
        }
        
        return true;
    }
    
    
    /**
	 * Converts php array to json string.
	 *
	 * @param String $fileName [filename to be used for the exported file]
	 * @param Bool $type [export type]
	 * @return string
	 */
    public function exportJson($fileName=null, $type=true)
    {
        if (isset($this->array)) {
            $data = $this->array;
        } else {
            $data = null;
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
    
    /**
	 * Import JSON file and parse data from json string.
	 *
	 * @param String $fileName [filename to be imported for convertion]
	 * @return void
	 */
    public function importJson(String $filename)
    {
        $this->file = $filename;
        
        if (!file_exists($this->file)) {
            throw new \Exception('File not found');
        }
        
        $this->json = file_get_contents($this->file);
        $this->parseJson();
    }
    
    /**
	 * Parses JSON and Converts it to an array.
	 *
	 * @return bool
	 */
    private function parseJson()
    {
        $array = json_decode($this->json, true);
        
        if (is_null($array)) {
            throw new \Exception('Invalid JSON file.');
        }
      
        $this->array = $array;
        
        return true;
    }
    
    /**
	 * Converts array to JSON.
	 *
	 * @return string
	 */
    private function jsonEncoder()
    {
        $encoded = json_encode($this->array);
        return $encoded;
    }
    
    /**
	 * Converts JSON to array.
	 *
	 * @return array
	 */
    private function jsonDecoder()
    {
        $decoded = json_decode($this->array);
        return $decoded;
    }
}
