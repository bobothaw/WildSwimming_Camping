<?php 
include('connection.php');
session_start();
    if (isset($_POST['btnBookCampsite']))
    {
        try {
            $currentDateTime = date("Y-m-d h:i:s", time());
            $numOfGuest = $_SESSION['searchNumPeople'];
            $checkInDate = $_SESSION['searchStartDate'];
            $checkOutDate = $_SESSION['searchEndDate'];
            $CusID = $_SESSION['CusID'];
            $pitchTypeID = $_SESSION['searchPitchType'];
            $campsiteID = $_SESSION['CampsiteID'];
            $totalPrice = $_SESSION['totalPrice'];
            $bookingQuery = "INSERT into bookings(BookingDateTime, NumOfGuests, CheckInDate, CheckOutDate, TotalPrice, CampsiteID, PitchTypeID, CustomerID)
            Values('$currentDateTime', '$numOfGuest', '$checkInDate', '$checkOutDate','$totalPrice', '$campsiteID', '$pitchTypeID', '$CusID')";
            $runbookingInsertQuery = mysqli_query($connect, $bookingQuery);
            $updateAvailQuery = "UPDATE available_campsites
            SET Avail_Spaces = Avail_Spaces - $numOfGuest
            WHERE CampsiteID = $campsiteID
            AND PitchTypeID = $pitchTypeID
            AND Avail_Date BETWEEN '$checkInDate' AND '$checkOutDate'";
            $runUpdateAvailQuery = mysqli_query($connect, $updateAvailQuery);
            if ($runbookingInsertQuery && $runUpdateAvailQuery)
            {
                echo "<script>window.alert('The Campsite is booked Successfully at $currentDateTime')</script>";
                echo "<script>window.history.back()</script>";
            }
            }
            
            
            catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
            }
        
    }
?>