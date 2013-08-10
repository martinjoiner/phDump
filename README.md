phDump
======

PHP Equivalent Version of CF Dump, Cold Fusion's fantastic debugging feature.

How to use
----------

1.  Clone the folder /phDump into your project.

2.  At any point in your PHP code you can get the phDump function like this:

        include('phDump/phDump.inc.php');

    or 

        require_once('phDump/phDump.inc.php');

3.  Then you can simply call phDump like this:

        phDump($myVar)

Screenshot
----------

![Alt text](/docs/phDump-Twitter-Data.png "phDump being used to debug Twitter API data")

It injects CSS and Javascript into the page to make the embedded tables interactive and make the interface a bit sexier.

This project serves the niche group of devs who code in PHP but have also had the privilege to work with Cold Fusion and love the CFDump native function. 