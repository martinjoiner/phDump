phDump
======

This is a PHP equivalent of CFDump, ColdFusion's fantastic visual debugging feature.

## How to use

1\.  Clone the repo into your project. 
``` 
        git clone https://github.com/martinjoiner/phDump.git .
```

2\.  At any point in your PHP code you can get the phDump function like this:
```php
        require 'phDump/phDump.inc.php';
```

3\.  Then you can simply call the phDump() function like this:
```php
        phDump($myVar);
```

## Screenshot

The image below shows phDump neatly and clearly displaying the complicated data structure returned by Twitter's API, making it easier to understand.

![phDump being used to debug Twitter API data](/docs/phDump-Twitter-Data.png)

It injects CSS and Javascript into the page to make a sexy and interactive interface. Click on any table head or label cell to collapse/expand it. Good for tidying up hectic screens.

## Code notes

In order to fit the whole shebang into one file I have broken best-practice convension and included the class definition and `phDump()` function in the same file.  

## Who the chuffing badger wants this?

This project serves the niche group of developers who have worked with Cold Fusion and love the native CFDump function but also code in PHP and want an equivalent. 
