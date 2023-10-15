<?php 
include('connection.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GWSC - Campsite Edit</title>
    <script src="https://kit.fontawesome.com/84ff42f2da.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Old+Standard+TT&family=Source+Sans+3&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <h1>Campsites</h1>
    <table>
        <tr>
            <th>Campsite Name</th>
            <th>Country Name</th>
            <th>No of Views</th>
            <th>Wild Swimming</th>
            <th>Description</th>
            <th>CampsiteImage</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

        <?php
        $campsiteQuery = "SELECT c.*, co.CountryName FROM 
        Campsites c, Countries co
        Where co.CountryID = c.CountryID";
        $runCampsiteQuery = mysqli_query($connect, $campsiteQuery);

        if ($runCampsiteQuery->num_rows > 0) {
            while ($row = $runCampsiteQuery->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["CampsiteName"] . "</td>";
                echo "<td>" . $row["CountryName"] . "</td>";
                echo "<td>" . $row["NoOfViews"] . "</td>";
                echo "<td>" . ($row["WildSwimming"] ? "Yes" : "No") . "</td>";
                echo "<td>" . $row["Description"] . "</td>";
                echo "<td>" ?> <img src="<?=$row["Image1"]?>" alt=""><?php echo "</td>";
                echo "<td><a href='campsiteEdit.php?CampsiteID=" . $row["CampsiteID"] . "'>Edit</a></td>";
                echo "<td><a href='campsiteDelete.php?CampsiteID=" . $row["CampsiteID"] . "'>Delete</a></td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
    <a href="AdminDashboard.php">Go back to Admin Dashboard</a>
</body>
</html>