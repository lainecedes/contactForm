<?php
session_start();

var_dump($_SESSION['formData']);

if (isset($_SESSION['formData'])) {
    $formData = $_SESSION['formData'];

    $voornaam = $formData['voornaam'];
    $achternaam = $formData['achternaam'];
    $emailadres = $formData['emailadres'];
    $bericht = $formData['bericht'];

    // clear session
    unset($_SESSION['formData']);

    } else {

    echo "No form data available.";
    exit;
}


?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Een formulier</title>
    <!--  Adobe Fonts  -->
    <link rel="stylesheet" href="https://use.typekit.net/nbr2zpp.css">
    <link href="static/css/styles.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<h1>Form Submission Successful!</h1>

<p>Voornaam: <?php echo $voornaam ?></p>
<p>Achternaam: <?php echo $achternaam ?></p>
<p>Emailadres: <?php echo $emailadres ?></p>
<p>Bericht: <?php echo $bericht ?></p>

<!--<script src="static/js/script.js"></script>-->
</body>
</html>


