<?php
// Include your database connection code here
// ...

// Query the database to get the city
$query = "SELECT city FROM campsite WHERE id = 1"; // You may need to adjust the query as per your data structure and how you identify the campsite

$result = mysqli_query($connection, $query);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $city = $row['city'];
    echo json_encode(['city' => $city]);
} else {
    echo json_encode(['error' => 'Unable to fetch city from the database']);
}
?>
