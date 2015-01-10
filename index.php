<?php

// Kickstart the framework
$f3=require('lib/base.php');

$f3->set('DEBUG',1);
if ((float)PCRE_VERSION<7.9)
	trigger_error('PCRE version is out of date');

$db=new DB\SQL(
    'mysql:host=localhost;port=3306;dbname=test',
    'root',
    'pass4root'
);

$f3->set('AUTOLOAD','app/');

// Load configuration
$f3->config('config.ini');

$f3->run();
