<?php 
include('connection.php');
$initialDate = new DateTime('2023-09-01');
$endDate = new DateTime('2023-12-31');
$availSpace = 20;
$campsitePitchQuery = "SELECT * from campsite_pitchtype";
$runcampsitePitchQuery = mysqli_query($connect, $campsitePitchQuery);
while ($campPitchRow = mysqli_fetch_assoc($runcampsitePitchQuery))
{
    $campsiteID = $campPitchRow["CampsiteID"];
    $pitchTypeID =  $campPitchRow["PitchTypeID"];
    $currentDate = clone $initialDate;
    while ($currentDate <= $endDate)
    {
        $formattedDate = $currentDate->format('Y-m-d');
        $currentDate->modify('+1 day');
        $insertAvailQuery = "INSERT INTO Available_Campsites (CampsiteID, PitchTypeID, Avail_Spaces, Avail_Date)
        Values ('$campsiteID', '$pitchTypeID', '$availSpace', '$formattedDate')";
        $runInsertQuery = mysqli_query($connect, $insertAvailQuery);
        if (!$runInsertQuery)
        {
            echo "Something went wrong one time for each one line of this.";
            exit();
        }
        
    }
}
echo "Successfully inserted. Check the database.";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
// while ($campPitchRow = mysqli_fetch_assoc($runcampsitePitchQuery))
// {
//     echo $campPitchRow["CampsiteID"];
//     echo $campPitchRow["PitchTypeID"];
//     $currentDate = clone $initialDate;
//     while ($currentDate <= $endDate)
//     {
//         $formattedDate = $currentDate->format('Y-m-d');
//         echo $formattedDate;
//         echo " ";
//         $currentDate->modify('+1 day');
//         echo $availSpace;
//         echo "<br>";
//     }
// }
?>
</body>
</html>