
<?php
function get_formatDate($reviewPostedDate) {

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
return $formattedDate;
}
function isUserLockedOut ($userEmail, $connect) {
    $lockedOutDuration = 600; // 10 minutes in seconds

    // Calculate the timestamp for the time 10 minutes ago
    $timestampTenMinutesAgo = time() - $lockedOutDuration;

    $failedAttemptsCountQuery = "SELECT COUNT(*) AS failedAttempts FROM loginAttempts
        WHERE Email = '$userEmail'
        AND LastFailedAttemptTime >= FROM_UNIXTIME($timestampTenMinutesAgo)";

    $runfailedAttemptQuery = mysqli_query($connect, $failedAttemptsCountQuery);
    $failedAttemptRow = mysqli_fetch_assoc($runfailedAttemptQuery);
    if ($failedAttemptRow['failedAttempts'] >= 3)
    {
        return true;
    }
    else
    {
        return false;
    }
}
?>