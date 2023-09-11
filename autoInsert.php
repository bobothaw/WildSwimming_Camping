<?php 
include('connection.php');
$initialDate = new DateTime('2023-09-01');
$endDate = new DateTime('2023-12-31');
$availSpace = 20;

$campsitePitchQuery = "SELECT * from campsite_pitchtype";
$runcampsitePitchQuery = mysqli_query($connect, $campsitePitchQuery);
while ($campPitchRow = mysqli_fetch_assoc($runcampsitePitchQuery))
{
    echo $campPitchRow["CampsiteID"];
    echo $campPitchRow["PitchTypeID"];
    echo $campPitchRow["PricePerSlot"];
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

</body>
</html>