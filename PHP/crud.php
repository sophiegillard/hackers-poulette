<?php

class crud
{
    //private database object
    private $db;

    //constructor to initialize private variable to the database connection
    function __construct($conn){
        $this->db = $conn;
    }

    public function display(){
        try{
            //define sql statement to be executed
            $query = 'SELECT * FROM `claims`';
            //prepare the sql statement for execution
            $stmt = $this->db->prepare($query);
            //execute statment
            $stmt->execute();
            $results=$stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($results as $result):
                ?>
                <tr>
                    <td><?php echo $result['lastname']; ?> </td>
                    <td><?php echo $result['firstname']; ?> </td>
                    <td><?php echo $result['email']; ?> </td>
                    <td><?php echo $result['description']; ?> <td>

                </tr>
            <?php
            endforeach;

            return $results;

        } catch (PDOException $e){
            error_log('The error is')->getMessage();
        }
    }

    public function create( $lastname, $firstname, $email, $file, $description){
        try{
            //define sql statement to be executed
            $query = "INSERT INTO `claims` (lastname, firstname, email, file, description) VALUES (:lastname, :firstname, :email, :file, :description)";

            //prepare the sql statement for execution
            $stmt = $this->db->prepare($query);

            //bind all placeholders to actual values
            $stmt -> bindParam(':lastname', $lastname);
            $stmt -> bindParam(':firstname', $firstname);
            $stmt -> bindParam(':email', $email);
            $stmt -> bindParam(':file', $file);
            $stmt -> bindParam(':description', $description);

            //execute statment
            $stmt->execute();

            return true;

        } catch (PDOException $e){
            error_log('The error is')->getMessage();
            return false;
        }
    }
}