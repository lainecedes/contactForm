<?php
session_start();

ini_set('display_errors', 1);
ini_set('log_errors', 1);

$errors = [];


// function to sanitize inputs using htmlspecialchars and trim
function sanitizeInputs($input) {
    if (is_array($input)) {
        foreach ($input as $key => $value) {
            $input[$key] = htmlspecialchars(trim($value)); // trim and value together
        }
        return $input;
    }
    return htmlspecialchars(trim($input));  // single inputs
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // regex patterns
    $emailPattern = '/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/';
    $namePattern = '/^[a-zA-Z0-9- ]+$/';
    $messagePattern = '/^.{1,500}$/';


    // put post inputs in array to use for foreach loop later + sanitize
    $formInputs = [
        'voornaam' => sanitizeInputs(isset($_POST['voornaam']) ? $_POST['voornaam'] : ''),
        'achternaam' => sanitizeInputs(isset($_POST['achternaam']) ? $_POST['achternaam'] : ''),
        'emailadres' => sanitizeInputs(isset($_POST['emailadres']) ? $_POST['emailadres'] : ''),
        'bericht' => sanitizeInputs(isset($_POST['bericht']) ? $_POST['bericht'] : '')
    ];

    // multidimentional array to store pattern and error message
    $patterns = [
        'voornaam' => [
            'pattern' => $namePattern,
            'error' => "Voornaam mag alleen letters en spaties bevatten"
        ],
        'achternaam' => [
            'pattern' => $namePattern,
            'error' => "Achternaam mag alleen letters en spaties bevatten"
        ],
        'emailadres' => [
            'pattern' => $emailPattern,
            'error' => 'Voer een geldig e-mailadres in (voorbeeld hierin?)'
            ],
        'bericht' => [
            'pattern' => $messagePattern,
            'error' => 'Bericht mag max 500 karakters zijn'
        ]
    ];

    foreach ($formInputs as $field => $value) {
        if (empty($value)) {
            $errors[$field] = "$field is verplicht";
        }
        else if (!preg_match($patterns[$field]['pattern'], $value)) {
            $errors[$field] = $patterns[$field]['error'];
        }
    }

    if (empty($errors)) {
        $_SESSION['formData'] = [
            'voornaam' => $formInputs['voornaam'],
            'achternaam' => $formInputs['achternaam'],
            'emailadres' => $formInputs['emailadres'],
            'bericht' => $formInputs['bericht']
        ];

        echo json_encode(['status' => 'success']);

    } else {
        echo json_encode(['status' => 'error', 'errors' => $errors]);
    }
    exit;
}
