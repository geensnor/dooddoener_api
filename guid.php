<?php
// Generate a random GUID
function generateGuid() {
    if (function_exists('com_create_guid')) {
        return trim(com_create_guid(), '{}');
    } else {
        mt_srand((double)microtime()*10000); // optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45); // "-"
        $uuid = substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12);
        return $uuid;
    }
}

// Generate a random GUID
$randomGuid = generateGuid();

// Prepare the response
$response = [
    'guid' => $randomGuid
];

// Set the Content-Type header to JSON
header('Content-Type: application/json');

// Output the response as JSON
echo json_encode($response);
?>