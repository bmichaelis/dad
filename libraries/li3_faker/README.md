# Lithium adapter for Faker

`li3_faker` library provides a Lithium's ORM/ODM adapter to [Faker](http://github.com/fzaninotto/Faker).

## Usage Example

Here is an example showing how to populate 5 `People` objects, and save the
records or documents in the database.

```php
use faker\Factory;
use li3_faker\extensions\adapter\ORM\Lithium\Populator;

$generator = Factory::create();
$populator = new Populator($generator);
$populator->addEntity('People', 5);
$people_ids = $populator->execute();
```

The populator uses name and column type guessers to populate each column with relevant data.

For a more advanced usage, take a look to [Faker](http://github.com/fzaninotto/Faker) docs.

## Installation

This is installable via [Composer](https://getcomposer.org/) as [mehlah/li3_faker](https://packagist.org/packages/mehlah/li3_faker).

Don't forget to add the library to your application in `config/bootstrap/libraries.php`

    Libraries::add('li3_faker');

