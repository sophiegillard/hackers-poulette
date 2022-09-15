<?php

//Call all the necessary files with functions
require 'conn.php';
require 'test.php';

//Define variables and set to empty
$lastname = $firstname = $email = $file = $description = "";
$lastnameErr = $firstnameErr = $emailErr = $fileErr = $descriptionErr = $successMessage = $errorMessageGeneral = "";


//Check the inserted datas in the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Check last Name
    if (empty($_POST['lastname'])) {
        $lastnameErr = "Please enter a valid name";
    } else {
        $lastname = test_input($_POST['lastname']);
        if (!preg_match("/^[a-zA-Z-']*$/", $lastname)) {
            $lastnameErr = "Only letters";
        }
    }

    //Check first Name
    if (empty($_POST['firstname'])) {
        $firstnameErr = "Please enter a valid first name";
    } else {
        $firstname = test_input($_POST['firstname']);
        if (!preg_match("/^[a-zA-Z-']*$/", $firstname)) {
            $firstnameErr = "Only letters";
        }
    }

    //Check email
    if (empty($_POST['email'])) {
        $emailErr = "Please enter a valid email address";
    } else {
        $email = test_input($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Please enter a correct email address : exemple@gmail.com";
        }
    }

    //Check file
    if (empty($_POST['file'])) {
        $fileErr = "No file added";
    } else {
        $file = test_input($_POST['file']);
    }

    //Check description
    if (empty($_POST['description'])) {
        $descriptionErr = "Please enter a description";
    } else {
        $description = test_input($_POST['description']);
        if (!filter_var($description, FILTER_SANITIZE_STRING)) {
            echo $description;
        }
    }

    //Check if all inputs are completed
    if (!(empty($_POST['lastname']) || empty($_POST['firstname']) || empty($_POST['email']) || empty($_POST['description']))) {
        //Send the datas to db if no empty inputs
        if (isset($_POST['lastname'], $_POST['firstname'], $_POST['email'], $_POST['description'])) {
            // CALL function to insert and track if success or not
            $isSuccess = $crud->create($lastname, $firstname, $email, $file, $description);

            if ($isSuccess) {

                $successMessage = "You message has been sent!";

            } else {

                $errorMessageGeneral = "Please fill all the inputs as asked";
            }
        }
    } else {
        $errorMessageGeneral = "Please fill all the inputs as asked";
    }
}
