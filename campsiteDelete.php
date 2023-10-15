<?php
include('connection.php');
session_start();
if (!isset($_SESSION['AdminID']))
{
	echo "<script>window.alert('Please login again.')</script>";
	echo "<script>window.location = 'AdminLogin.php'</script>";
}
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["CampsiteID"])) {
    $campsiteID = $_GET["CampsiteID"];

    $deleteQuery = "DELETE FROM Campsites WHERE CampsiteID = $campsiteID";
    $runDelete = mysqli_query($connect, $deleteQuery);

    if ($runDelete){
        echo "<script>window.alert('Campsite Deleted Successfully')</script>";
        echo "<script>window.location ='CampsiteDashboard.php'</script>";
    }
}
?>
