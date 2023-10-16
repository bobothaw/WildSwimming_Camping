<?php
include('connection.php');
session_start();
if (!isset($_SESSION['AdminID']))
{
	echo "<script>window.alert('Please login again.')</script>";
	echo "<script>window.location = 'AdminLogin.php'</script>";
}
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["CampsiteID"])) {
    $campsiteID = $_GET["CampsiteID"];
    $campsiteQuery = "SELECT c.*, co.CountryName FROM 
    Campsites c, Countries co
    Where co.CountryID = c.CountryID
    AND c.CampsiteID = $campsiteID";
    $runCampsiteQuery = mysqli_query($connect, $campsiteQuery);
    if ($runCampsiteQuery->num_rows > 0) {
        while ($row = $runCampsiteQuery->fetch_assoc()) {
            $campsiteName = $row["CampsiteName"];
            $countryID = $row["CountryID"];
            $countryName = $row["CountryName"];
            $wildSwimming = $row["WildSwimming"];
            $description = $row["Description"];
            $mapLocation = $row["MapLocation"];
            $campsiteCity = $row["City"];
        }
    }
}
if (isset($_POST['btnEditCampsite']))
{
    $campsiteID = $_POST['txtCampsiteID'];
    $campsiteName = $_POST['txtCampsiteName'];
    $countryID = $_POST['cboCountryID'];
    $wildSwimming = isset($_POST['WildSwimming']) ? ($_POST['WildSwimming'] === 'true' ? 1 : 0) : 0;
    $mapLocation = $_POST['txtMapLocation'];
    $campsiteCity = $_POST['txtCampsiteCity'];
    $campsiteDesc = $_POST['txtCampsiteDesc'];

    $checkCampsiteQuery = "SELECT * from campsites Where CampsiteName = '$campsiteName'";
	$runcheckCampsiteQuery = mysqli_query($connect, $checkCampsiteQuery);
	$countCampsite = mysqli_num_rows($runcheckCampsiteQuery);
    if ($countCampsite > 0)
	{
		echo "<script>window.alert('Campsite already exists. Please enter a new one.')</script>";
	}
	else 
	{
        $update = "UPDATE campsites 
        SET CampsiteName = '$campsiteName',
        WildSwimming = '$wildSwimming', 
        CountryID = $countryID, 
        MapLocation = '$mapLocation',
        City = '$campsiteCity', 
        Description = '$campsiteDesc'
        WHERE CampsiteID = $campsiteID";
		
		$updated = mysqli_query($connect, $update);
		if ($updated)
		{
			echo "<script>window.alert('Campsite updated successfully.')</script>";
			echo "<script>window.location ='CampsiteDashboard.php'</script>";
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GWSC - CampsiteEdit</title>
    <script src="https://kit.fontawesome.com/84ff42f2da.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Old+Standard+TT&family=Source+Sans+3&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<div class="AdminSignUpLoginForm" id="Campsite">
    <form action="campsiteEdit.php" method="POST" enctype="multipart/form-data">
        <input type="hidden", name="txtCampsiteID" value="<?= $campsiteID?>">
        <label for="txtCampsiteName">Campsite Name:</label>
        <input type="text" name="txtCampsiteName" value="<?= $campsiteName?>" required><br>

        <label for="cboCountryID">Country:</label>
        <select name="cboCountryID" required>
            <option value="<?= $countryID?>" selected><?= $countryName?></option> 
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
        </select>

        <label for="WildSwimming">Wild Swimming: Yes or No</label>
        <input type="radio" name="WildSwimming" value="true" required <?php echo ($wildSwimming == 1) ? 'checked' : ''; ?>> <span>Yes</span>
        <input type="radio" name="WildSwimming" value="false" required <?php echo ($wildSwimming == 0) ? 'checked' : ''; ?>> <span>No</span>

        <label for="txtMapLocation">Map Location: (Google Maps Link SRC)</label>
        <textarea name="txtMapLocation" id="" rows="6"><?= $mapLocation?></textarea><br>
        <label for="">Campsite City:</label>
        <input type="text" name="txtCampsiteCity" value="<?= $campsiteCity?>"> <br>
        <label for="txtCampsiteDesc">Campsite Description:</label>
        <textarea name="txtCampsiteDesc" id="" rows="6"><?= $description?></textarea><br>

        <button type="submit" name="btnEditCampsite">Edit Campsite</button>
        <a href="CampsiteDashboard.php">Don't want to edit? Go back--></a>
    </form>
</div>
</body>
</html>