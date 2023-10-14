<?php 
include('connection.php');
include('searchFunction.php');
include('functions.php');
$_SESSION['lastPage'] = 'pitchTypeAndAvailability.php';
$_SESSION['loginLastPage'] = 'pitchTypeAndAvailability.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GWSC - Pitch Types and Availability</title>
    <script src="https://kit.fontawesome.com/84ff42f2da.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Old+Standard+TT&family=Source+Sans+3&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
            <a href="pitchTypeAndAvailability.php"  class="active">Pitch Types <br>& Availability </a>
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
    </header>
    <div class="searchControls centre">
        <form action="searchFunction.php" method="POST" class="row wrap">
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
            <input type="submit" value="Search" name = "btnSearch">
        </form>
    </div>
    
        <div class="CampsiteInfoContainer column centre" id="searchResults">
            <p id="searchParagraph">Please use the search bar to find the available campsites at the preferred date time and number of guests.</p>
        </div>
    
  
    <footer>
    <p>You are here: <a href="pitchTypeAndAvailability.php">PitchType and Availability</a></p>
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
    document.getElementById('dateSet').valueAsDate = new Date();
    </script>
    <script>
    $(document).ready(function () {
        const searchForm = $(".searchControls form");

        searchForm.on("submit", function (event) {
        event.preventDefault();

        const formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "searchFunction.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
            $("#searchResults").html(data);
            },
        });
        });
    });
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