<?php

/**
 * Class PremiumMember represents a premium member for our
 * dating website
 *
 * A premium member has a first and last name, age, gender, and phone fields
 * and is able to to make selections on the interests page
 * @author Alvin Nava <anava8@mail.greenriver.edu
 * @copyright 2019
 */

class PremiumMember extends Member
{
    // Fields
    private $_inDoorInterests;
    private $_outDoorInterests;

    /**
     * PremiumMember constructor that creates a new
     * premium member object
     * @param $fname string - The first name of the premium member
     * @param $lname string - The last name of the premium member
     * @param $age int - The age of the premium member
     * @param $gender string - The gender of the premium member
     * @param $phone int - The phone number of the premium member
     */
    function __construct($fname, $lname, $age, $gender, $phone)
    {
        parent::__construct($fname, $lname, $age, $gender, $phone);
    }

    /**
     * Function that retrieves the member's indoor interests
     * @return - The indoor interest(s)
     */
    public function getInDoorInterests()
    {
        return $this->_inDoorInterests;
    }

    /**
     * Function that sets the indoor interests of the member
     * @param string - The indoor interests
     * @return void
     */
    public function setInDoorInterests($inDoorInterests)
    {
        $this->_inDoorInterests = $inDoorInterests;
    }

    /**
     * Function that retrieves the member's outdoor interests
     * @return - The outdoor interest(s)
     */
    public function getOutDoorInterests()
    {
        return $this->_outDoorInterests;
    }

    /**
     * Function that sets the outdoor interests of the member
     * @param string - The outdoor interests
     * @return void
     */
    public function setOutDoorInterests($outDoorInterests)
    {
        $this->_outDoorInterests = $outDoorInterests;
    }


}