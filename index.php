<?php
session_start();
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

// Define a personal info route
$f3->route('GET /create', function(){

    $_SESSION['firstname'] = $_GET['firstname'];
    $_SESSION['lastname'] = $_GET['lastname'];
    $_SESSION['age'] = $_GET['age'];
    $_SESSION['exampleRadios'] = $_GET['exampleRadios'];
    $_SESSION['number'] = $_GET['number'];

    // Display form2
    $view = new Template();
    echo $view->render('views/info.html');
});

// Define a profile route
$f3->route('GET /info', function(){

    $_SESSION['email'] = $_GET['email'];
    $_SESSION['state'] = $_GET['state'];
    $_SESSION['exampleRadiosSeeking'] = $_GET['exampleRadios'];
    $_SESSION['bio'] = $_GET['bio'];

    // Display form2
    $view = new Template();
    echo $view->render('views/profile.html');
});

// Define an interests route
$f3->route('GET /profile', function(){

    //print_r($_POST);

    // Display form2
    $view = new Template();
    echo $view->render('views/interests.html');
});

// Define a profile summary route
$f3->route('POST /summary', function(){

    $_SESSION['interest'] = $_POST['interest'];

    // Display form2
    $view = new Template();
    echo $view->render('views/summary.html');
});

// Run Fat-free
$f3->run();
