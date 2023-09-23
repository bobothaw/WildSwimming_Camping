<?php 
include('connection.php');
session_start();
    if (isset($_POST['btnSubmitReview']))
    {
        if (isset($_SESSION['CusID']))
        {
            try {
                $currentDate = date("Y-m-d");
                $starCount = $_POST['rating'];
                $reviewTitle = $_POST['txtReviewTitle'];
                $reviewDesc = $_POST['txtReviewDesc'];
                $CusID = $_SESSION['CusID'];
                $campsiteID = $_SESSION['CampsiteID'];
                $reviewInsertQuery = "INSERT into reviews (CampsiteID, CustomerID, ReviewTitle, ReviewDesc, StarCount, ReviewDate)
                Values('$campsiteID', '$CusID', '$reviewTitle', '$reviewDesc', '$starCount', '$currentDate')";
                $runInsertQuery = mysqli_query($connect, $reviewInsertQuery);
                if ($runInsertQuery)
                {
                    echo "<script>window.alert('Review Submitted Successfully')</script>";
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