<?php
session_start();
ini_set('display_errors', 1);
ini_set('log_errors', 1);


$errors = [];

// function to sanitize inputs using htmlspecialchars and trim
function sanitizeInputs($input)
{
    if (is_array($input)) {
        foreach ($input as $key => $value) {
            $input[$key] = htmlspecialchars(trim($value)); // trim and value together
        }
        return $input;
    }
    return htmlspecialchars(trim($input));  // single inputs
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $voornaam = sanitizeInputs(isset($_POST["voornaam"]) ? $_POST["voornaam"] : '');
    $achternaam = sanitizeInputs(isset($_POST["achternaam"]) ? $_POST["achternaam"] : '');
    $emailadres = sanitizeInputs(isset($_POST["emailadres"]) ? $_POST["emailadres"] : '');
    $bericht = sanitizeInputs(isset($_POST["bericht"]) ? $_POST["bericht"] : '');

    // Check for empty inputs and assign errors
    if (empty($voornaam)) {
        $errors['voornaam'] = 'Voornaam is verplicht';
    }
    if (empty($achternaam)) {
        $errors['achternaam'] = 'Achternaam is verplicht';
    }
    if (empty($emailadres)) {
        $errors['emailadres'] = 'Emailadres is verplicht';
    }
    if (empty($bericht)) {
        $errors['bericht'] = 'Bericht is verplicht';
    }

    if (empty($errors)) {
        $_SESSION['formData'] = [
            'voornaam' => $voornaam,
            'achternaam' => $achternaam,
            'emailadres' => $emailadres,
            'bericht' => $bericht
        ];

        header('Content-Type: application/json');
        echo json_encode(['status' => 'success']);

    } else {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'errors' => $errors]);
    }
    exit;
}
