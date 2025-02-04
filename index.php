<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // Allow all origins for CORS

function isPrime($number)
{
    if ($number <= 1)
        return false;
    for ($i = 2; $i <= sqrt($number); $i++) {
        if ($number % $i == 0)
            return false;
    }
    return true;
}

function isPerfect($number)
{
    $sum = 0;
    for ($i = 1; $i < $number; $i++) {
        if ($number % $i == 0) {
            $sum += $i;
        }
    }
    return $sum == $number;
}

function getDigitSum($number)
{
    return array_sum(str_split($number));
}

function getFunFact($number)
{
    // Fetching fun fact from numbers API
    $response = file_get_contents("http://numbersapi.com/" . $number . "?json");
    if ($response !== false) {
        return json_decode($response)->text ?? "No fun fact available.";
    }
    return "No fun fact available.";
}

// Get the number from the query parameter
if (isset($_GET['number']) && is_numeric($_GET['number'])) {
    $number = (int) $_GET['number'];

    // Prepare the response
    $response = [
        "number" => $number,
        "is_prime" => isPrime($number),
        "is_perfect" => isPerfect($number),
        "properties" => [],
        "digit_sum" => getDigitSum($number),
        "fun_fact" => getFunFact($number)
    ];

    // Check for properties
    if ($response["is_prime"]) {
        $response["properties"][] = "prime";
    }

    if ($response["is_perfect"]) {
        $response["properties"][] = "perfect";
    }

    // Check for Armstrong number (for three-digit numbers)
    if (
        strlen((string) $number) === 3 &&
        pow((int) (strval($number)[0]), 3) +
        pow((int) (strval($number)[1]), 3) +
        pow((int) (strval($number)[2]), 3) === $number
    ) {
        $response["properties"][] = "armstrong";
    }

    http_response_code(200); // Set HTTP status code to 200 OK
} else {
    // Handle bad request
    http_response_code(400); // Set HTTP status code to 400 Bad Request
    $response = [
        "error" => true,
        "message" => isset($_GET['number']) ? "Invalid input." : "Number parameter is required."
    ];
}

// Send JSON response
echo json_encode($response);
