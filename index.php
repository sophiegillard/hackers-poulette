<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Claim Form</title>
    </head>
    <body>
        <h2>Reclamation form</h2>
        <form method="post" action="index.php">

            <div>
                <label for="name">First name</label>
                <input type="text" name="firstname" value="" required >
            </div>

            <div>
                <label for="lastname">Last name</label>
                <input type="text"   name="lastname" value="" required>
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email"  name="email" value="" required>
            </div>

            <div>
                <label for="file">File</label>
                <input type="file" name="file" value="">
            </div>

            <div>
                <label for="description">Description</label>
                <textarea type="text" name="description" rows="6" cols="20" required></textarea>
            </div>

            <button type="submit" name="button" value="Enter">Envoyer</button>

        </form>

        <?php
        require 'PHP/conn.php';

        if (isset($_POST['lastname'], $_POST['firstname'], $_POST['email'], $_POST['description'])){
            //Extract values from the $_post array
                $lastname = strip_tags($_POST['lastname']);
                $firstname = $_POST['firstname'];
                $email = $_POST['email'];
                $file = $_POST['file'];
                $description = $_POST['description'];

        // CALL function to insert and track if success or not
        $isSuccess = $crud->create( $lastname, $firstname, $email, $file, $description);

        if ($isSuccess) {
            echo "<h4> You have been successfully registered </h4>";

        } else {
            echo "<h4> You have not been registered </h4>";
        }

}else{
            echo "Veuillez completer tous les champs";
        }
        ?>

        <?php

        try {
            $crud->display();


        } catch (Exception $e) {
            die('Erreur : '.$e->getMessage(). " la ligne est". $e->getLine());
        }
        ?>
    </body>
</html>