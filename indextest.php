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

    $errors = [];
    $fields = ['lastname', 'firstname', 'email','file', 'description'];
    $optionalFields = ['file'];
    $values = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            foreach ($fields as $field){
                if (empty($_POST[$field]) && !in_array($field, $optionalFields)){
                    $errors = [$field];
                } else {
                   $values[$field] = test_input($_POST[$field]);
                }
            }
            if (empty($errors)) {
                foreach ($fields as $field) :
                    switch ($field){
                        case "lastname":
                            if ($field && preg_match("/^[a-zA-Z-']*$/", $field)) {
                                $values[$field] = test_input($_POST[$field]);
                                printf("Good %s: %s<br />", $field, $_POST[$field]);
                            } else {
                                $lastnameErr = "Please enter letters only";
                                printf("Error %s: %s<br />", $field, var_export($_POST[$field], TRUE));
                            } ;
                            break;

                        case "firstname":
                        if ($field && preg_match("/^[a-zA-Z-']*$/", $field)) {
                            $values[$field] = test_input($_POST[$field]);
                            printf("Good %s: %s<br />", $field, $_POST[$field]);
                        } else {
                            $firstnameErr = "Please enter letters only";
                            printf("Error %s: %s<br />", $field, var_export($_POST[$field], TRUE));
                        } ;
                        break;

                        case "email":
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                $values[$field] = test_input($_POST[$field]);
                                printf("Good %s: %s<br />", $field, $_POST[$field]);
                            } else {
                                $emailErr = "Please enter a valid email address";
                                printf("Error %s: %s<br />", $field, var_export($_POST[$field], TRUE));
                            } ;
                            break;

                        case "description":
                            if (filter_var($description, FILTER_SANITIZE_STRING)) {
                                $values[$field] = test_input($_POST[$field]);
                                printf("Good %s: %s<br />", $field, $_POST[$field]);
                            } else {
                                $descriptionErrErr = "Please enter a description";
                                printf("Error %s: %s<br />", $field, var_export($_POST[$field], TRUE));
                            } ;
                            break;

                         }
                    endforeach;

                $isSuccess = $crud->create($_POST['lastname'], $_POST['firstname'], $_POST['email'], $_POST['file'], $_POST['description']);

                if ($isSuccess) {

                    echo "<h4> You message has been sent! </h4>";

                } else {

                    echo "<h4> please fill all the inputs</h4>";
                }

                };

            }

       // var_dump($values);
        var_dump($errors);



/*
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
*/
    ?>

        <section class="reclamation__container">
            <h2 class="reclamation__container__title">Reclamation form</h2>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">


                    <div>
                        <label for="lastname">Last name</label>
                        <input type="text"   name="lastname" value="" >
                        <?php echo $lastnameErr ?>
                    </div>

                    <div>
                        <label for="name">First name</label>
                        <input type="text" name="firstname" value="" >
                        <?php echo $firstnameErr ?>
                    </div>

                    <div>
                        <label for="email">Email</label>
                        <input type="email"  name="email" value="" >
                        <?php echo $emailErr ?>
                    </div>

                    <div>
                        <label for="file">File</label>
                        <input type="file" name="file" value="">
                        <?php echo $fileErr ?>
                    </div>

                    <div>
                        <label for="description">Description</label>
                        <textarea type="text" name="description" rows="6" cols="20" ></textarea>
                        <?php echo $descriptionErr ?>
                    </div>

                    <button type="submit" name="button" value="Enter">Envoyer</button>

                </form>
        </section>
    </body>
</html>