<?php
// start session

//Require database in this file
require_once "includes/database.php";

//Check if user is logged in, else move to secure page (create.php)


//If form is posted, lets validate!
if (isset($_POST['submit'])) {
    //Retrieve values (email safe for query)

    // Retrieve password


    //Get password & name from DB


    //Check if email exists in database
    $errors = [];
    if ($user) {
        //Validate password

            //Set email for later use in Session

            //Redirect to secure.php & exit script

        } else {
            // Password is incorrect

        }
    } else {
        // email password combination is incorrect

    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Music Collection Login</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<h1>Login</h1>
<?php if (isset($errors) && !empty($errors)) { ?>
    <ul class="errors">
        <?php for ($i = 0; $i < count($errors); $i++) { ?>
            <li><?= $errors[$i]; ?></li>
        <?php } ?>
    </ul>
<?php } ?>

<form id="login" method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
    <div>
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" value="<?= (isset($email) ? $email : ''); ?>"/>
    </div>
    <div>
        <label for="password">Wachtwoord</label>
        <input type="password" name="password" id="password"/>
    </div>
    <div>
        <input type="submit" name="submit" value="Login"/>
    </div>
</form>
<div>
    <a href="index.php">Go back to the list</a>
</div>
</body>
</html>
