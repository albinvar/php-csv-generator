<h1 align="center"> Php-Csv Class </h1> 


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
composer require albinvar/php-csv
```

Attach the library to your php code.

```php
<?php

use App\PhpCsv;

require_once("./vendor/autoload.php");

$obj = new PhpCsv();

```

### Manual installation

- Download the script from here.
- Add the script to your php code.

```php
<?php

require_once "PhpCsv.php";

```

## Updation

```php
composer update albinvar/php-csv-class
```

## Features

- Convert CSV to php array
- Convert array to CSV format
- Convert array & CSV to json
- Export JSON format and save or stream json file
- Export CSV file & save to preferred location
- Export CSV file & Stream to browser

## Contributing

## License
MIT. See [LICENSE](LICENSE) for more details.
