<?php
// Define the JSON file path
include "include.php";

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
        // Check if the "expanded" query parameter is set
        $expanded = isset($_GET['expanded']) && $_GET['expanded'] === 'true';

        // Determine the number of lines to display (default to 1 if "expanded" is not set)
        $count = $expanded ? 10 : 1;

        // Select random lines based on the count
        $randomLines = array_rand($lines, $count);

        // If "expanded" is set, $randomLines will be an array; otherwise, it will be a single index
        $randomLines = is_array($randomLines) ? $randomLines : [$randomLines];

        // Prepare the response
        $response = [
            'random_lines' => array_map(function ($index) use ($lines) {
                return $lines[$index];
            }, $randomLines),
        ];
    }
}

// Set the Content-Type header to JSON
header('Content-Type: application/json');

// Output the response as JSON
echo json_encode($response);
