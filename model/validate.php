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
    if (!validEmail($f3->get('email'))) {
        $isValid = false;
        $f3->set("errors['email']", "Please enter your email address.");
    }
    if (!validOutdoor($f3->get('interestOutdoor'))) {
        $isValid = false;
        $f3->set("errors['interestOutdoor']", "Invalid selection");
    }
    if (!validIndoor($f3->get('interestIndoor'))) {
        $isValid = false;
        $f3->set("errors['interestIndoor']", "Invalid selection");
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

function validOutdoor($interestOutdoor)
{
    global $f3;
    // Interests are optional
    if(empty($interestOutdoor)) {
        return true;
    }
    // If there are outdoor interests checked, we need to make sure they're valid
    foreach($interestOutdoor as $interest1) {
        if(!in_array($interest1, $f3->get('interestOutdoor'))) {
            return false;
        }
    }
    // If we're still here, then we have valid outdoor interests
    return true;
}

function validIndoor($interestIndoor)
{
    global $f3;
    // Interests are optional
    if(empty($interestOutdoor)) {
        return true;
    }
    // If there are indoor interests checked, we need to make sure they're valid
    foreach($interestIndoor as $interest2) {
        if(!in_array($interest2, $f3->get('interestOutdoor'))) {
            return false;
        }
    }
    // If we're still here, then we have valid indoor interests
    return true;
}
