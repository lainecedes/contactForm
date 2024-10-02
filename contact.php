<!-- Header -->
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Een geweldig formulier</title>
    <!--  Adobe Fonts  -->
    <link rel="stylesheet" href="https://use.typekit.net/nbr2zpp.css">
    <link href="static/css/styles.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<?php include 'includes/header.php'; ?>

<?php
$title = "Contactformulier";
$description = "test!";
?>

<main>
    <h1><?php echo $title; ?></h1>
    <p><?php echo $description; ?></p>

    <section class="form-container">
        <form id="contact" action="/success.php" method="POST">
            <fieldset>
                <legend>Vul hier je gegevens in</legend>
                <label for="voornaam">
                    <input id="voornaam" name="voornaam" placeholder="Voornaam" type="text" value=""/>
                    <div class="error" id="voornaam-error"></div>
                </label>

                <label for="achternaam">
                    <input id="achternaam" name="achternaam" placeholder="Achternaam" type="text" value=""/>
                    <div class="error" id="achternaam-error"></div>
                </label>

                <label for="emailadres">
                    <input id="emailadres" name="emailadres" placeholder="E-mailadres" type="email" value=""/>
                    <div class="error" id="emailadres-error"></div>
                </label>

                <label for="bericht">
                    <input id="bericht" name="bericht" placeholder="Typ hier je bericht..." type="text" value=""/>
                    <div class="error" id="bericht-error"></div>
                </label>
            </fieldset>
            <button form="contact" type="submit">Verzenden</button>
        </form>
    </section>
</main>

<?php /*if (isset($errors['emailadres'])): */?><!--
    <span class="error-message"><?php /*echo $errors['emailadres']; */?></span>
--><?php /*endif; */?>

<?php include 'includes/footer.php'; ?>

<script defer src="static/js/script.js"></script>
</body>
</html>
