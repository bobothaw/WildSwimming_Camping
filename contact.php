<?php 
include('connection.php');
session_start();
include('functions.php');
$_SESSION['lastPage'] = 'contact.php';
$_SESSION['loginLastPage'] = 'contact.php';


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
    <div class="ContactContainer column centre">
        <h1>Ask us anything</h1>
        <div class="ContactWrapper row wrap">
            <div class="ContactAddressesContainer column">
                <h2>Contact Addresses</h2>
                <div class="ContactAddress row">
                    <i class="fa-solid fa-phone"></i>
                    <a href="tel: +959759803723">09-759803723</a>
                </div>
                <div class="ContactAddress row">
                    <i class="fa-regular fa-envelope"></i>
                    <a href="mailto: bobothaw15@gmail.com">bobothaw15@gmail.com</a>
                </div>
                <div class="ContactAddress row">
                    <i class="fa-solid fa-building"></i>
                    <p>49 6th Dr.Oak Park, MI 48237</p>
                </div>
            </div>
            <div class="ContactForm column">
                <h2>Contact Form</h2>
                <form action="contact.php" method="POST" class="column">
                    <div class="FormElements column">
                        <label for="">Name</label>
                        <input type="text" name = "txtContactName" placeholder="Please enter your name here..." required>
                    </div>
                    <div class="FormElements column">
                        <label for="">Email</label>
                        <input type="text" name = "txtContactEmail" placeholder="Please enter your email here..." required>
                    </div>
                    <div class="FormElements column">
                        <label for="">Subject</label>
                        <input type="text" name = "txtContactSubject" placeholder="Please enter your subject of the question here..." required>
                    </div>
                    <div class="FormElements column">
                        <label for="">Message</label>
                        <textarea name = "txtContactMessage" id="" cols="30" rows="10" placeholder="Please enter the details of your question here..." required></textarea>
                    </div>
                    <div class="FormElements row align_top">
                        <input type="checkbox" name="chkContact">
                        <label for="">I have agreed to the terms and condition of the GWSC's <a href="privacyPolicy.php" target="_blank">Privacy Policy</a></label>
                    </div>
                    <div class="FormElements centre">
                        <input type="submit" value="Send Message" id="ContactSubmit" name="btnContactSubmit" disabled>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php 
    if (isset($_POST['btnContactSubmit']))
    {
      if (isset($_SESSION['CusID']))
      {
        $contactName = $_POST['txtContactName'];
        $contactEmail = $_POST['txtContactEmail'];
        $contactSubject = $_POST['txtContactSubject'];
        $contactMessage = $_POST['txtContactMessage'];
        $currentDateTime = date("Y-m-d h:i:s", time());
        $insertContactQuery = "INSERT into Contacts (ContactName, Email, ContactSubject, ContactMessage, ContactDateTime)
        Values ('$contactName', '$contactEmail', '$contactSubject', '$contactMessage', '$currentDateTime')";
        $runInsertContactQuery = mysqli_query($connect, $insertContactQuery);
        if ($runInsertContactQuery)
        {
            echo "<script>window.alert('Your question is submitted successfully')</script>";
        }
      }
      else
      {
        echo "<script>window.alert('Please login first!')</script>";
      }
    }
    ?>
    <footer>
    <p>You are here: <a href="contact.php">Contact</a></p>
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
        document.addEventListener("DOMContentLoaded", function () {
            var checkBox = document.querySelector("input[name='chkContact']");
            var submitButton = document.getElementById("ContactSubmit");

            checkBox.addEventListener("change", function () {
                submitButton.disabled = !checkBox.checked;
            });
        });
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
          new google.translate.TranslateElement("google_element");
      }
  </script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>