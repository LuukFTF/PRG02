<?php
// id uitlezen
if(isset($_GET['id'])) {
    $id = $_GET['id'];
} else if(isset($_POST['submit'])) {
    // DATA niet valide

        // error's tonen
        // form opnieuw tonen
        // waarden uit form terugschrijven in form


    // Data wel valide
        // data in database overschrijven (UPDATE query)
        // Probleem is nu dat we in een POST request zitten
        // Het id kwam uit de url (GET request) en kunnen we nu niet meer bij
        // Om dit op te lossen is er een hidden field gemaakt in het formulier
        $id = $_POST['id'];
        $query = "
            UPDATE users
            SET first_name = '$firstName', last_name = '$lastName'
            WHERE id = $id
        ";
        // redirect naar index
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
    <form action="" method="post">
        <div class="data-field">
            <label for="first-name">Voornaam</label>
            <input id="first-name" type="text" name="first-name" value=""/>
        </div>
        <div class="data-field">
            <label for="last-name">Achternaam</label>
            <input id="last-name" type="text" name="last-name" value=""/>
        </div>

        <div class="data-field">
            <input type="hidden" name="id" value="<?= $id ?>"/>
        </div>

        <div class="data-submit">
            <input type="submit" name="submit" value="Aanpassen"/>
        </div>
    </form>

</body>
</html>
