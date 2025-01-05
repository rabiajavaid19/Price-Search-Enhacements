<?php
// price_search.php
include 'db.php';

// Get user inputs
$min_price = $_GET['min_price'] ?? 0;
$max_price = $_GET['max_price'] ?? 100000;

// SQL query to fetch businesses within the price range
$sql = "SELECT b.id, b.name, b.location, s.service_name, s.price 
        FROM businesses b
        JOIN services s ON b.id = s.business_id
        WHERE s.price BETWEEN ? AND ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("dd", $min_price, $max_price);
$stmt->execute();

$result = $stmt->get_result();

$businesses = [];
while ($row = $result->fetch_assoc()) {
    $businesses[] = $row;
}

$stmt->close();
$conn->close();

// Return results in JSON format
header('Content-Type: application/json');
echo json_encode($businesses);
?>
