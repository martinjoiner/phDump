phDump
======

This is a PHP equivalent version of CFDump, Cold Fusion's fantastic debugging feature.

How to use
----------

1.  Clone the folder /phDump into your project.

2.  At any point in your PHP code you can get the phDump function like this:

        include('phDump/phDump.inc.php');

    or 

        require_once('phDump/phDump.inc.php');

3.  Then you can simply call phDump like this:

        phDump($myVar);

Screenshot
----------

The image below shows phDump neatly and clearly displaying the complicated data structure returned by Twitter's API, making it easier to understand.

![Alt text](/docs/phDump-Twitter-Data.png "phDump being used to debug Twitter API data")

It injects CSS and Javascript into the page to make a sexy and interactive interface. Click on any table head or label cell to collapse/expand it. Good for tidying up hectic screens.

Who the chuffing badger wants this?
-----------------------------------

This project serves the niche group of developers who have worked with Cold Fusion and love the native CFDump function but also code in PHP and want an equivalent. 
