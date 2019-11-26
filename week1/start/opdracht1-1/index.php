<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Programmeren 2 - Week 1 - Opdracht 1.1</title>
</head>
<body>

<h1> Opdracht 1.1 - Datum en tijd [Lucas' Uitwerking]</h1>
<hr/>

<p>
    <?php
    $nextWeek = time() + (7 * 24 * 60 * 60);
    // 7 days; 24 hours; 60 mins; 60 secs
    echo 'Now:       '. date('Y-m-d') ."</br>";
    echo 'Next Week: '. date('Y-m-d', $nextWeek)  ."</br>";
    echo date('D-d-S-W-a A-U-T')
    ?>
</p>

<h2><?php echo 'Het is vandaag '.date('d F Y') ?></h2>
<p>

</p>

<h2><?php echo 'Het is vandaag '.date('Y-m-d') ?></h2>
<p>

</p>

<h2><?php echo 'Het is nu '.date('g').' uur en '.date('i').' minuten' ?></h2>
<p>

</p>

<h2><?php echo 'De exacte tijd is '.date('H:i:s:u:v e') ?></h2>
</p>

</p>

</body>
</html>
