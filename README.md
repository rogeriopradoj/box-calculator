RogerioPradoJ / BoxCalculator
=============================

[![Build Status](https://travis-ci.org/rogeriopradoj/box-calculator.png?branch=master)](https://travis-ci.org/rogeriopradoj/box-calculator)

Série de cálculos usados na Box / some calculations done at Box

Install
-------

```bash
# Install Composer
# https://getcomposer.org/

# Add BoxCalculator
composer require "rogeriopradoj/box-calculator=*"
```

Usage
-----

After installing, you need to require Composer's autoloader:

```php
<?php
require 'vendor/autoload.php';

// or vendor/autoload_52.php if you are in PHP 5.2

$apf = '1234567';

$calculator = new RogerioPradoJ_BoxCalculator_Apf();

$dv = $calculator->dvApf($apf);
```


License
-------
MIT

