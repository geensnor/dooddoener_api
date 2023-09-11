<?php
// Define the JSON file path
$jsonFilePath = 'https://raw.githubusercontent.com/geensnor/DigitaleTuin/master/_data/dooddoeners.json';

// Read the JSON file
$jsonData = file_get_contents($jsonFilePath);

// Check if data was successfully read
if ($jsonData === false) {
    $response = [
        'error' => 'Failed to read the JSON file.',
    ];
} else {
    // Parse the JSON data into an array
    $lines = json_decode($jsonData);

    // Check if JSON decoding was successful
    if ($lines === null) {
        $response = [
            'error' => 'Failed to parse JSON data.',
        ];
    } else {
        // Select a random line
        $randomLine = $lines[array_rand($lines)];

        // Prepare the response
        $response = [
            'random_line' => $randomLine,
        ];
    }
}

// Set the Content-Type header to JSON
header('Content-Type: application/json');

// Output the response as JSON
echo json_encode($response);
