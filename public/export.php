<?php

require_once '../core/Database.php';

$db = new Database();
$conn = $db->getConnection();

$today = date('Y-m-d');
$filename = "products_export_" . $today . ".csv";

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '"');


$output = fopen('php://output', 'w');

fputcsv($output, ['ID', 'Name', 'Price', 'Description']);

$result = $db->getAllProducts();

if (!empty($result)) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
} else {
    echo "No records found.";
}

fclose($output);
$conn->close();
