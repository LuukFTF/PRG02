<?php
$a = 'hello world';

$name = 'Lucas';
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Programmeren 2 - Week 1 - Opdracht 1.2</title>
</head>
<body>
<h1>Opdracht 1.2</h1>
<hr/>

<h2>Begroeting op basis van het  moment van de dag</h2>
<p>
    <?php echo "123 $a" ?>
</p>

<h2></h2>

<h2>
    <?php
    if (date('G') < 12){
        echo "Goedenmorgen";
    } else if (date('G') < 18) {
        echo "Goedenmiddag";
    } else {
        echo "Goedenavond";
    }

    echo " $name!"
    ?>
</h2>


</body>
</html>
