<?php
// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require autoload file
require_once('vendor/autoload.php');

// Create an instance of the Base class
$f3 = Base::instance();

// Turn on Fat-Free error reporting
$f3->set('DEBUG', 3);

// Define a default route
$f3->route('GET /', function () {

    // Display a view
    $view = new Template();
    echo $view->render('views/home.html');
});

// Define an personal info route
$f3->route('POST /order-process', function(){

    //print_r($_POST);
    //$_SESSION['food'] = $_POST['food'];

    // Display form2
    $view = new Template();
    echo $view->render('views/info.html');
});

// Run Fat-free
$f3->run();
