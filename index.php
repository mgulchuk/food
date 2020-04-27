<?php
// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require the autoload file
require_once('vendor/autoload.php');

// Instantiate the F3 Base class
$f3 = Base::instance();

// Define a default route
$f3->route('GET /', function()
{
    //echo '<h1>Welcome food</h1>';
    $view = new Template();
    echo $view -> render("views/home.html");
});
// Define a default route
$f3->route('GET /breakfast', function()
{
    //echo '<h1>Welcome breakfast</h1>';
    $view = new Template();
    echo $view -> render("views/bfast.html");
});

// Run fat free
$f3->run();