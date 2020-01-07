<?php
//Require database in this file & image helpers
require_once "includes/database.php";
require_once "includes/image-helpers.php";

//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $albumId = mysqli_escape_string($db, $_POST['id']);
    $artist = mysqli_escape_string($db, $_POST['artist']);
    $name = mysqli_escape_string($db, $_POST['name']);
    $genre = mysqli_escape_string($db, $_POST['genre']);
    $year = mysqli_escape_string($db, $_POST['year']);
    $tracks = mysqli_escape_string($db, $_POST['tracks']);
    $image = mysqli_escape_string($db, $_POST['current-image']);

    //Require the form validation handling
    require_once "includes/form-validation.php";

    //Save variables to array so the form won't break
    $album = [
        'artist' => $artist,
        'name' => $name,
        'genre' => $genre,
        'year' => $year,
        'tracks' => $tracks,
        'image' => $image,
    ];

    if (empty($errors)) {
        //If image is not empty, process the new image file
        if ($_FILES['image']['error'] != 4) {
            //Remove old image
            deleteImageFile($image);

            //Store new image & retrieve name for database saving (override current image name)
            $image = 'images/' . addImageFile($_FILES['image']);
        }

        //Update the record in the database
        $query = "UPDATE albums
                  SET name = '$name', artist = '$artist', genre = '$genre', year = '$year', tracks = '$tracks', image = '$image'
                  WHERE id = '$albumId'";
        $result = mysqli_query($db, $query);

        if ($result) {
            //Set success message
            $success = true;
        } else {
            $errors[] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }

    }
} else {
    //Retrieve the GET parameter from the 'Super global'
    $albumId = $_GET['id'];

    //Get the record from the database result
    $query = "SELECT * FROM albums WHERE id = " . mysqli_escape_string($db, $albumId);
    $result = mysqli_query($db, $query);
    $album = mysqli_fetch_assoc($result);
}

//Close connection
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <title>Music Collection Edit</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<h1>Edit "<?= $album['artist'] . ' - ' . $album['name']; ?>"</h1>
<?php if (isset($errors) && !empty($errors)) { ?>
    <ul class="errors">
        <?php for ($i = 0; $i < count($errors); $i++) { ?>
            <li><?= $errors[$i]; ?></li>
        <?php } ?>
    </ul>
<?php } ?>

<?php if (isset($success)) { ?>
    <p class="success">Je album is bijgewerkt in de database</p>
<?php } ?>

<form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
    <div class="data-field">
        <label for="artist">Artist</label>
        <input id="artist" type="text" name="artist" value="<?= $album['artist']; ?>"/>
    </div>
    <div class="data-field">
        <label for="name">Album</label>
        <input id="name" type="text" name="name" value="<?= $album['name']; ?>"/>
    </div>
    <div class="data-field">
        <label for="genre">Genre</label>
        <input id="genre" type="text" name="genre" value="<?= $album['genre']; ?>"/>
    </div>
    <div class="data-field">
        <label for="year">Year</label>
        <input id="year" type="text" name="year" value="<?= $album['year']; ?>"/>
    </div>
    <div class="data-field">
        <label for="tracks">Tracks</label>
        <input id="tracks" type="number" name="tracks" value="<?= $album['tracks']; ?>"/>
    </div>
    <div class="data-field">
        <label for="image">Image</label>
        <input type="file" name="image" id="image"/>
    </div>
    <div class="data-submit">
        <input type="hidden" name="id" value="<?= $albumId; ?>"/>
        <input type="hidden" name="current-image" value="<?= $album['image']; ?>"/>
        <input type="submit" name="submit" value="Save"/>
    </div>
</form>
<div>
    <a href="index.php">Go back to the list</a>
</div>
</body>
</html>
