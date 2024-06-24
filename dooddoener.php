<?php
// Define the JSON file path
include "include.php";

// Validate and sanitize the "expanded" query parameter
$expanded = isset($_GET['expanded']) ? true : false;

// Read the JSON file securely
$jsonData = file_get_contents($jsonFilePath, true);

// Check if data was successfully read
if ($jsonData === false) {
    $response = [
        'error' => 'Failed to read the JSON file.',
    ];
} else {
    // Parse the JSON data into an array
    $lines = json_decode($jsonData, true);

    // Check if JSON decoding was successful
    if ($lines === null) {
        $response = [
            'error' => 'Failed to parse JSON data.',
        ];
    } else {
        // Determine the number of lines to display (default to 1 if "expanded" is not set)
        $count = $expanded ? min(count($lines), 10) : 1;

        // Select random lines based on the count
        $randomLines = array_rand($lines, $count);

        // Ensure $randomLines is always an array
        $randomLines = is_array($randomLines) ? $randomLines : [$randomLines];

        // Prepare the response
        $response = [
            'dooddoener' => array_map(function ($index) use ($lines) {
                return $lines[$index];
            }, $randomLines),
        ];
    }
}

// Set security headers
header('Content-Type: application/json');
header('Content-Security-Policy: default-src https:');

// Output the response as JSON
echo json_encode($response);
