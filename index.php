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

    // Display form2
    $view = new Template();
    echo $view->render('views/info.html');
});

// Define a profile route
$f3->route('POST /profile', function(){

    $_SESSION['firstname'] = $_POST['firstname'];
    $_SESSION['lastname'] = $_POST['lastname'];
    $_SESSION['age'] = $_POST['age'];
    $_SESSION['gender'] = $_POST['exampleRadios'];
    $_SESSION['number'] = $_POST['number'];


    // Display form2
    $view = new Template();
    echo $view->render('views/profile.html');
});

// Define an interests route
$f3->route('POST /interests', function(){

    $_SESSION['email'] = $_POST['email'];
    $_SESSION['state'] = $_POST['state'];
    $_SESSION['exampleRadiosSeeking'] = $_POST['exampleRadios'];
    $_SESSION['bio'] = $_POST['bio'];

    // Display form2
    $view = new Template();
    echo $view->render('views/interests.html');
});

// Define a profile summary route
$f3->route('POST /summary', function(){

    $selectIndoor = join(', ', $_POST['interestIndoor']);
    $selectedIndoor = trim($selectIndoor);

    $selectOutdoor = join(', ', $_POST['interestOutdoor']);
    $selectedOutdoor = trim($selectOutdoor);

    $_SESSION['interestIndoor'] = $selectedIndoor;
    $_SESSION['interestOutdoor'] = $selectedOutdoor;

    // Display form2
    $view = new Template();
    echo $view->render('views/summary.html');
});

// Define a personal info route
$f3->route('GET /home', function(){

    // Display form2
    $view = new Template();
    echo $view->render('views/home.html');
});

// Run Fat-free
$f3->run();
