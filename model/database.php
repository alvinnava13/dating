<?php

require '/home/anavagre/config-student.php';

/**
 * Class Database connects to our database and allows us to query it
 *
 * The database class allows us to retrieve user info from the database
 * and display it in our admin page for our dating website
 * @author Alvin Nava <anava8@mail.greenriver.edu>
 * @copyright 2019
 */
class Database
{
    // Fields
    private $_dbh;

    /**
     * Database constructor.
     * Allows database object to connect to the database
     */
    function __construct()
    {
        $this->connect();
    }

    /**
     * Function that creates a database object and tries to connect to the
     * database. If it fails, it displays an error message
     * @return PDO a database object
     */
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

    /**
     * Function that uses a query to insert data into our database
     * @param $fname - First name of the user
     * @param $lname - Last name of the user
     * @param $age - Age of the user
     * @param $gender - Gender of the user
     * @param $phone - Phone number of the user
     * @param $email - Email address of the user
     * @param $state - State that the user resides in
     * @param $seeking - Gender that the user is seeking
     * @param $bio - Biography of the user
     * @param $premium - Is the user a premium user or not
     * @param $image - Image uploaded by the user
     */
    function insertMember($fname, $lname, $age, $gender, $phone, $email, $state, $seeking, $bio, $premium, $image)
    {
        // Define the query
        $query = 'INSERT INTO member
                  (fname, lname, age, gender, phone, email, state, seeking, bio, premium, image)
                  VALUES
                  (:fname, :lname, :age, :gender, :phone, :email, :state, :seeking, :bio, :premium, :image)';

        // Prepare the statement
        $statement = $this->_db->prepare($query);

        // Bind the parameters
        $statement->bindParam(':fname', $fname, PDO::PARAM_STR);
        $statement->bindParam(':lname', $lname, PDO::PARAM_STR);
        $statement->bindParam(':age', $age, PDO::PARAM_STR);
        $statement->bindParam(':gender', $gender, PDO::PARAM_STR);
        $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':state', $state, PDO::PARAM_STR);
        $statement->bindParam(':seeking', $seeking, PDO::PARAM_STR);
        $statement->bindParam(':bio', $bio, PDO::PARAM_STR);
        $statement->bindParam(':premium', $premium, PDO::PARAM_INT);
        $statement->bindParam(':image', $image, PDO::PARAM_STR);

        // Execute the query
        $statement->execute();
    }

    /**
     * Function that retrieves all the information from the
     * database about all the users and displays them
     * @return The information of the users
     */
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

    /**
     * Function retrieves all info from the database of specified member id
     * @param $member_id The member id. This function is used to
     * return the info of a certain user with the specified member id
     * @return The information of the users
     */
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

    /**
     * This function retrieves all of the indoor and outdoor interests
     * of the specified member id
     * @param $member_id - The member id of the user being queried
     * @return The list of interests of the user
     */
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