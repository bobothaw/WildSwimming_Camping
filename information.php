<?php 
include('connection.php');
session_start();
include('functions.php');
$_SESSION['lastPage'] = 'home.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GWSC - Information</title>
    <script src="https://kit.fontawesome.com/84ff42f2da.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Old+Standard+TT&family=Source+Sans+3&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <nav>
    <a href="home.php"><img src="Images/GWSC_logo.png" alt="" class="logo" /></a>
        
        <div class="link-container link row">
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
                <a href="#" id="login"><i class="fa-solid fa-user"></i> Login / SignUp</a>
                <?php 
            }

        ?>
        <a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>Logout</a>
        </div>
    </nav>
    <div class="searchbar">
        <form action="information.php" id="searchForm" method="POST">
        <input type="text" placeholder="Search....." name="txtSearchResult" />
        <button type="submit" name="search-btn">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
        </button>
        </form>
    </div>
    <?php 
    
    ?>
        <div class="CampsiteInfoContainer column centre">
            
            <?php 
            $campsiteQuery = "SELECT * from Campsites";
            if (isset($_POST['search-btn']))
            {
                $userInput = $_POST['txtSearchResult'];
                $campsiteQuery = "SELECT DISTINCT c.* from Campsites AS c
                Inner Join Countries AS co On co.CountryID = c.CountryID
                Inner Join Campsite_pitchtype AS cp On cp.CampsiteID = c.CampsiteID
                Inner Join PitchTypes AS pt ON pt.PitchTypeID = cp.PitchTypeID
                WHERE c.CampsiteName LIKE '%$userInput%'
                OR c.City LIKE '%$userInput%'
                OR co.CountryName LIKE '%$userInput%'
                OR pt.PitchTypeName LIKE '%$userInput%'
                OR c.Description LIKE '%$userInput%'";
            }
            
            $runcampsiteQuery = mysqli_query($connect, $campsiteQuery);
            if (mysqli_num_rows($runcampsiteQuery) > 0)
            {
                while($campsiteRow = mysqli_fetch_assoc($runcampsiteQuery)){
                    $campsiteID = $campsiteRow["CampsiteID"];
                    ?>
                    <div class="CampInfo row">
                        <div class="CampSiteImage">
                            <img src="<?php echo $campsiteRow["Image1"];?> " alt="">
                            <iframe src=<?= $campsiteRow["MapLocation"];?> allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <div class="CampsiteText column">
                            <div class="CampsiteName centre">
                                <?= $campsiteRow["CampsiteName"];?>
                            </div>
                            <div class="CampsiteFeatures row wrap">
                                <?php
                                    $campsiteFeatureQuery = "SELECT f.FeatureIcon from
                                    Features f, Campsite_Feature cf
                                    WHERE f.FeatureID = cf.FeatureID
                                    AND cf.CampsiteID = $campsiteID";
                                    $runcampsiteFeatureQuery = mysqli_query($connect, $campsiteFeatureQuery);
                                    while($campsiteFeatureRow = mysqli_fetch_assoc($runcampsiteFeatureQuery)){
                                        echo $campsiteFeatureRow["FeatureIcon"];
                                    }
                                ?>
                            </div>
                            <div class="CampsitePitchTypes row wrap">
                                <?php
                                    $campsitePitchQuery = "SELECT pt.PitchTypeName, cp.PricePerSlot
                                    FROM PitchTypes pt, Campsite_pitchtype cp
                                    WHERE cp.CampsiteID = $campsiteID
                                    AND pt.PitchTypeID = cp.PitchTypeID";
                                    $runcampsitePitchQuery = mysqli_query($connect, $campsitePitchQuery);
                                    while ($campsitePitchRow = mysqli_fetch_assoc($runcampsitePitchQuery)){
                                        ?>
                                        <p><?= $campsitePitchRow["PitchTypeName"].": ".$campsitePitchRow["PricePerSlot"]."$" ?></p>
                                        <?php
                                    }
                                ?>
                            </div>
                            <div class="ReviewAndSwimming row">
                                <div class="CampSiteReview row">
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
                                <div class="WildSwimming">
                                    <?php
                                        if ($campsiteRow["WildSwimming"] == 0){
                                            ?>
                                            <p>Wild Swimming:<i class="fa-solid fa-circle-xmark"></i></i></p>
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <p>Wild Swimming:<i class="fa-solid fa-circle-check"></i></i></p>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="centre row wrap">
                                <span>Nearby : </span>
                                <?php
                                $localAttrQuery = "SELECT la.AttractionName
                                FROM local_attractions la, campsites ca
                                Where ca.CampsiteID = $campsiteID
                                AND la.CountryID = ca.CountryID
                                LIMIT 1";
                                $localAttrQueryRun = mysqli_query($connect, $localAttrQuery);
                                while ($localAttrRow = mysqli_fetch_assoc($localAttrQueryRun))
                                {
                                    ?>
                                    <span><?= $localAttrRow["AttractionName"] ?>,</span>
                                    <?php
                                }
                                ?>
                                <span> &#160...</span>
                            </div>
                        </div>
                        <div class="CampInfoButton centre">
                            <a href="campsiteDetail.php?CampID=<?= $campsiteID?>">View Detailes</a>
                        </div>
                    </div>
                    <?php
                }
        
            }
            else
            {
                echo"Not found";
            }
            ?>
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

            
            <div class="g-recaptcha" data-sitekey="6LfhaGQnAAAAADtUt1H7vF1tHa0ZvSae5iwBZ34S" data-callback = "enableLoginBtn"></div>
            <input type="submit" value="Login" class="modal-button" id="login_btn" name="btnCusLogin" disabled>
            <p class="modal_text">Don't have an account? <a href="#" id="signIN">SignUp</a></p>
        </form>
        <form action="login.php" class="modal-box" id="signup_form" method="POST">
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
  <script>
    $(document).ready(function () {
        
        $(".CampSiteImage iframe").hide();

        $(".CampSiteImage").hover(
            function () {
                $(this).find("img").hide();
                $(this).find("iframe").show();
            },
            function () {
                $(this).find("iframe").hide();
                $(this).find("img").show();
            }
        );
    });
    </script>
    
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>