<?php
// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// start a session
session_start();

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

    $view = new Template();
    echo $view -> render("views/bfast.html");
});
// Define a default route
$f3->route('GET /breakfast/green-eggs', function()
{

    $view = new Template();
    echo $view -> render("views/greenEggsAndHam.html");
});
// Define a default route
$f3->route('GET /lunch', function()
{

    $view = new Template();
    echo $view -> render("views/lunch.html");
});

$f3->route('GET|POST /order', function($f3)
{
    // if the data has been submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        var_dump($_POST);
        //array(2) { ["food"]=> string(5) "tacos" ["meal"]=> string(5) "lunch" }

        //validate the data
        $meals = array('breakfast', 'lunch', 'dinner');
        if(empty($_POST['food']) || !in_array($_POST['meal'], $meals)){
            echo "<p>Please enter a food and select a meal</p>";
        }
        //Data is valid
        else{
            // store the data in the session array
            $_SESSION['food'] = $_POST['food'];
            $_SESSION['meal'] = $_POST['meal'];

            // redirect to summary page
            $f3->reroute('summary');
            session_destroy();
        }
    }
    $view = new Template();
    echo $view -> render("views/orderForm.html");
});
$f3->route('GET /summary', function()
{

    $view = new Template();
    echo $view -> render("views/summary.html");
});

// Run fat free
$f3->run();