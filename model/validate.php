<?php

function validForm()
{
    global $f3;
    $isValid = true;
    if (!validFirst($f3->get('firstname'))) {
        $isValid = false;
        $f3->set("errors['firstname']", "Please enter your first name.");
    }

    if (!validLast($f3->get('lastname'))) {
        $isValid = false;
        $f3->set("errors['lastname']", "Please enter your last name.");
    }

    if (!validAge($f3->get('age'))) {
        $isValid = false;
        $f3->set("errors['age']", "Please enter your age.");
    }
    if (!validPhone($f3->get('number'))) {
        $isValid = false;
        $f3->set("errors['number']", "Please enter your phone number.");
    }

    return $isValid;
}



function validForm2()
{
    global $f3;
    $isValid = true;

    if (!validEmail($f3->get('email'))) {
        $isValid = false;
        $f3->set("errors['email']", "Please enter your email address.");
    }

    return $isValid;
}



function validForm3()
{
    global $f3;
    $isValid = true;

    if (!validOutdoor($f3->get('outdoor'))) {
        $isValid = false;
        $f3->set("errors['outdoor']", "Invalid selection");
    }
    if (!validIndoor($f3->get('indoor'))) {
        $isValid = false;
        $f3->set("errors['indoor']", "Invalid selection");
    }

    return $isValid;
}

function validFirst($firstname)
{
    return !empty($firstname) && ctype_alpha($firstname);
}

function validLast($lastname)
{
    return !empty($lastname) && ctype_alpha($lastname);
}

function validAge($age)
{
    return !empty($age) && ctype_digit($age) && ($age >= 18 && $age<=118);
}

function validPhone($number)
{
    return !empty($number) && ctype_digit($number) && strlen($number) == 10;
}

function validEmail($email)
{
    return !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validOutdoor($outdoor)
{
    global $f3;
    // Interests are optional
    if(empty($outdoor)) {
        return true;
    }
    // If there are outdoor interests checked, we need to make sure they're valid
    foreach($outdoor as $interest) {
        if(!in_array($interest, $outdoor)) {
            return false;
        }
    }
    // If we're still here, then we have valid outdoor interests
    return true;
}

function validIndoor($indoor)
{
    global $f3;
    // Interests are optional
    if(empty($indoor)) {
        return true;
    }
    // If there are indoor interests checked, we need to make sure they're valid
    foreach($indoor as $interest) {
        if(!in_array($interest, $indoor)) {
            return false;
        }
    }
    // If we're still here, then we have valid indoor interests
    return true;
}
