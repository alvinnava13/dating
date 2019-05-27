<?php

require '/home/anavagre/config-student.php';

class Database
{
    private $_dbh;

    function __construct()
    {
        $this->connect();
    }

    function connect()
    {
        try {
            //Instantiate a db object
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            echo "Connected!!!";
            return $this->_dbh;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    function insertMember()
    {

    }

    function getMembers()
    {
        // Define query
        $query = "SELECT * FROM member
                  ORDER BY lname ASC";

        // Prepare the statement
        $statement = $this->_db->prepare($query);

        // Execute the query
        $statement->execute();

        // Get results
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    function getMember($member_id)
    {
        // Define query
        $query = "SELECT * FROM member
                  WHERE member_id = :member_id";

        // Prepare the statement
        $statement = $this->_db->prepare($query);

        // Bind the parameters
        $statement->bindParam(':member_id', $member_id);

        // Execute the query
        $statement->execute();

        // Get results
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    function getInterests($member_id)
    {
        // Define query
        $query = "SELECT interest, type
                  FROM interest
                  INNER JOIN memberinterest
                  ON member_interest.interest_id = interest.interest_id
                  WHERE member_id = :member_id";

        // Prepare statement
        $statement = $this->_db->prepare($query);

        // Bind the parameters
        $statement->bindParam(':member_id', $member_id);

        // Execute the query
        $statement->execute();
        //get results
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
}