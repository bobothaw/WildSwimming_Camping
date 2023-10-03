<?php 
include('connection.php');
session_start();
    if (isset($_POST['btnBookCampsite']))
    {
        if (isset($_SESSION['CusID']))
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
                    $paymentType = $_POST['paymentRadio'];
                    if ($paymentType == "Paypal")
                    {
                        $paymentInfo = $_SESSION['CusEmail'];
                    }
                    else if ($paymentType == "Debit")
                    {
                        $paymentInfo = $_POST['txtPaymentInformation'];
                    }
                    else 
                    {
                        $paymentInfo = "null";
                    }

                    $bookingQuery = "INSERT into bookings(BookingDateTime, NumOfGuests, CheckInDate, CheckOutDate, TotalPrice, CampsiteID, PitchTypeID, CustomerID, PaymentType, PaymentCredential)
                    Values('$currentDateTime', '$numOfGuest', '$checkInDate', '$checkOutDate','$totalPrice', '$campsiteID', '$pitchTypeID', '$CusID', '$paymentType', '$paymentInfo')";
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
        else
        {
            echo "<script>window.alert('Please login first!')</script>";
            echo "<script>window.history.back()</script>";
        }
    }
?>