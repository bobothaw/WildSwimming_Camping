<?php 
include('connection.php');
include('searchFunction.php');

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
if (isset($_GET['CampID']))
{
    $campsiteID = $_GET['CampID'];
    $campsiteQuery = "SELECT c.CampsiteName, c.Image1, c.Image2, c.Image3, ctr.CountryID, ctr.CountryName, c.WildSwimming, c.Description, c.MapLocation
    FROM Campsites c, Countries ctr
    WHERE c.CampsiteID = $campsiteID
    AND c.CountryID = ctr.CountryID";
    $runCampsiteQuery = mysqli_query($connect, $campsiteQuery);
    $campsiteArray = mysqli_fetch_assoc($runCampsiteQuery);
    $countryID = $campsiteArray['CountryID'];
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <div class="campsiteHeader row wrap centre">
            <div class="headerName"><h1><?= $campsiteArray['CampsiteName'] ?> </h1></div>
            <div class="headerPitchType row">
                <?php 
                $pitchTypeQuery = "SELECT pt.PitchTypeName, pt.PitchTypeImg
                from PitchTypes pt, Campsite_PitchType cpt
                WHERE cpt.CampsiteID = $campsiteID
                AND pt.PitchTypeID = cpt.PitchTypeID";
                $runpitchTypeQuery = mysqli_query($connect, $pitchTypeQuery);
                while($pitchTypeArray = mysqli_fetch_assoc($runpitchTypeQuery))
                {
                    ?>
                    <img src="<?= $pitchTypeArray['PitchTypeImg'] ?>" alt="<?= $pitchTypeArray['PitchTypeName'] ?>" title = "<?= $pitchTypeArray['PitchTypeName'] ?>">
                    <?php 
                }
                ?>
            </div>
        </div>
        <div class="RatingAndLocation row wrap">
            <div class="Rating row">
                <?php
                    $reviewQuery = "SELECT ROUND (AVG(r.StarCount), 1) AS AVGReviews
                    From Reviews r
                    WHERE r.CampsiteID = $campsiteID";
                    $runreviewQuery = mysqli_query($connect, $reviewQuery);
                    $reviewCount = mysqli_num_rows($runreviewQuery);
                    if ($reviewCount == 1)
                    {
                        $reviewArray = mysqli_fetch_array($runreviewQuery);
                        ?>
                        <p><i class="fa-solid fa-star"></i> <?= $reviewArray["AVGReviews"]."/5"; ?></p>
                        <?php
                    }
                ?>
            </div>
            <div class="Country">
                <p><?= $campsiteArray['CountryName'] ?></p>
            </div>
        </div>
        <div class="CampsiteDetailImages row">
            <div class="PrincipleImage">
                <img src="<?= $campsiteArray['Image1'] ?>" alt="">
            </div>
            <div class="SideImages column">
                <div class="UpperSideImage">
                    <img src="<?= $campsiteArray['Image2'] ?>" alt="">
                </div>
                <div class="LowerSideImage">
                    <img src="<?= $campsiteArray['Image3'] ?>" alt="">
                </div>
            </div>
        </div>
        <div class="CampsiteDescription row wrap">
            <div class="DescriptionText column">
                <div class="AboutCampsite column">
                    <h2>About <?= $campsiteArray['CampsiteName'] ?></h2>
                    <p><?= $campsiteArray['Description'] ?></p>
                </div>
                <div class="FeatureContainer column">
                    <h2>Features in <?= $campsiteArray['CampsiteName'] ?></h2>
                    <?php
                        $campsiteFeatureQuery = "SELECT f.FeatureIcon, f.FeatureName from
                        Features f, Campsite_Feature cf
                        WHERE f.FeatureID = cf.FeatureID
                        AND cf.CampsiteID = $campsiteID";
                        $runcampsiteFeatureQuery = mysqli_query($connect, $campsiteFeatureQuery);
                        while($campsiteFeatureRow = mysqli_fetch_assoc($runcampsiteFeatureQuery)){
                            ?> 
                            <div class="FeaturesList row">
                            <?php
                            echo $campsiteFeatureRow["FeatureIcon"];
                            ?>
                            <p><?= $campsiteFeatureRow['FeatureName'] ?></p>
                            </div>
                            <?php
                        }
                    ?>
                </div>
            </div>
            <div class="BookingSideBar column">
                <div class="CheckInDate">Check In Date: <?= $_SESSION['searchStartDate'] ?></div>
                <div class="CheckInDate">Check Out Date: <?= $_SESSION['searchEndDate'] ?></div>
                <div class="CheckInDate">Selected Pitch Type: 
                    <?php
                
                        $pitchTypeID = $_SESSION['searchPitchType'];
                        $selectedPitchQuery = "SELECT PitchTypeName
                        FROM PitchTypes WHERE PitchTypeID = $pitchTypeID";
                        $runselectedPitchQuery = mysqli_query($connect, $selectedPitchQuery);
                        $arrayCount = mysqli_num_rows($runselectedPitchQuery);
                        if ($arrayCount == 1)
                        {
                            $pitchTypeArray = mysqli_fetch_array($runselectedPitchQuery);
                            echo $pitchTypeArray['PitchTypeName'];
                        }
                        
                        ?></div>
                <div class="CheckInDate">Total Guests: <?= $_SESSION['searchNumPeople']." guests" ?></div>
                <hr>
                <div class="CheckInDate" id = TotalPrice>Total Price:  
                    <?php 
                        $neededPitchCount = $_SESSION['searchNumPeople'] / 5;
                        $selectedPitch = $_SESSION['searchPitchType'];
                        $priceQuery = "SELECT PricePerSlot
                        FROM campsite_pitchtype
                        WHERE CampsiteID = $campsiteID
                        AND PitchTypeID = $selectedPitch";
                        $runPriceQuery = mysqli_query($connect, $priceQuery);
                        $priceArray = mysqli_fetch_array($runPriceQuery);
                        $actualPrice = $neededPitchCount * $priceArray['PricePerSlot'];
                        echo $actualPrice."$";
                        
                    ?>
                </div>
                <form action="" method = "POST">
                    <input type="submit" value = "Book Now">
                </form>
            </div>
        </div>
        <hr>
        <div class="CampsiteReview column">
            <div class="ReviewSubmit">
                <?php 
                    if (isset($_POST['btnSubmitReview']))
                    {
                        $starCount = $_POST['rating'];
                        $reviewTitle = $_POST['txtReviewTitle'];
                        $reviewDesc = $_POST['txtReviewDesc'];
                        $reviewInsertQuery = "INSERT into reviews
                        Values('$campsiteID', '$CusID', '$reviewTitle', '$reviewDesc', '$starCount')";
                        $runInsertQuery = mysqli_query($connect, $reviewInsertQuery);
                    }
                ?>
                <form action="campsiteDetail.php" method = "POST">
                    <h2 class="centre">Submit your review</h2>
                <div class="submitStar centre">
                    <div class="submitStarInput">
                        <input type="radio" id="star5" name="rating" value="5" required>
                        <label for="star5"><i class="fa-regular fa-star"></i></label>
                    </div>
                    <div class="submitStarInput">
                        <input type="radio" id="star4" name="rating" value="4" required>
                        <label for="star4"><i class="fa-regular fa-star"></i></label>
                    </div>
                    <div class="submitStarInput">
                        <input type="radio" id="star3" name="rating" value="3" required>
                        <label for="star3"><i class="fa-regular fa-star"></i></label>
                    </div>
                    <div class="submitStarInput">
                        <input type="radio" id="star2" name="rating" value="2" required>
                        <label for="star2"><i class="fa-regular fa-star"></i></label>
                    </div>
                    <div class="submitStarInput">
                        <input type="radio" id="star1" name="rating" value="1" required>
                        <label for="star1"><i class="fa-regular fa-star"></i></label>
                    </div>
                </div>
                <div class="ratingText column">
                    <label for="txtReviewTitle">Title of your review</label>
                    <input type="text" name="txtReviewTitle" required>
                    <label for="txtReviewDesc">Tell us what you feel about this campsite</label>
                    <textarea name="txtReviewDesc" id="" cols="30" rows="10" required></textarea>
                    <input type="submit" name = "btnSubmitReview" value="Submit Review" id = "submit-button">
                </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="LocationMap centre column">
            <h2>Campsite Location on the Map</h2>
            <iframe src=<?= $campsiteArray['MapLocation'];?> allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <hr>
        <h2 class="centre" id="localAttrHeading">Local Attractions near the campsite</h2>
        <div class="LocalAttractionContainer row wrap" id="campsiteLocalAttr">
            <?php 
                $localAttrcQuery = "SELECT la.AttractionID, la.AttractionName, c.CountryName, la.AttractionDesc, la.AttractionImage
                From local_attractions la, countries c 
                Where c.CountryID = la.CountryID
                AND c.CountryID = $countryID";
                $runAttractionQuery = mysqli_query($connect, $localAttrcQuery);
                if (mysqli_num_rows($runAttractionQuery) > 0) {
                    while ($attrRow = mysqli_fetch_assoc($runAttractionQuery)) {
                        ?>
                        <div class="attraction_slot row">
                            <div class="attrImage">
                                <img src="<?php echo $attrRow["AttractionImage"];?>" alt="">
                            </div>
                            <div class="AttrText column">
                                <div class="AttrHeading"><h1><?php echo$attrRow["AttractionName"]; ?></h1></div>
                                <div class="AttrCountry"><h3><?php echo$attrRow["CountryName"]; ?></h3></div>
                                <div class="AttrDesc"><p><?php echo$attrRow["AttractionDesc"]; ?></p></div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="Intro">There is no data available</div>
                    <?php 
                }
            ?>
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
    $(document).ready(function () {

    const ratingInputs = $('.submitStar input');
    ratingInputs.on('mouseenter', function () {
      const hoverValue = $(this).val();
      resetStars();
      highlightStars(hoverValue);
    });

    ratingInputs.on('mouseleave', function () {
        if ($('input[name="rating"]:checked').length === 0) {
            resetStars(); 
        }
        const checkedRating = $('input[name="rating"]:checked').val();
        if (checkedRating !== undefined) {
            resetStars();
            highlightStars(checkedRating);
        }
    });

    function highlightStars(value) {
      ratingInputs.each(function () {
        if ($(this).val() <= value) {
          $(this).next('label').children('i').addClass('fa-solid').removeClass('fa-regular');
        }
      });
    }

    function resetStars() {
      ratingInputs.each(function () {
        $(this).next('label').children('i').addClass('fa-regular').removeClass('fa-solid');
      });
    }

    $('#submit-button').on('click', function () {
      // Get the selected rating value directly from the radio inputs
      const selectedRating = $('input[name="rating"]:checked').val();
      alert('Review submitted with rating: ' + selectedRating);
    });
  });
  </script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>