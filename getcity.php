<?php
session_start();
include('connection.php');
$campsiteID= $_SESSION['CampsiteID'];
$countryQuery = "SELECT City FROM Campsites WHERE CampsiteID = $campsiteID";

$runCountryQuery = mysqli_query($connect, $countryQuery);
if ($runCountryQuery) {
    $countryRow = mysqli_fetch_assoc($runCountryQuery);
    $city = $countryRow['City'];
    echo json_encode(['city' => $city]);
} else {
    echo json_encode(['error' => 'Unable to fetch city from the database']);
}
?>
