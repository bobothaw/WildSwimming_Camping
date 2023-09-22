<?php 
include('connection.php');
session_start();
    if (isset($_POST['btnSubmitReview']))
    {
        try {
            $starCount = $_POST['rating'];
            $reviewTitle = $_POST['txtReviewTitle'];
            $reviewDesc = $_POST['txtReviewDesc'];
            $CusID = $_SESSION['CusID'];
            $campsiteID = $_SESSION['CampsiteID'];
            $reviewInsertQuery = "INSERT into reviews
            Values('$campsiteID', '$CusID', '$reviewTitle', '$reviewDesc', '$starCount')";
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
?>