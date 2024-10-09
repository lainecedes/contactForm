<?php
session_start();

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
    <title>Verstuurd!</title>
    <!--  Adobe Fonts  -->
    <link rel="stylesheet" href="https://use.typekit.net/nbr2zpp.css">
    <link href="static/css/styles.css" rel="stylesheet" type="text/css"/>
</head>
<body class="results">
<main>
    <section class="success">
        <h1>Bedankt! Wij gaan aan de slag.</h1>
        <p>We hebben je verzoek ontvangen en zullen je zo snel mogelijk, binnen 24 uur beantwoorden.</p>

        <section class="form-results">
            <h2>Je verzoek</h2>
            <div class="label-container">
                <p>Voornaam</p>
                <p><?php echo $voornaam ?></p>
            </div>
            <div class="label-container">
                <p>Achternaam</p>
                <p><?php echo $achternaam ?></p>
            </div>
            <div class="label-container">
                <p>E-mailadres</p>
                <p><?php echo $emailadres ?></p>
            </div>
            <div class="label-container">
                <p>Bericht</p>
                <p><?php echo $bericht ?></p>
            </div>
        </section>
    </section>
</main>
</body>
</html>


