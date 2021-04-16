<h1 align="center"> Php-Csv Generator</h1> 


## Table of Contents 
- [Introduction](#introduction)
- [Installation](#installation)
- [Features](#features)
- [Contributing](#contributing)
- [License](#license)

## Introduction

A simple php library used to generate php array to csv, json and csv to php array and json.

## Installation

```php
composer require albinvar/php-csv-generator
```

Attach the library to your php code.

```php
<?php

use PhpCsv\Generator;

require_once("./vendor/autoload.php");

$obj = new Generator();

```

### Manual installation

- Download the script from here.
- Add the script to your php code.

```php
<?php

require_once "Generator.php";

```

## Updation

```php
composer update albinvar/php-csv-generator
```

## Features

- Convert CSV to php array
- Convert array to CSV format
- Convert array & CSV to json
- Export JSON format and save or stream json file
- Export CSV file & save to preferred location
- Export CSV file & Stream to browser

## CSV to Array

You can convert a csv file to an array using the following example.

```php
<?php

use PhpCsv\Generator;

require_once("./vendor/autoload.php");

$object = new Generator();
$object->setCsv('data.csv');
$array = $object->createArray();

var_dump($array);
```

## Array to CSV

You can convert an array into a csv file using the following example.

```php
<?php

use PhpCsv\Generator;

require_once("./vendor/autoload.php");

$array = [ 
	['Name', 'Class'],
	['John', 28],
	['Johana', 23],
	['Adam', 32],
];

$object = new Generator();
$object->setArray($array);
$object->createCsv();
$object->exportCsv('data.csv', true);

```

```$object->exportCsv('data.csv', true);``` The first argument excepts the filenams and 2nd argument excepts the download type which expects a boolean format.

## Export to JSON format

You can export to JSON from both CSV or Array
The first argument excepts the filenams and 2nd argument excepts the download type which expects a boolean format.

```php
// returns json string
echo $object->exportJson();

// creates json file and download to browser
$object->exportJson('data.json', true);

// creates json file and saves it to specific location.
$object->exportJson('data.json', false);
```

## Contributing

Pull requests are always welcome...

## License
MIT. See [LICENSE](LICENSE) for more details.
