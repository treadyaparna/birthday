This project is to print the names of people whose birthday is today from the JSON list. If a person is born on 29th February, his birthday will be considered as 28th February in a leap year.

# Technologies
Project is created with:
* PHP `8.1.16`
* PHPUnit `10.0.15`
* Composer `2.5.4`

# Setup

To install dependencies run,
```shell
composer install 
```

# How-To Run

To run the project in [http://localhost:8080](http://localhost:8080)

```shell
php -S localhost:8080 -t .
```

To run unit tests,

```shell
phpunit tests
```

# Sample Input File
Here is the input file [birthdays.json](./data/birthdays.json)

```
[
  ["Doe", "John", "1982/10/08"],
  ["Wayne", "Bruce", "1965/01/30"],
  ["Gaga", "Lady", "1986/03/28"],
  ["Curry", "Mark", "1988/02/29"],
  ["Can", "Hurry", "1980/03/10" ],
  ["Saha", "Aparna", "2000/03/10"],
  ["Smith", "John", "2022/03/10"]
]
```

# Folder Structure
Here's the folder structure,
```
|____index.php
|____tests
| |____Controller
| | |____BirthdayControllerTest.php
| |____Service
| | |____DateServiceTest.php
| |____Assets
|____README.md
|____.gitignore
|____data
| |____birthdays.json
|____composer.json
|____src
| |____Config
| | |____Config.php
| |____Controller
| | |____BirthdayController.php
| |____Service
| | |____JsonDataService.php
| | |____DateService.php
```

`./tests/Assets` folder should have read-write permission. Run `chmod 755`

# Output

Here's output on 10.03.2023,
``` 
Can,Hurry
Saha,Aparna
Smith,John
```

Here's tests output,
``` 
PHPUnit 10.0.15 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.1.16

........                                                            8 / 8 (100%)

Time: 00:00.004, Memory: 22.30 MB

OK (8 tests, 9 assertions)
```

# Possible changes
1. Use `Mockery` in tests
2. Implement factory to remove `required_once()` statements.
3. Output could be dockerized
