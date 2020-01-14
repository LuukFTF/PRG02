<?php
session_start();

$username = '';
$password = '';

//If our session doesn't exist, redirect & exit script
if (isset($_SESSION['loggedInUser'])) {
    header('Location: index.php');
    exit;
}

if (isset($_POST['submit'])) {
    //Require database in this file & image helpers
    require_once "includes/database.php";

    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = $_POST['password'];

    $errors = [];
    if($username == '') {
        $errors['username'] = 'The username cannot be empty';
    }
    if($password == '') {
        $errors['password'] = 'The password cannot be empty';
    }

    if(empty($errors)) {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, password) VALUE('$username', '$password')";
        $result = mysqli_query($db, $query)
            or die('Error: '.$query);

        if ($result) {
            header('Location: index.php');
            exit;
        } else {
            $errors[] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }

        //Close connection
        mysqli_close($db);
    }

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Nieuwe gebruiker registeren</h2>
    <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
        <div class="data-field">
            <label for="username">Username</label>
            <input id="username" type="text" name="username" value="<?= $username ?>"/>
            <span class="errors"><?= isset($errors['username']) ? $errors['username'] : '' ?></span>
        </div>
        <div class="data-field">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" value="<?= $password ?>"/>
            <span class="errors"><?= isset($errors['password']) ? $errors['password'] : '' ?></span>
        </div>
        <div class="data-submit">
            <input type="submit" name="submit" value="Save"/>
        </div>
    </form>

</body>
</html>

