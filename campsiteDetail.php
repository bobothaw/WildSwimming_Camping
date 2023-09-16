<?php 
include('connection.php');
session_start();

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
        echo "<script>window.location = 'home.php' </script>";
    }
    else
    {
        $insertQuery = "INSERT into customers (FirstName, LastName, Email, Password, PhoneNumber, Address)
        Values ('$customerFName', '$customerSName',  '$customerEmail', '$password', '$phNum', '$address') ";
        $runInsertQuery = mysqli_query($connect, $insertQuery);
        if ($runInsertQuery)
        {
            echo "<script>window.alert('Customer Registered Successfully')</script>";
			      echo "<script>window.location = 'home.php' </script>";
        }
    }
}
if (isset($_SESSION['FailedLoginAttempts']) && $_SESSION['FailedLoginAttempts'] >= 3) 
{
    echo "<script>window.alert('Too many failed login attempts. Please try again later after 5 second.')</script>";
    unset($_SESSION['FailedLoginAttempts']);
    echo "<meta http-equiv='refresh' content='5;url=home.php'>";
    if (isset($_SESSION['btnCusLogin']))
    {
      unset($_SESSION['btnCusLogin']);
    }
    exit;
}
if(isset($_POST['btnCusLogin']))
{
    $customerEmail = $_POST['txtCusEmail'];
    $password = $_POST['txtCusPassword'];

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
        $_SESSION['FailedLoginAttempts'] = 0;
        $_SESSION['LastFailedLoginTime'] = 0;
		    echo "<script>window.location = 'home.php'</script>";
    }
    else
    {
      $_SESSION['FailedLoginAttempts'] = isset($_SESSION['FailedLoginAttempts']) ? $_SESSION['FailedLoginAttempts'] + 1 : 2;
      echo "<script>window.alert('Customer Login failed')</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GWSC - Contact</title>
    <script src="https://kit.fontawesome.com/84ff42f2da.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Old+Standard+TT&family=Source+Sans+3&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <nav>
        <img src="Images/GWSC_logo.png" alt="Maple_Woods Logo" class="logo" />
        
        <div class="link-container link">
        <div class="link" id="drop">
            <a href="#" onclick="dropMenu()">Pages <i class="fa-solid fa-angle-down drop_angle"></i></a>
            <div id="dropdown_menu">
            <div class="link">
                <a href="information.php">Information</a>
            </div>
            <div class="link">
                <a href="pitchTypeAndAvailability.php">Pitch Types <br>& Availability </a>
            </div>
            <div class="link">
                <a href="reviews.php"> Reviews </a>
            </div>
            <div class="link">
                <a href="features.php">Features</a>
            </div>
            <div class="link">
                <a href="contact.php">Contact</a>
            </div>
            <div class="link">
                <a href="localAttractions.php">Local Attractions</a>
            </div>
            </div>
        </div>
        <?php 
            if (isset($_SESSION['CusFName']))
            {
                ?>
                <a href="#" id="login"><i class="fa-solid fa-user"></i> <?php echo $_SESSION['CusFName']  ?> </a>
                <?php 
            }

            else
            {
                ?> 
                <a href="#" id="login"><i class="fa-solid fa-user"></i>Login / SignUp</a>
                <?php 
            }

        ?>
        
        </div>
    </nav>
    <div class="campsiteSlot column">
        <div class="campsiteHeader row wrap">
            <div class="headerName">Long Ass Campsite Name </div>
            <div class="headerPitchType row">
                <i class="fa-solid fa-user"></i>
            </div>
        </div>
        <div class="RatingAndLocation row wrap">
            <div class="Rating"></div>
            <div class="Location"></div>
        </div>
        <div class="CampsiteDetailImages row">
            <div class="PrincipleImage">
                <img src="" alt="">
            </div>
            <div class="SideImages column">
                <div class="UpperSideImage"></div>
                <div class="LowerSideImage"></div>
            </div>
        </div>
        <div class="CampsiteDescription row">
            <div class="DescriptionText column">
                <div class="AboutCampsite"></div>
                <div class="DescFeature"></div>
            </div>
            <div class="BookingSideBar searchControls">
                <form action="searchFunction.php" method="POST" class="column">
                    <?php 
                    $currentDate = date("Y-m-d");
                    $minEndDate = date("Y-m-d", strtotime('+1 day', strtotime($currentDate)));
                    ?>
                    <div class="column">
                        <label for="startDate">Check In Date</label>
                        <input type="date" name="startDate" id="dateSet" min ="<?= $currentDate ?>" max="2023-12-31" required>
                    </div>
                    <div class="column">
                        <label for="endDate">Check Out Date</label>
                        <input type="date" name="endDate" min = "<?= $minEndDate ?>" max="2023-12-31" required>
                    </div>
                    <div class="column">
                        <label for="cboPitchType">Pitch Type</label>
                        <select name="cboPitchType" id="PitchTypeSelect" required>
                        <option value="" disabled selected>Select the pitch type</option>
                            <?php
                                $pitchTypeSelectQuery = "SELECT * from pitchtypes";
                                $runQuery = mysqli_query($connect, $pitchTypeSelectQuery);
                                $pitchTypeRowCount = mysqli_num_rows($runQuery);
                                for ($i = 0; $i < $pitchTypeRowCount; $i++)
                                {
                                    $pitchTypeArray = mysqli_fetch_array($runQuery);
                                    $PitchTypeID = $pitchTypeArray['PitchTypeID'];
                                    $PitchTypeName = $pitchTypeArray['PitchTypeName'];
                                    echo "<option value = '$PitchTypeID'>$PitchTypeName</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="column">
                        <label for="numOfPeople">Guests</label>
                        <input type="number" name="numOfPeople" min = "1" max = "20" value="1">
                    </div>
                    <input type="submit" value="Search">
                </form>
            </div>
        </div>
        <div class="CampsiteReview column">
            <h1>Reviews</h1>
            <div class="ReviewStar row">
                <span>4.5/5</span>
                <i class="fa-star fa-solid"></i>
            </div>
            <div class="ReviewSubmit">
                <form action="">
                <div class="rating">
                    <input type="radio" id="star5" name="rating" value="5">
                    <label for="star5"></label>
                    <input type="radio" id="star4" name="rating" value="4">
                    <label for="star4"></label>
                    <input type="radio" id="star3" name="rating" value="3">
                    <label for="star3"></label>
                    <input type="radio" id="star2" name="rating" value="2">
                    <label for="star2"></label>
                    <input type="radio" id="star1" name="rating" value="1">
                    <label for="star1"></label>
                </div>
                <input type="hidden" id="selected-rating" name="selected-rating">
                    <label for="txtReviewTitle"></label>
                    <input type="text" name="txtReviewTitle">
                    <label for="txtReviewDesc"></label>
                    <textarea name="txtReviewDesc" id="" cols="30" rows="10"></textarea>
                    <input type="submit" value="Submit Review">
                </form>
            </div>
        </div>
        <div class="LocationMap">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15277.354537074432!2d96.12089354999999!3d16.809548550000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1ebde5f0b2bad%3A0x5e765a10681bf5a8!2sTea%20House!5e0!3m2!1sen!2smm!4v1694895983027!5m2!1sen!2smm" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="LocalAttractionContainer row wrap">
            <div class="LocalAttractionSlot">
                <img src="" alt="">
                <div class="AttractionDesc">
                    <h5>AttractionName</h5>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <p>You are here: <a href="home.php">Home</a></p>
        <p>Copyright &copy; 2023 GWSC. All rights reserved.</p>
        <a href="https://facebook.com"><img src="Images/facebookLogo.png" alt="Facebook Logo" class="social-media-icon" /></a>
        <a href="https://twitter.com"><img src="Images/instaLogo.png" alt="Instagram Logo" class="social-media-icon" /></a>
        <a href="https://www.instagram.com/"><img src="Images/twitterLogo.png" alt="Twitter Logo" class="social-media-icon" /></a>
    </footer>
    <div class="modal-bg">
    <div class="modal-content">
        <div class="close" id="close">+</div>
        <form action="home.php" class="modal-box" id="login_form" method="POST">
            <h3 class="modal_heading">
            Welcome Back!
            </h3>

            <input type="email" name = "txtCusEmail" placeholder="Please enter your email" class="modal-email" required>
            <input type="password" name = "txtCusPassword" placeholder="Please enter the password" class="modal-email" required>

            <a href="#" class="modal_text">Forgot Password?</a>
            <div class="g-recaptcha" data-sitekey="6LfhaGQnAAAAADtUt1H7vF1tHa0ZvSae5iwBZ34S" data-callback = "enableLoginBtn"></div>
            <input type="submit" value="Login" class="modal-button" id="login_btn" name="btnCusLogin" disabled>
            <p class="modal_text">Don't have an account? <a href="#" id="signIN">SignUp</a></p>
        </form>
        <form action="home.php" class="modal-box" id="signup_form" method="POST">
            <h3 class="modal_heading">
                Create an Account
            </h3>
            <input type="text" name = "txtCusFName" placeholder="Please enter your first name" class="modal-email" required>
            <input type="text" name = "txtCusSName" placeholder="Please enter your surname" class="modal-email" required>
            <input type="email" name = "txtCusEmail" placeholder="Please enter your email" class="modal-email" required>
            <input type="password" name = "txtCusPassword" placeholder="Please enter the password" class="modal-email" required>
            <input type="text" name = "txtPhoneNumber" placeholder = "Please enter your phone number" class = "modal-email" required>
            <input type="text" name = "txtAddress" placeholder="Please enter your address" class="modal-email" required>

            <div class="g-recaptcha" data-sitekey="6LfhaGQnAAAAADtUt1H7vF1tHa0ZvSae5iwBZ34S" data-callback = "enableSignUpBtn"></div>
            <input type="submit" value="SignUp" class="modal-button" id="signup_btn" name = "btnCusSignUp" disabled>
            <p class="modal_text">Already have an account? <a href="#" id="LogIN">Login</a></p>
        </form>
        </div>
    </div>
  <script>
        document.getElementById('signIN').addEventListener('click',
        function() {
            document.getElementById('signup_form').style.display = 'block';
            document.getElementById('login_form').style.display = 'none';
        });
        document.getElementById('LogIN').addEventListener('click',
        function() {
            document.getElementById('signup_form').style.display = 'none';
            document.getElementById('login_form').style.display = 'block';
        });
        document.querySelector('.close').addEventListener('click',
        function() {
            document.querySelector('.modal-bg').style.display = 'none';
        });
        
        
        document.getElementById('login').addEventListener('click',
        function() {
            document.querySelector('.modal-bg').style.display = 'flex';
        });
        function enableLoginBtn(){
        document.getElementById('login_btn').disabled = false;
        }
        function enableSignUpBtn(){
        document.getElementById('signup_btn').disabled = false;
        }
        function dropMenu() {
    var dropdownMenu = document.getElementById("dropdown_menu");
    if (dropdownMenu.style.display == "none") {
        dropdownMenu.style.display = "flex";
    } else {
        dropdownMenu.style.display = "none";
    }
    }
  </script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>