<?php 
include('connection.php');
session_start();
include('functions.php');
$_SESSION['lastPage'] = 'features.php';
$_SESSION['loginLastPage'] = 'features.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GWSC - Features</title>
    <script src="https://kit.fontawesome.com/84ff42f2da.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Old+Standard+TT&family=Source+Sans+3&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <header>
    <nav>
    <a href="home.php"><img src="Images/GWSC_logo.png" alt="GWSC logo" class="logo" /></a>
        
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
                <a href="features.php"  class="active">Features</a>
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
    </header>
    <div class="FeaturePageContainer row wrap">
        <div class="FeatureWholeContainer column">
            <h1 class="Intro centre">Features in the campsite</h1>
            <div class="feature_catalogue_container wrap row">
                <?php
                $featureQuery = "SELECT * FROM features";
                $runfeatureQuery = mysqli_query($connect, $featureQuery);
                if (mysqli_num_rows($runfeatureQuery) > 0) {
                    while ($featureRow = mysqli_fetch_assoc($runfeatureQuery)) {
                        ?>
                        <div class="feature_catalogue column">
                            <?php
                            echo $featureRow["FeatureIcon"];
                             ?>
                            <h3 class="centre"><?php echo $featureRow["FeatureName"]; ?></h3>
                            <p>
                                <?php
                                echo $featureRow["FeatureDesc"];
                                 ?>
                            </p>
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
        <div class="WerablesTechnologies column">
            <h2>Werable Technology Categories</h2>
            <p>Here are some of the werable technologies categories allowed at our campsites</p>
            <div class="WerableTechCatalogue row wrap">
                <div class="TechSlot column centre">
                    <img src="Images/icons8-smart-watch-100.png" alt="Smart Watch Image" class="TechImg">
                    <p>Smart Watches</p>
                </div>
                <div class="TechSlot column centre">
                    <img src="Images/icons8-earbud-headphones-64.png" alt="Headphone Image" class="TechImg">
                    <p>Hearables devices</p>
                </div>
                <div class="TechSlot column centre">
                    <img src="Images/icons8-google-glass-100.png" alt="Smart Glasses Image" class="TechImg">
                    <p>Smart Glasses</p>
                </div>
                <div class="TechSlot column centre">
                    <img src="Images/icons8-shirt-80.png" alt="Smart Clothing Image" class="TechImg">
                    <p>Smart Clothing</p>
                </div>
                <div class="TechSlot column centre">
                    <img src="Images/icons8-smart-jewelry-64.png" alt="Smart Jewelry Image" class="TechImg">
                    <p>Smart Jewelery</p>
                </div>
                <div class="TechSlot column centre">
                    <img src="Images/icons8-virtual-reality-64.png" alt="Augmented Reality Image" class="TechImg">
                    <p>Augmented Reality</p>
                </div>
            </div>
        </div>
    </div>
    <footer>
    <p>You are here: <a href="features.php">Features</a></p>
    <p>Copyright &copy; 2023 GWSC. All rights reserved.</p>
    <div class="socialMediaIcons row wrap">
      <a href="https://facebook.com"><i class="fa-brands fa-facebook"></i></a>
      <a href="https://twitter.com"><i class="fa-brands fa-instagram"></i></a>
      <a href="https://www.instagram.com/"><i class="fa-brands fa-x-twitter"></i></a>
      <a href="rss.php"><i class="fa-solid fa-rss"></i></a>
    </div>
        
    <div class="footer-icon-box translatebox row wrap" id="google_element">Select Prefered Language:</div>
    
  </footer>
    <div class="modal-bg">
    <div class="modal-content">
        <div class="close" id="close">+</div>
        <form action="login.php" class="modal-box" id="login_form" method="POST">
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
    <script src="http://translate.google.com/translate_a/element.js?cb=loadGoogleTranslate"></script>
  <script>
      function loadGoogleTranslate(){
            new google.translate.TranslateElement({
          defaultLanguage: 'en', 
          multilanguagePage: true
        }, 'google_element');
      }
  </script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>