<?php 
session_start();
include('connection.php');
include('functions.php');
$lastPage = $_SESSION['loginLastPage'];
if(isset($_POST['btnCusSignUp']))
{
    $customerFName = $_POST['txtCusFName'];
    $customerSName = $_POST['txtCusSName'];
    $customerEmail = $_POST['txtCusEmail'];
    $phNum = $_POST['txtPhoneNumber'];
    $password = $_POST['txtCusPassword'];
    $address = $_POST['txtAddress'];

    $checkEmailQuery = "SELECT * from customers WHERE Email = '$customerEmail'";
    $runQuery = mysqli_query($connect, $checkEmailQuery);
    $queriedRows = mysqli_num_rows($runQuery);

    if($queriedRows > 0)
    {
        echo "<script>window.alert('Customer Email already exists! Please use another email.')</script>";
        echo "<script>window.location = '$lastPage' </script>";
    }
    else
    {
        $insertQuery = "INSERT into customers (FirstName, LastName, Email, Password, PhoneNumber, Address)
        Values ('$customerFName', '$customerSName',  '$customerEmail', '$password', '$phNum', '$address') ";
        $runInsertQuery = mysqli_query($connect, $insertQuery);
        if ($runInsertQuery)
        {
            echo "<script>window.alert('Customer Registered Successfully')</script>";
			echo "<script>window.location = '$lastPage' </script>";
        }
    }
}
if(isset($_POST['btnCusLogin']))
{
    $customerEmail = $_POST['txtCusEmail'];
    $password = $_POST['txtCusPassword'];
    if (isUserLockedOut($customerEmail, $connect))
    {
      echo "<script>window.alert('User is locked out. Please try again after 10 minutes.')</script>";
      echo "<script>window.location = '$lastPage' </script>";
    }
    else
    {
      $checkLoginQuery = "SELECT * from customers WHERE Email = '$customerEmail' AND Password = '$password'";
      $runLoginQuery = mysqli_query($connect, $checkLoginQuery);
      $validRows = mysqli_num_rows($runLoginQuery);

      if($validRows > 0)
      {
          $CustomerArray = mysqli_fetch_array($runLoginQuery);
          $CusID = $CustomerArray['CustomerID'];
          $CusFName = $CustomerArray['FirstName'];
          $CusSName = $CustomerArray['LastName'];
          $CusEmail = $CustomerArray['Email'];
          $CusPassword = $CustomerArray['Password'];

          $_SESSION['CusID'] = $CusID;
          $_SESSION['CusFName'] = $CusFName;
          $_SESSION['CusSName'] = $CusSName;
          $_SESSION['CusEmail'] = $CusEmail;
          $_SESSION['CusPassword'] = $CusPassword;
          echo "<script>window.alert('Customer Login successful')</script>";
          echo "<script>window.location = '$lastPage' </script>";
      }
      else
      {
        $insertFailedQuery = "INSERT INTO loginAttempts (Email, LastFailedAttemptTime)
        Values ('$customerEmail', NOW())";
        $runinsertFailedQuery = mysqli_query($connect, $insertFailedQuery);
        if ($runinsertFailedQuery)
        {
          echo "<script>window.alert('Customer Login failed!')</script>";
        }
        if (isUserLockedOut($customerEmail, $connect) && $runinsertFailedQuery)
        {
          echo "<script>window.alert('Customer Login failed for 3 times and you account is locked for 10 minutes.')</script>";
        }
        echo "<script>window.location = '$lastPage'</script>";
      }
    }
    
}
?>