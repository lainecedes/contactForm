<?php
// form validation method rewritten with the object oriented programming method

session_start();

ini_set('display_errors', 1);
ini_set('log_errors', 1);

class Validation {
    // variables
    private $errors = [];
    private $formInputs;
    private $patterns;
    public function __construct($formInputs, $patterns) {
        // form inputs get used by sanitizeInputs()
        $this->formInputs = $this->sanitizeInputs($formInputs);
        $this->patterns = $patterns;
    }

    // 1. Sanitize inputs helper
    private function sanitizeInputs($input) {
        if (is_array($input)) {
            foreach ($input as $key => $value) {
                $input[$key] = htmlspecialchars(trim($value)); // trim and sanitize together
            }
            return $input;
        }
        return htmlspecialchars(trim($input));
    }

    // 2. Validate patterns helper
    public function validatePatterns() {
        foreach ($this->formInputs as $field => $value) {
            if (empty($value)) {
                $this->errors[$field] = ucfirst($field)." is verplicht"; // capitalize first letter with ucfirst
            }
            else if (!preg_match($this->patterns[$field]['pattern'], $value)) {
                $this->errors[$field] = $this->patterns[$field]['error'];
            }
        }
        return empty($this->errors);
    }

    // 3. Getting errors helper
    public function errors() {
        return $this->errors;
    }

    // 4. Getting the sanitized fields helper
    public function sanitizedFields() {
        return $this->formInputs;
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // get the formInputs in an array
    $formInputs = [
        'voornaam' => isset($_POST['voornaam']) ? $_POST['voornaam'] : '',
        'achternaam' => isset($_POST['achternaam']) ? $_POST['achternaam'] : '',
        'emailadres' => isset($_POST['emailadres']) ? $_POST['emailadres'] : '',
        'bericht' => isset($_POST['bericht']) ? $_POST['bericht'] : ''
    ];

    $emailPattern = '/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/';
    $namePattern = '/^[a-zA-Z0-9- ]+$/';
    $messagePattern = '/^.{1,500}$/';

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
            'error' => 'Voer een geldig e-mailadres in, bijv. test@mail.nl'
        ],
        'bericht' => [
            'pattern' => $messagePattern,
            'error' => 'Bericht mag max 500 karakters zijn'
        ]
    ];

    $validator = new Validation($formInputs, $patterns);

    if ($validator->validatePatterns()) {
        $_SESSION['formData'] = $validator->sanitizedFields();

        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'errors' => $validator->errors()]);
    }
    exit;
}
