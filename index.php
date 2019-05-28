<?php
require_once('vendor/autoload.php');

session_start();

ini_set('display_errors', true);
error_reporting(E_ALL);

//Require autoload file
require_once('model/validate.php');

//Create an instance of the Base class
$f3 = Base::instance();

// validate against array
$f3->set("indoorInterests", array('tv', 'puzzles', 'movies', 'reading', 'cooking', 'playing cards', 'board games', 'video games'));
$f3->set("outdoorInterests", array('hiking', 'walking', 'biking', 'climbing', 'swimming', 'collecting'));

//adding array of states
$f3->set('states', array('Alabama','Alaska','Arizona','Arkansas','California',
    'Colorado','Connecticut','Delaware','District of Columbia','Florida','Georgia',
    'Hawaii','Idaho','Illinois','Indiana','Iowa','Kansas','Kentucky','Louisiana',
    'Maine','Maryland','Massachusetts','Michigan','Minnesota','Mississippi','Missouri',
    'Montana','Nebraska','Nevada','New Hampshire','New Jersey','New Mexico','New York',
    'North Carolina','North Dakota','Ohio','Oklahoma','Oregon','Pennsylvania','Rhode Island',
    'South Carolina','South Dakota','Tennessee','Texas','Utah','Vermont','Virginia','Washington',
    'West Virginia','Wisconsin','Wyoming'));

// Define a default route
$f3->route('GET /', function () {
    $view = new Template();
    echo $view->render('views/home.html');
});

// Route to information form
$f3->route('GET|POST /create', function ($f3)
{
    if(!empty($_POST)) {
        //Get data from form
        $first = $_POST['first'];
        $last = $_POST['last'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $membership = $_POST['membership'];

        //Add data to hive
        $f3->set('first', $first);
        $f3->set('last', $last);
        $f3->set('age', $age);
        $f3->set('gender', $gender);
        $f3->set('phone', $phone);
        $f3->set('membership', $membership);

        //If data is valid
        if (validForm()) {
            //Write data to Session
            $_SESSION['first'] = $first;
            $_SESSION['last'] = $last;
            $_SESSION['age'] = $age;
            $_SESSION['phone'] = $phone;
            if (empty($gender)) {
                $_SESSION['gender'] = "No gender selected";
            } else {
                $_SESSION['gender'] = $gender;
            }
            if($membership === "premium")
            {
                $member = new PremiumMember($first, $last, $age, $gender, $phone);
            }
            else
            {
                $member = new Member($first, $last, $age, $gender, $phone);
            }
            $_SESSION['member'] = $member;
            $f3->reroute('/profile');
        }
    }
    $view = new Template();
    echo $view->render('views/info.html');
});
$f3->route('GET|POST /profile', function ($f3)
{
    if(!empty($_POST)) {
        //Get data from form
        $email = $_POST['email'];
        $state = $_POST['state'];
        $bio = $_POST['bio'];
        $seeking = $_POST['seeking'];

        //Add data to hive
        $f3->set('email', $email);
        $f3->set('state', $state);
        $f3->set('bio', $bio);
        $f3->set('seeking', $seeking);

        //If data is valid
        if (validForm2()) {
            //Write data to Session
            $_SESSION['email'] = $email;
            $_SESSION['state'] = $state;
            if (empty($bio)) {
                $_SESSION['bio'] = "No biography";
            }
            else {
                $_SESSION['bio'] = $bio;
            }
            if (empty($seeking)) {
                $_SESSION['seeking'] = "Not seeking any";
            }
            else {
                $_SESSION['seeking'] = $seeking;
            }
            $member = $_SESSION['member'];
            $member->setEmail($email);
            $member->setState($state);
            $member->setBio($bio);
            $member->setSeeking($seeking);
            $_SESSION['member'] = $member;
            if($member instanceof PremiumMember)
            {
                $f3->reroute('/interests');
            }

            $f3->reroute('/summary');
        }
    }
    $view = new Template();
    echo $view->render('views/profile.html');
});
$f3->route('GET|POST /interests', function ($f3)
{
    if(!empty($_POST)) {
        //Get data from form
        $indoor = $_POST['indoor'];
        $outdoor = $_POST['outdoor'];
        //Add data to hive
        $f3->set('indoor', $indoor);
        $f3->set('outdoor', $outdoor);
        //If data is valid
        if (validForm3()) {
            //Write data to Session
            if (empty($indoor)) {
                $_SESSION['indoor'] = ["No indoor interests selected"];
            }
            else {
                $_SESSION['indoor'] = implode(", ", $_POST['indoor']);
            }
            if (empty($outdoor)) {
                $_SESSION['outdoor'] = ["No outdoor interests selected"];
            }
            else {
                $_SESSION['outdoor'] = implode(", ", $_POST['indoor']);
            }
            $_SESSION['member']->setInDoorInterests($indoor);
            $_SESSION['member']->setOutDoorInterests($outdoor);
            $f3->reroute('/summary');
        }
    }
    $view = new Template();
    echo $view->render('views/interests.html');
});
$f3->route('GET|POST /summary', function ()
{
    $view = new Template();
    echo $view->render('views/summary.html');
});

// Define a route when nav bar is clicked
$f3->route('GET /home', function(){

    $view = new Template();
    echo $view->render('views/home.html');
});


// Admin route to view admin page
$f3->route('GET /admin', function($f3) {

    global $db;

    $members = $db->getMembers();

    $f3->set('members', $members);
    $f3->set('db', $db);

    $view = new Template();
    echo $view->render('views/admin.html');
});
//Run fat-free
$f3->run();
