<?php 
session_start();
unset($_SESSION['CusID']);
unset($_SESSION['CusFName']);
<?php
// Assuming you have the review's posted date in a variable like $reviewPostedDate
$reviewPostedDate = '2023-09-20'; // Replace this with the actual review date

// Convert the review posted date to a DateTime object
$reviewDate = new DateTime($reviewPostedDate);

// Get the current date
$currentDate = new DateTime();

// Calculate the time difference
$timeDifference = $currentDate->diff($reviewDate);

// Format the time difference
if ($timeDifference->y > 0) {
    $formattedDate = $timeDifference->y . ' year' . ($timeDifference->y > 1 ? 's' : '') . ' ago';
} elseif ($timeDifference->m > 0) {
    $formattedDate = $timeDifference->m . ' month' . ($timeDifference->m > 1 ? 's' : '') . ' ago';
} elseif ($timeDifference->d > 0) {
    $formattedDate = $timeDifference->d . ' day' . ($timeDifference->d > 1 ? 's' : '') . ' ago';
} elseif ($timeDifference->h > 0) {
    $formattedDate = $timeDifference->h . ' hour' . ($timeDifference->h > 1 ? 's' : '') . ' ago';
} elseif ($timeDifference->i > 0) {
    $formattedDate = $timeDifference->i . ' minute' . ($timeDifference->i > 1 ? 's' : '') . ' ago';
} else {
    $formattedDate = 'Just now';
}

// Output the formatted date
echo $formattedDate;
?>

?>