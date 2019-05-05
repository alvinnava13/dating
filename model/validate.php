<?php

function validName($name)
{
    return !empty($name) && ctype_alpha($name);
}

function validAge($age)
{
    return !empty($age) && ctype_digit($age) && $age >= 1;
}

function validPhone($number)
{
    return !empty($number) && ctype_digit($number) && strlen($number) == 10;
}

function validEmail($email)
{
    return !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validOutdoor()
{

}

function validIndoor()
{

}
