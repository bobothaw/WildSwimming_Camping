
<?php
function get_formatDate($reviewPostedDate) {

$reviewDate = new DateTime($reviewPostedDate);

$currentDate = new DateTime();

$timeDifference = $currentDate->diff($reviewDate);

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
    $lockedOutDuration = 600; 

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

set_error_handler(function($errno, $errstr, $errfile, $errline) {
    if (0 === error_reporting()) {
        return false;
    }
    
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});
?>