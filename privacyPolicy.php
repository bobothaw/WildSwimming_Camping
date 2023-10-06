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
    <title>GWSC - Privacy Policy</title>
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
    <div class="PrivacyPolicy">
        <h1>Privacy Policy of GWSC</h1>
        <p>Last Updated: [9.29.2023]</p>
        <p>Global Wild Swimming and Camping is committed to protecting your privacy and ensuring the security of your personal information. This Privacy Policy outlines our practices concerning the collection, use, and protection of your personal information when you interact with our wild swimming and camping services.</p>
        
        <p>Please take a moment to read this Privacy Policy carefully to understand how we handle your personal information. By using our services, you consent to the practices described in this Privacy Policy.</p>

        <h2>1. Information We Collect</h2>
        <p>We may collect the following types of information when you interact with us:</p>
        
        <h3>1.1. Personal Information:</h3>
        <ul>
            <li>Name</li>
            <li>Contact information (email address, phone number, address)</li>
            <li>Payment information</li>
            <li>Date of birth</li>
            <li>Passport or ID information (if required for bookings)</li>
            <li>Emergency contact details</li>
        </ul>

        <h3>1.2. Non-Personal Information:</h3>
        <ul>
            <li>Browsing history</li>
            <li>IP address</li>
            <li>Browser type</li>
            <li>Device information</li>
            <li>Cookies and similar technologies (please see our Cookie Policy for more details)</li>
        </ul>

        <h2>2. How We Use Your Information</h2>
        <p>We may use your personal information for the following purposes:</p>

        <h3>2.1. Providing Services:</h3>
        <ul>
            <li>Processing reservations and bookings</li>
            <li>Communicating with you about your bookings</li>
            <li>Providing you with information about our wild swimming and camping services</li>
        </ul>

        <h3>2.2. Improving Our Services:</h3>
        <ul>
            <li>Analyzing customer preferences and behaviors</li>
            <li>Conducting market research and surveys</li>
            <li>Enhancing and customizing your experience on our website</li>
        </ul>

        <h3>2.3. Legal and Safety Purposes:</h3>
        <ul>
            <li>Complying with legal obligations</li>
            <li>Protecting our rights, privacy, safety, or property</li>
            <li>Resolving disputes and enforcing our policies</li>
        </ul>

        <h2>3. Sharing Your Information</h2>
        <p>We may share your personal information with:</p>

        <h3>3.1. Service Providers:</h3>
        <p>Third-party companies or individuals who help us provide our services, such as payment processors, customer support services, and marketing partners.</p>

        <h3>3.2. Legal Compliance:</h3>
        <p>When required by law or to protect our rights, privacy, safety, or property.</p>

        <h2>4. Your Choices</h2>
        <p>You can choose to:</p>
        <ul>
            <li>Access, update, or delete your personal information by contacting us.</li>
            <li>Opt-out of marketing communications by following the unsubscribe instructions provided in our emails.</li>
            <li>Disable cookies in your browser, although this may affect your browsing experience.</li>
        </ul>

        <h2>5. Security</h2>
        <p>We take reasonable measures to protect your personal information from unauthorized access, use, or disclosure. However, no data transmission over the internet is entirely secure, and we cannot guarantee the security of your information.</p>

        <h2>6. Changes to this Privacy Policy</h2>
        <p>We may update this Privacy Policy from time to time. The most recent version will be posted on our website, with the effective date indicated at the beginning of the policy.</p>

        <h2>7. Contact Us</h2>
        <p>If you have any questions or concerns about this Privacy Policy or your personal information, please contact us at:</p>

        <p>Thank you for choosing Global Wild Swimming and Camping (GWSC). Your privacy is important to us, and we are committed to protecting it.</p>
    </div>
    <footer>
    <p>You are here: <a href="privacyPolicy.php">Privacy Policy</a></p>
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