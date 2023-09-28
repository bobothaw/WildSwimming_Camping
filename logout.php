<?php 
session_start();
$lastPage = $_SESSION['lastPage'];
header("Location: $lastPage");
session_destroy();
exit;
?>