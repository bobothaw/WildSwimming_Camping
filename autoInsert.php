<?php 
include('connection.php');
set_time_limit(1000);
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