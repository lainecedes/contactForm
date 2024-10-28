<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vragen?</title>
    <!--  Adobe Fonts  -->
    <link rel="stylesheet" href="https://use.typekit.net/nbr2zpp.css">
    <link href="static/css/styles.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<?php
$title = "Vragen?";
$description = "Heb je vragen over je museumbezoek, of iets dat niet helemaal lekker loopt? Laat het ons weten via het formulier hieronder. Onze klantenservice staat voor je klaar.";
?>

<main>
    <section class="contact-container">
        <picture class="image-container">
            <source srcset="static/images/neonart.webp" type="image/webp" media="(min-width: 600px)">
            <img src="static/images/neonart.jpg" class="img-fluid" width="4000" height="6000" alt="Neon light background effects">
        </picture>
        <form id="contact" action="/success.php" method="POST">
            <h1><?php echo $title; ?></h1>
            <fieldset>
                <legend><?php echo $description; ?></legend>
                <div class="label-container">
                    <div class="name-container">
                        <label for="voornaam">Voornaam
                            <input id="voornaam" name="voornaam" placeholder="Jouw voornaam" type="text" value=""/>
                            <span class="error" id="voornaam-error"></span>
                        </label>

                        <label for="achternaam">Achternaam
                            <input id="achternaam" name="achternaam" placeholder="Jouw achternaam" type="text"
                                   value=""/>
                            <span class="error" id="achternaam-error"></span>
                        </label>
                    </div>
                    <label for="emailadres">E-mailadres
                        <input id="emailadres" name="emailadres" placeholder="Jouw e-mailadres" type="email" value=""/>
                        <span class="error" id="emailadres-error"></span>
                    </label>

                    <label for="bericht">Bericht
                        <textarea id="bericht" name="bericht" rows="6" cols="60" type="text" placeholder="Typ hier je bericht..."></textarea>
                        <span class="error" id="bericht-error"></span>
                    </label>
                </div>
            </fieldset>
            <button form="contact" type="submit">Verzenden</button>
        </form>
    </section>
</main>

<?php include 'includes/footer.php'; ?>

<script defer src="static/js/script.js"></script>
</body>
</html>
