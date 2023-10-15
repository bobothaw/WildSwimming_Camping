<?php 
include('connection.php');
session_start();
if (!isset($_SESSION['AdminID']))
{
	echo "<script>window.alert('Please login again.')</script>";
	echo "<script>window.location = 'AdminLogin.php'</script>";
}
if (isset($_POST['btnInsertCountry']))
{
    $countryName = $_POST['txtCountryName'];
    $txtCountryImage = $_FILES['fileCountryImage']['name'];
    $pathPrefix = "Images/";
    $countryImgFileName = $pathPrefix."_".$txtCountryImage;
    $copy = copy($_FILES['fileCountryImage']['tmp_name'], $countryImgFileName);

    if (!$copy)
    {
        echo "<script>window.alert('Cannot upload image')</script>";
        exit();
    }

    $checkCountryQuery = "Select * from countries Where CountryName = '$countryName'";
	$runCheckCountryQuery = mysqli_query($connect, $checkCountryQuery);
	$countCountryName = mysqli_num_rows($runCheckCountryQuery);

	if ($countCountryName > 0)
	{
		echo "<script>window.alert('Country already exists. Please enter a new one.')</script>";
		echo "<script>window.location ='AdminDashboard.php'</script>";
	}
	else 
	{
		echo $insert = "INSERT into countries (CountryName, CountryImage) Values
		('$countryName', '$countryImgFileName')";

		$inserted = mysqli_query($connect, $insert);
		if ($inserted)
		{
			echo "<script>window.alert('Country added successfully.')</script>";
			echo "<script>window.location ='AdminDashboard.php'</script>";
		}
	}
}
if (isset($_POST['btnInsertAttraction']))
{
    $attractionName = $_POST['txtAttractionName'];
    $countryID = $_POST['cboCountryID'];
    $txtAttractionImage = $_FILES['fileAttractionImage']['name'];
    $pathPrefix = "Images/";
    $attractionImgFileName = $pathPrefix."_".$txtAttractionImage;
    $copy = copy($_FILES['fileAttractionImage']['tmp_name'], $attractionImgFileName);

    if (!$copy)
    {
        echo "<script>window.alert('Cannot upload image')</script>";
        exit();
    }
    $attractionDesc = $_POST['txtAttractionDesc'];
    $attractionDesc2 = "$attractionDesc";

    $checkAttractionQuery = "SELECT * from local_attractions Where AttractionName = '$attractionName'";
	$runCheckAttractionQuery = mysqli_query($connect, $checkAttractionQuery);
	$countAttractions = mysqli_num_rows($runCheckAttractionQuery);

	if ($countAttractions > 0)
	{
		echo "<script>window.alert('Attraction already exists. Please enter a new one.')</script>";
		echo "<script>window.location ='AdminDashboard.php'</script>";
	}
	else 
	{
		$insert = "INSERT into local_attractions (AttractionName, AttractionImage, CountryID, AttractionDesc) Values
		('$attractionName', '$attractionImgFileName', '$countryID', '$attractionDesc2')";

		$inserted = mysqli_query($connect, $insert);
		if ($inserted)
		{
			echo "<script>window.alert('Attraction added successfully.')</script>";
			echo "<script>window.location ='AdminDashboard.php'</script>";
		}
	}
}
if (isset($_POST['btnInsertFeature']))
{
    $featureName = $_POST['txtFeatureName'];
    $featureDesc = $_POST['txtFeatureDesc'];
    $featureIcon = $_POST['txtFeatureIcon'];

    $CheckFeatureQuery = "SELECT * from features Where FeatureName = '$featureName'";
	$runCheckFeatureQuery = mysqli_query($connect, $CheckFeatureQuery);
	$countFeature = mysqli_num_rows($runCheckFeatureQuery);

	if ($countFeature > 0)
	{
		echo "<script>window.alert('Feature already exists. Please enter a new one.')</script>";
		echo "<script>window.location ='AdminDashboard.php'</script>";
	}
	else 
	{
		echo $insert = "INSERT into features (FeatureName, FeatureDesc, FeatureIcon) Values
		('$featureName', '$featureDesc', '$featureIcon')";

		$inserted = mysqli_query($connect, $insert);
		if ($inserted)
		{
			echo "<script>window.alert('Feature added successfully.')</script>";
			echo "<script>window.location ='AdminDashboard.php'</script>";
		}
	}
}
if (isset($_POST['btnInsertPitchType']))
{
    $pitchTypeName = $_POST['txtPitchTypeName'];
    $pitchTypeDesc = $_POST['txtPitchTypeDesc'];

    $txtPitchTypeImage = $_FILES['filePitchTypeImage']['name'];
    $pathPrefix = "Images/";
    $pitchtypeImgFileName = $pathPrefix."_".$txtPitchTypeImage;
    $copy = copy($_FILES['filePitchTypeImage']['tmp_name'], $pitchtypeImgFileName);

    if (!$copy)
    {
        echo "<script>window.alert('Cannot upload image')</script>";
        exit();
    }

    $checkPitchTypeQuery = "SELECT * from pitchtypes Where PitchTypeName = '$pitchTypeName'";
	$runCheckPitchTypeQuery = mysqli_query($connect, $checkPitchTypeQuery);
	$countPitchType = mysqli_num_rows($runCheckPitchTypeQuery);

	if ($countPitchType > 0)
	{
		echo "<script>window.alert('PitchType already exists. Please enter a new one.')</script>";
		echo "<script>window.location ='AdminDashboard.php'</script>";
	}
	else 
	{
		$insert = "INSERT into pitchtypes (PitchTypeName, PitchTypeDesc, PitchTypeImg) Values
		('$pitchTypeName', '$pitchTypeDesc', '$pitchtypeImgFileName')";

		$inserted = mysqli_query($connect, $insert);
		if ($inserted)
		{
			echo "<script>window.alert('PitchType added successfully.')</script>";
			echo "<script>window.location ='AdminDashboard.php'</script>";
		}
	}
}
if (isset($_POST['btnInsertCampsite']))
{
    $campsiteName = $_POST['txtCampsiteName'];

    $txtCampsiteImage1 = $_FILES['filecampsiteImage1']['name'];
    $pathPrefix = "Images/";
    $campsiteImgFileName1 = $pathPrefix."_".$txtCampsiteImage1;
    $copy = copy($_FILES['filecampsiteImage1']['tmp_name'], $campsiteImgFileName1);

    if (!$copy)
    {
        echo "<script>window.alert('Cannot upload image')</script>";
        exit();
    }

    $txtCampsiteImage2 = $_FILES['filecampsiteImage2']['name'];
    $pathPrefix = "Images/";
    $campsiteImgFileName2 = $pathPrefix."_".$txtCampsiteImage2;
    $copy = copy($_FILES['filecampsiteImage2']['tmp_name'], $campsiteImgFileName2);

    if (!$copy)
    {
        echo "<script>window.alert('Cannot upload image')</script>";
        exit();
    }

    $txtCampsiteImage3 = $_FILES['filecampsiteImage3']['name'];
    $pathPrefix = "Images/";
    $campsiteImgFileName3 = $pathPrefix."_".$txtCampsiteImage3;
    $copy = copy($_FILES['filecampsiteImage3']['tmp_name'], $campsiteImgFileName3);

    if (!$copy)
    {
        echo "<script>window.alert('Cannot upload image')</script>";
        exit();
    }
    $countryID = $_POST['cboCountryID'];
    $wildSwimming = isset($_POST['WildSwimming']) ? ($_POST['WildSwimming'] === 'true' ? 1 : 0) : 0;
    $mapLocation = $_POST['txtMapLocation'];
    $campsiteCity = $_POST['txtCampsiteCity'];
    $campsiteDesc = $_POST['txtCampsiteDesc'];

    $checkCampsiteQuery = "Select * from campsites Where CampsiteName = '$campsiteName'";
	$runcheckCampsiteQuery = mysqli_query($connect, $checkCampsiteQuery);
	$countCampsite = mysqli_num_rows($runcheckCampsiteQuery);

	if ($countCampsite > 0)
	{
		echo "<script>window.alert('Campsite already exists. Please enter a new one.')</script>";
		echo "<script>window.location ='AdminDashboard.php'</script>";
	}
	else 
	{
		$insert = "INSERT into campsites (CampsiteName, Image1, Image2, Image3, CountryID, NoOfViews, MapLocation, WildSwimming, Description, City) 
        Values('$campsiteName', '$campsiteImgFileName1', '$campsiteImgFileName2', '$campsiteImgFileName3', $countryID, 0, '$mapLocation', $wildSwimming, '$campsiteDesc', '$campsiteCity')";

		$inserted = mysqli_query($connect, $insert);
		if ($inserted)
		{
			echo "<script>window.alert('Campsite added successfully.')</script>";
			echo "<script>window.location ='AdminDashboard.php'</script>";
		}
	}
}
if (isset($_POST['btnInsertCampsitePitchType']))
{
    try
    {
        $campsiteID = $_POST['cboCampsites'];
        $pitchTypeID = $_POST['cboPitchTypes'];
        $pricePerSlot = $_POST['numPricePerSlot'];


        $insertQuery = "INSERT INTO Campsite_PitchType (CampsiteID, PitchTypeID, PricePerSlot) 
        VALUES ('$campsiteID', '$pitchTypeID', $pricePerSlot)";
        $runInsertQuery = mysqli_query($connect, $insertQuery);

        if (!$runInsertQuery) 
        {
            $error = mysqli_error($connect);
            $errorCode = mysqli_errno($connect);
            if ($errorCode === 1062) 
            {
                throw new Exception("The Campsite already has the selected PitchType");
            } 
            else 
            {
                throw new Exception("Error inserting data into Campsite_PitchType: $error");
            }
        } 
        else 
        {
            echo "<script>window.alert('Pitchtype inserted successfully inside the Campsite');</script>";
        }
    }
    catch(Exception $e)
    {
        echo "<script>window.alert('Error in inserting pitch type to Campsite. The pitch type might already exist in the campsite.');</script>";
        echo "<script>window.location ='AdminDashboard.php'</script>";
    }   
}
if (isset($_POST['btnInsertCampsiteFeature']))
{
    try
    {
        $campsiteID = $_POST['cboCampsites'];
        $featureID = $_POST['cboFeatures'];

        $insertQuery = "INSERT INTO Campsite_feature (CampsiteID, FeatureID) VALUES ('$campsiteID', '$featureID')";
        $runInsertQuery = mysqli_query($connect, $insertQuery);

        if (!$runInsertQuery) 
        {
            
        } 
        else 
        {
            echo "<script>window.alert('Feature inserted successfully into Campsite.');</script>";
        }
    }
    catch(Exception)
    {
        echo "<script>window.alert('Error in inserting feature to Campsite. The feature might already exist in the campsite.');</script>";
        echo "<script>window.location ='AdminDashboard.php'</script>";
    }   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GWSC - AdminDashboard</title>
    <script src="https://kit.fontawesome.com/84ff42f2da.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Old+Standard+TT&family=Source+Sans+3&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
</head>
<body id="AdminDashboardBody">
    <nav class="AdminDashboardNav">
        <ul>
            <li><a href="#Country">Manage Countries</a></li>
            <li><a href="#Attraction">Manage Attractions</a></li>
            <li><a href="#Feature">Manage Features</a></li>
            <li><a href="#PitchType">Manage Pitch Types</a></li>
            <li><a href="#Campsite">Manage Campsites</a></li>
            <li><a href="#CampsitePitchType">Manage Campsite Pitch Types</a></li>
            <li><a href="#CampsiteFeature">Manage Campsite Feature</a></li>
        </ul>
    </nav>

    <div class="AdminInputFormContainer">
        <div class="AdminSignUpLoginForm" >
            <form action="AdminDashboard.php" method="POST" enctype="multipart/form-data" id="Country">
                <label for="txtCountryName">Country Name:</label>
                <input type="text" name="txtCountryName" required><br>
        
                <label for="CountryImage">Country Image:</label>
                <input type="file" name="fileCountryImage" required><br>
        
                <button type="submit" name="btnInsertCountry">Insert Country</button>
            </form>
        </div>
        <div class="AdminSignUpLoginForm" id="Attraction">
            <form action="AdminDashboard.php" method="POST" enctype="multipart/form-data">
                <label for="txtAttractionName">Attraction Name:</label>
                <input type="text" name="txtAttractionName" required><br>
        
                <label for="AttractionImage">Attraction Image:</label>
                <input type="file" name="fileAttractionImage" required><br>
        
                <label for="cboCountryID">Country:</label>
                <select name="cboCountryID" required>
                    <option value="" disabled selected>Select the country</option>
                    <?php
                        $countrySelectQuery = "SELECT * from countries";
                        $runQuery = mysqli_query($connect, $countrySelectQuery);
                        $countriesRowCount = mysqli_num_rows($runQuery);
                        for ($i = 0; $i < $countriesRowCount; $i++)
                        {
                            $countryArray = mysqli_fetch_array($runQuery);
                            $CountryID = $countryArray['CountryID'];
                            $CountryName = $countryArray['CountryName'];
                            echo "<option value = '$CountryID'>$CountryName</option>";
                        }
                    ?>
                </select><br>
                <label for="txtAttractionDesc">Attraction Description:</label>
                <textarea name="txtAttractionDesc" id="" rows="6" ></textarea><br>
        
                <button type="submit" name="btnInsertAttraction">Insert Attraction</button>
            </form>
        </div>
        <div class="AdminSignUpLoginForm" id="Feature">
            <form action="AdminDashboard.php" method="POST">
                <label for="txtFeatureName">Feature Name:</label>
                <input type="text" name="txtFeatureName" required><br>
                <label for="txtFeatureDesc">Feature Description:</label>
                <textarea name="txtFeatureDesc" id="" rows="6" ></textarea><br>
                <label for="txtFeatureIcon">Feature Icon:</label>
                <input type="text" name="txtFeatureIcon" required><br>
        
                <button type="submit" name="btnInsertFeature">Insert Feature</button>
            </form>
        </div>
        <div class="AdminSignUpLoginForm" id="PitchType">
            <form action="AdminDashboard.php" method="POST" enctype="multipart/form-data">
                <label for="txtPitchTypeName">Pitch Type Name:</label>
                <input type="text" name="txtPitchTypeName" required><br>
                <label for="txtPitchTypeDesc">Pitch Type Description:</label>
                <textarea name="txtPitchTypeDesc" id="" rows="6" ></textarea><br>
                <label for="filePitchTypeImage">Pitch Type Image:</label>
                <input type="file" name="filePitchTypeImage" required><br>
        
                <button type="submit" name="btnInsertPitchType">Insert Pitch Type</button>
            </form>
        </div>
        <div class="AdminSignUpLoginForm" id="Campsite">
            <form action="AdminDashboard.php" method="POST" enctype="multipart/form-data">
                <label for="txtCampsiteName">Campsite Name:</label>
                <input type="text" name="txtCampsiteName" required><br>
        
                <label for="filecampsiteImage1">Campsite Image 1:</label>
                <input type="file" name="filecampsiteImage1" required><br>
                <label for="filecampsiteImage2">Campsite Image 2:</label>
                <input type="file" name="filecampsiteImage2" required><br>
                <label for="filecampsiteImage3">Campsite Image 3:</label>
                <input type="file" name="filecampsiteImage3" required><br>
        
                <label for="cboCountryID">Country:</label>
                <select name="cboCountryID" required>
                    <option value="" disabled selected>Select the country</option> 
                    <?php
                        $countrySelectQuery = "SELECT * from countries";
                        $runQuery = mysqli_query($connect, $countrySelectQuery);
                        $countriesRowCount = mysqli_num_rows($runQuery);
                        for ($i = 0; $i < $countriesRowCount; $i++)
                        {
                            $countryArray = mysqli_fetch_array($runQuery);
                            $CountryID = $countryArray['CountryID'];
                            $CountryName = $countryArray['CountryName'];
                            echo "<option value = '$CountryID'>$CountryName</option>";
                        }
                    ?>
                </select><br>
        
                <label for="WildSwimming">Wild Swimming: Yes or No</label>
                <input type="radio" name="WildSwimming" value="true" required> <span>Yes</span>
                <input type="radio" name="WildSwimming" value="false" required> <span>No</span>
        
                <label for="txtMapLocation">Map Location: (Google Maps Link SRC)</label>
                <textarea name="txtMapLocation" id="" rows="6" ></textarea><br>
                <label for="">Campsite City:</label>
                <input type="text" name="txtCampsiteCity"> <br>
                <label for="txtCampsiteDesc">Campsite Description:</label>
                <textarea name="txtCampsiteDesc" id="" rows="6" ></textarea><br>
        
                <button type="submit" name="btnInsertCampsite">Insert Campsite</button>
                <a href="CampsiteDashboard.php">Edit Campsite?</a>
            </form>
        </div>
        
        <div class="AdminSignUpLoginForm" id="CampsitePitchType">
            <form action="AdminDashboard.php" method="POST">
                <label for="cboCampsites">Campsite Name:</label>
                <select name="cboCampsites" required>
                    <option value="" disabled selected>Select the campsite</option>
                    <?php
                        $campsiteSelectQuery = "SELECT * from campsites";
                        $runQuery = mysqli_query($connect, $campsiteSelectQuery);
                        $campsiteRowCount = mysqli_num_rows($runQuery);
                        for ($i = 0; $i < $campsiteRowCount; $i++)
                        {
                            $campsiteArray = mysqli_fetch_array($runQuery);
                            $CampsiteID = $campsiteArray['CampsiteID'];
                            $CampsiteName = $campsiteArray['CampsiteName'];
                            echo "<option value = '$CampsiteID'>$CampsiteName</option>";
                        }
                    ?>
                </select><br>
                <label for="cboPitchTypes">Pitch Type Name:</label>
                <select name="cboPitchTypes" required>
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
                </select><br>
                <label for="numPricePerSlot">Price per camping slot:</label>
                <input type="number" required name="numPricePerSlot" min="1" value="1" step=".01"><br>
        
                <button type="submit" name="btnInsertCampsitePitchType">Insert Campsite Pitch Type</button>
            </form>
        </div>
        <div class="AdminSignUpLoginForm" id="CampsiteFeature">
            <form action="AdminDashboard.php" method="POST">
                <label for="cboCampsites">Campsite Name:</label>
                <select name="cboCampsites" required>
                    <option value="" disabled selected>Select the campsite</option>
                    <?php
                        $campsiteSelectQuery = "SELECT * from campsites";
                        $runQuery = mysqli_query($connect, $campsiteSelectQuery);
                        $campsiteRowCount = mysqli_num_rows($runQuery);
                        for ($i = 0; $i < $campsiteRowCount; $i++)
                        {
                            $campsiteArray = mysqli_fetch_array($runQuery);
                            $CampsiteID = $campsiteArray['CampsiteID'];
                            $CampsiteName = $campsiteArray['CampsiteName'];
                            echo "<option value = '$CampsiteID'>$CampsiteName</option>";
                        }
                    ?>
                </select><br>
                <label for="cboFeatures">Feature Name:</label>
                <select name="cboFeatures" required>
                    <option value="" disabled selected>Select the feature</option>
                    <?php
                        $featureSelectQuery = "SELECT * from features";
                        $runQuery = mysqli_query($connect, $featureSelectQuery);
                        $featureRowCount = mysqli_num_rows($runQuery);
                        for ($i = 0; $i < $featureRowCount; $i++)
                        {
                            $featureArray = mysqli_fetch_array($runQuery);
                            $FeatureID = $featureArray['FeatureID'];
                            $FeatureName = $featureArray['FeatureName'];
                            echo "<option value = '$FeatureID'>$FeatureName</option>";
                        }
                    ?>
                </select><br>
                
                <button type="submit" name="btnInsertCampsiteFeature">Insert Campsite Feature</button>
            </form>
        </div>
        <div class="EditFrom">
            <div class="Something"></div>
        </div>
    </div>
    
</body>
</html>