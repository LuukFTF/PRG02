<?php
// Start session


//If our session doesn't exist, redirect & exit script


//Get user information from session


//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Require database in this file & image helpers
    require_once "includes/database.php";
    require_once "includes/image-helpers.php";

    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $artist = mysqli_real_escape_string($db, $_POST['artist']);
    $name = mysqli_escape_string($db, $_POST['name']);
    $genre = mysqli_escape_string($db, $_POST['genre']);
    $year = mysqli_escape_string($db, $_POST['year']);
    $tracks = mysqli_escape_string($db, $_POST['tracks']);

    //Require the form validation handling
    require_once "includes/form-validation.php";

    //Special check for add form only
    if ($_FILES['image']['error'] == 4) {
        $errors[] = 'Image cannot be empty';
    }

    if (empty($errors)) {
        //Store image & retrieve name for database saving
        $image = 'images/' . addImageFile($_FILES['image']);
        $userId = $loggedInUser['id'];

        //Save the record to the database
        $query = "INSERT INTO albums
                  (user_id, name, artist, genre, year, tracks, image)
                  VALUES ('$userId', '$name', '$artist', '$genre', '$year', '$tracks', '$image')";
        $result = mysqli_query($db, $query);

        if ($result) {
            //Set success message & empty all variables for new form
            $name = '';
            $artist = '';
            $genre = '';
            $year = '';
            $tracks = '';
            $success = true;

            // Or redirect to index.php
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
    <title>Music Collection Create</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
    <h1>Create album for <?= $loggedInUser['name']; ?></h1>
    <?php if (isset($errors) && !empty($errors)) { ?>
        <ul class="errors">
            <?php for ($i = 0; $i < count($errors); $i++) { ?>
                <li><?= $errors[$i]; ?></li>
            <?php } ?>
        </ul>
    <?php } ?>

    <?php if (isset($success)) { ?>
        <p class="success">Je nieuwe album is toegevoegd aan de database</p>
    <?php } ?>

    <!-- enctype="multipart/form-data" no characters will be converted -->
    <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
        <div class="data-field">
            <label for="artist">Artist</label>
            <input id="artist" type="text" name="artist" value="<?= (isset($artist) ? $artist : ''); ?>"/>
            <!--        Alternative for errors behind input and not in summary -->
            <span class="errors"><?= isset($errors['artist']) ? $errors['artist'] : '' ?></span>
        </div>
        <div class="data-field">
            <label for="name">Album</label>
            <input id="name" type="text" name="name" value="<?= (isset($name) ? $name : ''); ?>"/>
        </div>
        <div class="data-field">
            <label for="genre">Genre</label>
            <input id="genre" type="text" name="genre" value="<?= (isset($genre) ? $genre : ''); ?>"/>
        </div>
        <div class="data-field">
            <label for="year">Year</label>
            <input id="year" type="text" name="year" value="<?= (isset($year) ? $year : ''); ?>"/>
        </div>
        <div class="data-field">
            <label for="tracks">Tracks</label>
            <input id="tracks" type="number" name="tracks" value="<?= (isset($tracks) ? $tracks : ''); ?>"/>
        </div>
        <div class="data-field">
            <label for="image">Image</label>
            <input type="file" name="image" id="image"/>
        </div>
        <div class="data-submit">
            <input type="submit" name="submit" value="Save"/>
        </div>
    </form>
    <div>
        <a href="index.php">Go back to the list</a>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
