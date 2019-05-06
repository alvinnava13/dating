<?php
session_start();
// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require autoload file
require_once('vendor/autoload.php');
require_once('model/validate.php');

// Create an instance of the Base class
$f3 = Base::instance();

// Turn on Fat-Free error reporting
$f3->set('DEBUG', 3);

// Define arrays
$f3->set('interestIndoor', array('tv', 'puzzles', 'movies', 'reading',
    'cooking', 'playing cards', 'board games', 'video games'));
$f3->set('interestOutdoor', array('hiking', 'walking', 'biking',
    'climbing', 'swimming', 'collecting'));

// Define a default route
$f3->route('GET /', function () {

    // Display a view
    $view = new Template();
    echo $view->render('views/home.html');
});

// Define a personal info route
$f3->route('GET|POST /create', function($f3) {
    // If form has been submitted, validate
    if(!empty($_POST)) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $age = $_POST['age'];
        $number = $_POST['number'];
        $gender = $_POST['gender'];

        $_SESSION['gender'] = $gender;


        // Add data to hive
        $f3->set('firstname', $firstname);
        $f3->set('lastname', $lastname);
        $f3->set('age', $age);
        $f3->set('number', $number);
        $f3->set('gender', $gender);

        // If data is valid
        if (validForm()) {
            // Write data to Session
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['age'] = $age;
            $_SESSION['number'] = $number;

            // Redirect to next form page
            $f3->reroute('/profile');
        }



        /*if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['age']) && isset($_POST['number']))
        {
            $f3->reroute('/profile');
        }*/

    }

    // Display form2
    $view = new Template();
    echo $view->render('views/info.html');
});


// Define a profile route
$f3->route('GET|POST /profile', function($f3){

    if(!empty($_POST))
    {
        $email = $_POST['email'];
        $state = $_POST['state'];
        $exampleRadiosSeeking = $_POST['exampleRadios'];
        $bio = $_POST['bio'];

        $f3->set('email', $email);
        $f3->set('state', $state);
        $f3->set('exampleRadiosSeeking', $exampleRadiosSeeking);
        $f3->set('bio', $bio);

        if(validForm2()) {

            $_SESSION['email'] = $email;
            $_SESSION['state'] = $state;
            $_SESSION['exampleRadiosSeeking'] = $exampleRadiosSeeking;
            $_SESSION['bio'] = $bio;

            $f3->reroute('/interests');
        }
    }




    // Display form2
    $view = new Template();
    echo $view->render('views/profile.html');
});

// Define an interests route
$f3->route('GET|POST /interests', function(){

    $selectIndoor = join(', ', $_POST['interestIndoor']);
    $selectedIndoor = trim($selectIndoor);

    $selectOutdoor = join(', ', $_POST['interestOutdoor']);
    $selectedOutdoor = trim($selectOutdoor);

    $_SESSION['interestIndoor'] = $selectedIndoor;
    $_SESSION['interestOutdoor'] = $selectedOutdoor;

    // Display form2
    $view = new Template();
    echo $view->render('views/interests.html');
});

// Define a profile summary route
$f3->route('GET|POST /summary', function(){

    /*$selectIndoor = join(', ', $_POST['interestIndoor']);
    $selectedIndoor = trim($selectIndoor);

    $selectOutdoor = join(', ', $_POST['interestOutdoor']);
    $selectedOutdoor = trim($selectOutdoor);

    $_SESSION['interestIndoor'] = $selectedIndoor;
    $_SESSION['interestOutdoor'] = $selectedOutdoor;*/

    // Display form2
    $view = new Template();
    echo $view->render('views/summary.html');
});


// Define a route when nav bar is clicked
$f3->route('GET /home', function(){

    $view = new Template();
    echo $view->render('views/home.html');
});

//Define a summary route
$f3->route('GET|POST /summary', function() {

    //Display summary
    $view = new Template();
    echo $view->render('views/summary.html');
});

// Run Fat-free
$f3->run();
