<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Claim Form</title>
    <link rel="stylesheet" href="style/style.css">
    <link href="//db.onlinewebfonts.com/c/768446cc3d04d6dd3289ae1715bdb682?family=GT+Walsheim+Regular" rel="stylesheet" type="text/css"/>
</head>
<body>

<?php
//Call all the necessary files with functions
require 'PHP/conn.php';
require 'PHP/test.php';

//Define variables and set to empty
$lastname = $firstname = $email = $file = $description = "";
$lastnameErr = $firstnameErr = $emailErr = $fileErr = $descriptionErr = "";


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
        if(!filter_var($description, FILTER_SANITIZE_STRING)){
            echo $description;
        }
    }

    //Check if all inputs are completed
    if (!(empty($_POST['lastname']) || empty($_POST['firstname']) || empty($_POST['email']) || empty($_POST['description']))){
        //Send the datas to db if no empty inputs
        if (isset($_POST['lastname'], $_POST['firstname'], $_POST['email'], $_POST['description'])) {
            // CALL function to insert and track if success or not
            $isSuccess = $crud->create($lastname, $firstname, $email, $file, $description);

            if ($isSuccess) {

                echo "<h4> You message has been sent! </h4>";

            } else {

                echo "<h4> please fill all the inputs</h4>";
            }
        }
    }else{
        echo "<h4> please fill all the inputs</h4>";
    }
}
?>

<section class="reclamation__container">
    <h2 class="reclamation__container__title">Reclamation form</h2>
    <form class="reclamation__container__form" method="post" action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">

        <div class="reclamation__div">
            <label for="name">First name</label>
            <input type="text" name="firstname" value="" >
            <p class="error firstnameErr"><?php echo $firstnameErr ?></p>
        </div>

        <div class="reclamation__div">
            <label for="lastname">Last name</label>
            <input type="text"   name="lastname" value="" >
            <?php echo $lastnameErr ?>
        </div>

        <div class="reclamation__div">
            <label for="email">Email</label>
            <input type="email"  name="email" value="" >
            <?php echo $emailErr ?>
        </div>

        <div class="reclamation__div file" >
            <label for="file" id="file__title">Attachments(optional)</label>
            <div class="file__attachment">
                <input type="file" name="file" class="file__attachment__browser">
                <span class="file__attachment__title">Add file</span>
            </div>
            <?php echo $fileErr ?>
        </div>


        <div class="reclamation__div">
            <label for="description">Description</label>
            <textarea type="text" name="description" rows="6" cols="20" ></textarea>
            <?php echo $descriptionErr ?>
        </div>

        <button type="submit" name="button" value="Enter">Envoyer</button>

    </form>
</section>
</body>
</html>