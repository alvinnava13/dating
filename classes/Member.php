<?php

/**
 * Class Member represents a member for our dating website.
 *
 * The Member class represents a member with a first and last name,
 * age, gender, and phone number. Regular members do not have access
 * to the interests page (premium members only)
 * @author Alvin Nava <anava8@mail.greenriver.edu>
 * @copyright 2019
 */
class Member
{
    // Fields
    private $_fname;
    private $_lname;
    private $_age;
    private $_gender;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;

    /**
     * Member constructor that creates a new basic member object
     * @param $fname - The first name of the member
     * @param $lname - The last name of the member
     * @param $age - The age of the member
     * @param $gender - The gender of the member
     * @param $phone - The phone number of the memeber
     */
    function __construct($fname, $lname, $age, $gender, $phone)
    {
        $this->_fname = $fname;
        $this->_lname = $lname;
        $this->_age = $age;
        $this->_gender = $gender;
        $this->_phone = $phone;
    }

    /**
     * Function that retrieves the first name of the member
     * @return string - first name of the member
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * Function that sets the first name of the member
     * @param string - The first name of the member
     * @return void
     */
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    /**
     * Function that retrieves the last name of the member
     * @return string - last name of the member
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * Function that sets the last name of the member
     * @param string - The last name of the member
     * @return void
     */
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    /**
     * Function that retrieves the age of the member
     * @return int - age of the member
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * Function that sets the age of the member
     * @param int - age of the member
     * @return void
     */
    public function setAge($age)
    {
        $this->_age = $age;
    }

    /**
     * Function that retrieves the gender of the member
     * @return string - gender of the member
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /**
     * Function that sets the gender of the member
     * @param string - gender of the member
     * @return void
     */
    public function setGender($gender)
    {
        $this->_gender = $gender;
    }

    /**
     * Function that retrieves the phone number of the member
     * @return int - phone number of the member
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * Function that sets the member's phone number
     * @param int - the phone number of the member
     * @return void
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * Function that retrieves the member's email
     * @return string - the member's email
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * Function that sets the member's email
     * @param string - the email of the member
     * @return void
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * Function that retrieves the state the member resides in
     * @return string - the state the member lives in
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * Function that sets the state the member resides
     * @param string - the state
     * @return void
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

    /**
     * Function that retrieves the gender of the partner
     * they are seeking
     * @return string - gender of the partner they're seeking
     */
    public function getSeeking()
    {
        return $this->_seeking;
    }

    /**
     * Function that sets the gender of the partner
     * they are seeking
     * @param string - the gender
     * @return void
     */
    public function setSeeking($seeking)
    {
        $this->_seeking = $seeking;
    }

    /**
     * Function that retrieves the biography the member has
     * entered for themself
     * @return string - a biography of themself
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * Function that sets the biography of a member
     * @param string - the biography the member optionally enters
     * @return void
     */
    public function setBio($bio)
    {
        $this->_bio = $bio;
    }


}