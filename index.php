<?php require "PHP/script.php"?>
<?php require "PHP/error.php"?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Claim Form</title>
    <link rel="stylesheet" href="style/style.css">
    <link href="//db.onlinewebfonts.com/c/768446cc3d04d6dd3289ae1715bdb682?family=GT+Walsheim+Regular" rel="stylesheet" type="text/css"/>

    <?php
    hideError($firstnameErr, 'firstnameErr');
    hideError($lastnameErr, 'lastnameErr');
    hideError($emailErr, 'emailErr');
    hideError($fileErr, 'fileErr');
    hideError($descriptionErr, 'descriptionErr');
    showMessage($successMessage, 'success');
    showMessage($errorMessageGeneral, 'errorMessageGeneral');
    ?>


</head>
<body>

<section class="reclamation__container">
    <h2 class="reclamation__container__title">Reclamation form</h2>

    <p class="errorMessageGeneral"><?php echo $errorMessageGeneral ?></p>

    <form class="reclamation__container__form" method="post" action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">

        <div class="reclamation__div">
            <label for="name">First name</label>
            <input type="text" name="firstname" value="" >
            <p class="error firstnameErr"><?php echo $firstnameErr ?></p>
        </div>

        <div class="reclamation__div">
            <label for="lastname">Last name</label>
            <input type="text"   name="lastname" value="" >
            <p class="error lastnameErr"><?php echo $lastnameErr ?></p>
        </div>

        <div class="reclamation__div">
            <label for="email">Email</label>
            <input type="email"  name="email" value="" >
            <p class="error emailErr"><?php echo $emailErr ?></p>
        </div>

        <div class="reclamation__div file" >
            <label for="file" id="file__title">Attachments(optional)</label>
            <div class="file__attachment">
                <input type="file" name="file" class="file__attachment__browser">
                <span class="file__attachment__title">Add file</span>
            </div>
            <p class="error fileErr"><?php echo $fileErr ?></p>
        </div>


        <div class="reclamation__div">
            <label for="description">Description</label>
            <textarea type="text" name="description" rows="6" cols="20" ></textarea>
            <p class="error descriptionErr"><?php echo $descriptionErr ?></p>
        </div>

        <button type="submit" name="button" value="Enter">Envoyer</button>
        <p class="success"><?php echo $successMessage ?></p>

    </form>
</section>
</body>
</html>