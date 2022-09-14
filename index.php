<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Claim Form</title>
        <style>
            .error {color : red;}
        </style>
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


    <h2>Reclamation form</h2>
        <form method="post" action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">

            <div>
                <label for="name">First name</label>
                <input type="text" name="firstname" value="" >
                <?php echo $firstnameErr ?>
            </div>

            <div>
                <label for="lastname">Last name</label>
                <input type="text"   name="lastname" value="" >
                <?php echo $lastnameErr ?>
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


        <?php
        //DISPLAY DATAS
        try {
            $crud->display();


        } catch (Exception $e) {
            die('Erreur : '.$e->getMessage(). " la ligne est". $e->getLine());
        }
        ?>
    </body>
</html>