<?php 
include('connection.php');
session_start();
if(isset($_POST['btnAdminRegister']))
{
    $adminName = $_POST['txtAdminName'];
    $adminEmail = $_POST['txtAdminEmail'];
    $phNum = $_POST['txtPhoneNumber'];
    $password = $_POST['txtpassword'];
    $address = $_POST['txtAddress'];

    $checkEmailQuery = "SELECT * from admins WHERE Email = '$adminEmail'";
    $runQuery = mysqli_query($connect, $checkEmailQuery);
    $queriedRows = mysqli_num_rows($runQuery);

    if($queriedRows > 0)
    {
        echo "<script>window.alert('Admin Email already exists! Please use another email.')</script>";
        echo "<script>window.location = 'AdminLogin.php' </script>";
    }
    else
    {
        $insertQuery = "INSERT into admins (AdminName, Email, Password, PhoneNumber, Address)
        Values ('$adminName', '$adminEmail', '$password', '$phNum', '$address') ";
        $runInsertQuery = mysqli_query($connect, $insertQuery);
        if ($runInsertQuery)
        {
            echo "<script>window.alert('Admin Registered Successfully')</script>";
			echo "<script>window.location = 'AdminLogin.php' </script>";
        }
    }
}
if(isset($_POST['btnAdminLogin']))
{
    $adminEmail = $_POST['txtAdminEmail'];
    $adminPassword = $_POST['txtpassword'];

    $checkLoginQuery = "SELECT * from admins WHERE Email = '$adminEmail' AND Password = '$adminPassword'";
    $runLoginQuery = mysqli_query($connect, $checkLoginQuery);
    $validRows = mysqli_num_rows($runLoginQuery);

    if($validRows > 0)
    {
        $AdminArray = mysqli_fetch_array($runLoginQuery);
        $AdminID = $AdminArray['AdminID'];
        $AdminName = $AdminArray['AdminName'];
        $AdminEmail = $AdminArray['Email'];
        $AdminPassword = $AdminArray['Password'];

        $_SESSION['AdminID'] = $AdminID;
        $_SESSION['AdminName'] = $AdminName;
        $_SESSION['AdminEmail'] = $AdminEmail;
        $_SESSION['AdminPassword'] = $AdminPassword;
        echo "<script>window.alert('Admin Login successful')</script>";
		echo "<script>window.location = 'AdminDashboard.php'</script>";
        unset($_POST['btnAdminLogin']);
    }
    else
    {
        unset($_POST['btnAdminLogin']);
        echo "<script>window.alert('Admin Login failed. Please try again later.')</script>";
		echo "<script>window.location = 'AdminLogin.php'</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/84ff42f2da.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Old+Standard+TT&family=Source+Sans+3&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
    <title>GWSC - Admin Login</title>
</head>
<body>
    <div class="AdminSignUpLoginForm" id="AdminRegisterForm">
        <form action="AdminLogin.php" method="POST">
        <h1>Admin Register Form</h1>
		<label for="txtAdminName">Admin  Name</label>
		<input type="text" name="txtAdminName" placeholder="Enter Admin name.." required><br><br>

		<label for="txtAdminEmail">Email</label>
		<input type="email" name="txtAdminEmail" placeholder="Enter Admin Email.." required><br><br>

		<label for="txtPhoneNumber">PhoneNumber</label>
		<input type="text" name="txtPhoneNumber" placeholder="Enter Admin Phone Number.." required><br><br>

		<label for="txtpassword">Password</label>
		<input type="password" name="txtpassword" placeholder="Enter password.." required><br><br>

		<label for="txtAddress">Address</label>
		<input type="text" name="txtAddress" placeholder="Enter Admin Address.." required><br><br>

		<button type="submit" name="btnAdminRegister">
			Register
		</button> <br>
        <p class="">Already have an account? <a href="#" id="LoginLink">Login</a></p>
		
        </form>
    </div>
    <div class= "AdminSignUpLoginForm" id="AdminLoginForm">
    <form action="AdminLogin.php" method="POST">
        <h1>Admin Login Form</h1>
		
		<label for="txtAdminEmail">Email</label>
		<input type="email" name="txtAdminEmail" placeholder="Enter Admin Email.." required><br><br>

		<label for="txtpassword">Password</label>
		<input type="password" name="txtpassword" placeholder="Enter password.." required><br><br>

		<button type="submit" name="btnAdminLogin">
			Login
		</button> <br>
        <p class="">Don't have an account? <a href="#" id="RegisterLink">Register</a></p>
		
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $("#AdminLoginForm").show();
            $("#AdminRegisterForm").hide();

            $("#RegisterLink").click(function() {
                $("#AdminLoginForm").hide();
                $("#AdminRegisterForm").show();
            });

            $("#LoginLink").click(function() {
                $("#AdminRegisterForm").hide();
                $("#AdminLoginForm").show();
            });
        });
    </script>
</body>
</html>