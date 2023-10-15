<?php 
include('connection.php');
include('functions.php');
session_start();
$_SESSION['lastPage'] = 'home.php';
$_SESSION['loginLastPage'] = 'home.php';
$cookieName = "User";
$cookieValue = "Bo Bo Thaw";
if (isset($_POST['btnCookieAccept']))
{
  setcookie($cookieName, $cookieValue, time() + (86400 * 30), "/");
}
// setcookie($cookieName, $cookieValue, time() - (86400 * 30), "/"); //to remove
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Global Wild Swimming and Camping: Book your desired campsite here - GWSC</title>
  <meta name="description" content="Welcome to Global Wild Swimming and Camping (GWSC), your gateway to 
          unforgettable outdoor adventures! Immerse yourself in the beauty of nature
          and discover our diverse collection of breathtaking wild swimming and 
          camping sites.">
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
  </header>
  <div class="slider_container">
    <div class="slider">
      <div class="slides">
        <input type="radio" name="radio-button" id="radio-1" />
        <input type="radio" name="radio-button" id="radio-2" />
        <input type="radio" name="radio-button" id="radio-3" />
        <input type="radio" name="radio-button" id="radio-4" />
        <input type="radio" name="radio-button" id="radio-5" />

        <div class="slide first">
          <div class="slide_text">Make it yours!</div>
          <img src="Images/lake_camping_hero__june_lake__3270x2015____v1800x7501.jpg" alt="SlideShowImage1" />
        </div>
        <div class="slide">
          <div class="slide_text">The adventure awaits!</div>
          <img src="Images/june_lake_loop__3892x2595____v1920x__1.jpg" alt="SlideShowImage1" />
        </div>
        <div class="slide">
          <div class="slide_text">Camp with us!</div>
          <img src="Images/lake_isabella_camping__1000x608____v1920x__1.jpg" alt="SlideShowImage1" />
        </div>
        <div class="slide">
          <div class="slide_text">Make memories!</div>
          <img src="Images/lake_nacimiento_wakeboarding_camping__5472x3648____v1920x__1.jpg" alt="SlideShowImage1" />
        </div>
        <div class="slide">
          <div class="slide_text">The extraordinary experience.</div>
          <img src="Images/home_bg.jpg" alt="SlideShowImage1" />
        </div>

          <div class="navigation-auto">
            <div class="auto-btn1"></div>
            <div class="auto-btn2"></div>
            <div class="auto-btn3"></div>
            <div class="auto-btn4"></div>
            <div class="auto-btn5"></div>
          </div>
      </div>
        <div class="navigation-manual">
          <label for="radio-1" class="manual-btn"></label>
          <label for="radio-2" class="manual-btn"></label>
          <label for="radio-3" class="manual-btn"></label>
          <label for="radio-4" class="manual-btn"></label>
          <label for="radio-5" class="manual-btn"></label>
        </div>
    </div>
  </div>
  
  <script type="text/javascript">
    var counter = 1;
    setInterval(function() {
      document.getElementById("radio-" + counter).checked = true;
      counter++;
      if (counter > 5) {
        counter = 1;
      }
    }, 5000);
  </script>
  <div class="searchbar">
        <form action="information.php" id="searchForm" method="POST">
        <input type="text" placeholder="Search....." name="txtSearchResult" />
        <button type="submit" name="search-btn">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
        </button>
        </form>
  </div>

  <div class="Intro text_centre centre column">
    <h1>Global Wild Swimming and Camping</h1>
        <p>
          "Welcome to Global Wild Swimming and Camping (GWSC), your gateway to 
          unforgettable outdoor adventures! Immerse yourself in the beauty of nature
          and discover our diverse collection of breathtaking wild swimming and 
          camping sites. Whether you seek the thrill of wild swimming or the 
          serenity of camping under the stars, our pristine locations offer 
          the perfect escape from the hustle and bustle of everyday life. Explore
            our interactive map to uncover the variety of pitch types available a
            nd find your ideal spot. With a seamless booking system, you can secure
            your swimming session or camping pitch effortlessly. Join us on an 
            extraordinary journey as we invite you to connect with nature and 
            create cherished memories that will last a lifetime."
        </p>
  </div>
  <hr>
  <div class="Intro text_centre centre">
    <h2>Most Viewed Campsites</h2>
  </div>
  <div class="viewed_campsite_container row wrap">
  <?php
      $mostViewedCampsitesQuery = "SELECT * FROM campsites ORDER BY NoOfViews DESC LIMIT 5";
      $runmostViewedCampsitesQuery = mysqli_query($connect, $mostViewedCampsitesQuery);

      if (mysqli_num_rows($runmostViewedCampsitesQuery) > 0) {
          while ($campsiteRow = mysqli_fetch_assoc($runmostViewedCampsitesQuery)) {
              ?>
              <div class="viewed_campsite_slot">
                  <div class="viewed_campsite">
                      <img src="<?php echo $campsiteRow["Image1"]; ?>" alt="Campsite Image">
                      <div class="viewed_campsite_overlay">
                          <h2><?php echo $campsiteRow["CampsiteName"]; ?></h2>
                          <span><i class="fa-regular fa-eye"></i><?php echo $campsiteRow["NoOfViews"]; ?></span>   
                      </div>
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
  <hr>
  <div class="Intro text_centre centre">
    <h2>Most Popular Countries</h2>
  </div>
  <div class="viewed_campsite_container row wrap">
  <?php
$countryQuery = "SELECT * FROM countries";
$runCountryQuery = mysqli_query($connect, $countryQuery);

if (mysqli_num_rows($runCountryQuery) > 0) {
    while ($countryRow = mysqli_fetch_assoc($runCountryQuery)) {
        ?>
        <div class="viewed_campsite_slot">
            <div class="viewed_campsite">
                <img src="<?php echo $countryRow["CountryImage"]; ?>" alt="Country Image">
                <div class="viewed_campsite_overlay">
                    <h2><?php echo $countryRow["CountryName"]; ?></h2>
                    <a href="information.php?CountryID=<?php echo $countryRow["CountryID"]; ?>">Explore Campsites &#8594;</a>
                </div>
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
  <hr>
  <div class="LocalAttractionsContainer row wrap" id="homePitch">
    <h2 class="Intro centre">Different pitchtypes of our campsites</h2>
        <?php 
        $pitchTypeQuery = "SELECT * FROM PitchTypes";
        $runPitchTypeQuery = mysqli_query($connect, $pitchTypeQuery);
        if (mysqli_num_rows($runPitchTypeQuery) > 0) {
            while ($pitchRow = mysqli_fetch_assoc($runPitchTypeQuery)) {
                ?>
                <div class="attraction_slot row">
                    <div class="attrImage centre">
                        <img src="<?php echo $pitchRow["PitchTypeImg"];?>" alt="Pitch Type Image" class="pitchIcon">
                    </div>
                    <div class="AttrText column">
                        <div class="AttrHeading"><h2><?php echo$pitchRow["PitchTypeName"]; ?></h2></div>
                        <a href="information.php?PitchTypeID=<?php echo$pitchRow['PitchTypeID']?>">Explore Campsites &#8594;</a>
                        <div class="AttrDesc"><p><?php echo$pitchRow["PitchTypeDesc"]; ?></p></div>
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
  <hr>

  <footer class="column centre">
    <p>You are here: <a href="home.php">Home</a></p>
    <p>Copyright &copy; 2023 GWSC. All rights reserved.</p>
    <div class="socialMediaIcons row wrap">
      <a href="https://facebook.com"><i class="fa-brands fa-facebook"></i></a>
      <a href="https://twitter.com"><i class="fa-brands fa-instagram"></i></a>
      <a href="https://www.instagram.com/"><i class="fa-brands fa-x-twitter"></i></a>
      <a href="rss.php"><i class="fa-solid fa-rss"></i></a>
    </div>
        
    <div class="footer-icon-box translatebox row wrap" id="google_element">Select Prefered Language:</div>
    
  </footer>
  <?php 
  if (!isset($_COOKIE[$cookieName]))
  {
    ?> 
    <div class="cookie" id="cookie">
      <form action="home.php" class="row wrap" method="POST">
        <p>
        This website uses cookies to ensure you get the best experience 
        on our website. By clicking "Accept," you consent to the use of 
        all the cookies.
        </p>
        <div class="cookiebuttons row wrap">
          <input type="submit" value="Accept" name="btnCookieAccept">
          <button id="CookieCancel" type="reset">Cancel</button>
        </div>
      </form>
    </div>
  <?php
  }
  ?>
  
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
        <input type="password" name = "txtCusPassword" placeholder="Please enter the password" class="modal-email" minlength="10" required>
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
    $(document).ready(function() {
      $("#CookieCancel").click(function() {
        $("#cookie").hide(); 
      });
    });
  </script>
  <script src="http://translate.google.com/translate_a/element.js?cb=loadGoogleTranslate"></script>
  <script>
      function loadGoogleTranslate(){
            new google.translate.TranslateElement({
          pageLanguage: 'en', 
          multilanguagePage: true
        }, 'google_element');
      }
  </script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>

</html>