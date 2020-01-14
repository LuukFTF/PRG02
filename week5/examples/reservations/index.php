<?php
require_once 'includes/db-connection.php';

// A date begin of the week. Start of the week is on Sunday.
$date = '2020-01-05';
$enddate = '2020-01-12';
$query = "SELECT * 
          FROM planning_system.reservations 
          WHERE date >= '$date' AND date <= '$enddate'
          ORDER BY start_time ASC";
$result = mysqli_query($db, $query)
    or die('Error '.mysqli_error($db).' with query '.$query);

$reservations = [];
while($row = mysqli_fetch_assoc($result))
{
    $reservations[] = $row;
}

mysqli_close($db);

setlocale(LC_ALL, 'nl_NL');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
    <div class="row">

        <?php for($i = 0 ; $i < 6 ; $i++) {?>

        <div class="column">
            <b><?= strftime('%A', strtotime($date ." + $i days")) ?></b>
            <div><?= date('j F', strtotime($date ." + $i days")) ?></div>

            <?php foreach($reservations as $reservation) { ?>

                <?php if(date('N', strtotime($reservation['date'])) == $i + 1) {?>
                    <?php include 'templates/template_event.php' ?>
                <?php } ?>

            <?php } ?>

        </div>

        <?php } ?>
    </div>
    <div class="row"><a href="create.php">Boek een nieuw event</a></div>
</body>
</html>
