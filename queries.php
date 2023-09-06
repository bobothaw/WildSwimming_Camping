<?php 
include('connection.php');
// $adminTB = "CREATE table Admins 
// (
// 	AdminID int not null primary key AUTO_INCREMENT,
// 	AdminName varchar(30),
// 	Email varchar (30),
// 	Password varchar (30),
// 	PhoneNumber varchar (30),
// 	Address varchar (100)
// )";

// $query = mysqli_query ($connect, $adminTB);

// if ($query)
// {
// 	echo "Admins Table is created successfully";
// }
// else
// {
// 	echo "Error in creating admins table";
// }

// $customerTB = "CREATE table Customers
// (
// 	CustomerID int not null primary key AUTO_INCREMENT,
// 	FirstName varchar(30),
// 	LastName varchar (30),
//     Email varchar(30),
// 	Password varchar (30),
// 	PhoneNumber varchar (30),
// 	Address varchar (100)
// )";

// $query = mysqli_query ($connect, $customerTB);

// if ($query)
// {
// 	echo "Customers Table is created successfully";
// }
// else
// {
// 	echo "Error in creating Customers table";
// }
// $countryTB = "CREATE table countries 
// (
//     CountryID int Primary Key AUTO_INCREMENT,
//     CountryName varchar (30),
//     CountryImage varchar(1000)
// )";

// $runQuery1 = mysqli_query ($connect, $countryTB);
// if ($runQuery1)
// {
//     echo "Country Table created successfully.";
// }
// else
// {
//     echo "Error in  creating Country Table.";
// }

// $featureTB = "CREATE table features 
// (
//     FeatureID int Primary Key AUTO_INCREMENT,
//     FeatureName varchar (50),
//     FeatureDesc varchar (1000),
//     FeatureIcon varchar (200),
// )";

// $runQuery2 = mysqli_query ($connect, $featureTB);
// if ($runQuery2)
// {
//     echo "Feature Table created successfully.";
// }
// else
// {
//     echo "Error in  creating Feature Table.";
// }

// $attractionTB = "CREATE table Local_Attractions 
// (
//     AttractionID int Primary Key AUTO_INCREMENT,
//     AttractionName varchar (50),
//     AttractionImage varchar (1000),
//     CountryID int,
//     AttractionDesc varchar (1000),
//     Foreign Key (CountryID) REFERENCES countries (CountryID)
// )";

// $runQuery3 = mysqli_query ($connect, $attractionTB);
// if ($runQuery3)
// {
//     echo "Attraction Table created successfully.";
// }
// else
// {
//     echo "Error in  creating Attraction Table.";
// }

// $pitchTypeTB = "CREATE table PitchTypes 
// (
//     PitchTypeID int Primary Key AUTO_INCREMENT,
//     PitchTypeName varchar (30),
//     PitchTypeDesc varchar (1000),
//     PitchTypeImg varchar (1000)
// )";

// $runQuery4 = mysqli_query ($connect, $pitchTypeTB);
// if ($runQuery4)
// {
//     echo "Pitch Type Table created successfully.";
// }
// else
// {
//     echo "Error in  creating Pitch Type Table.";
// }

// $campsiteTB = "CREATE table Campsites 
// (
//     CampsiteID int Primary Key AUTO_INCREMENT,
//     CampsiteName varchar (50),
//     Image1 varchar (1000),
//     Image2 varchar (1000),
//     Image3 varchar (1000),
//     CountryID int,
// 	NoOfViews int,
//     MapLocation varchar (1000),
// 	WildSwimming BOOL,
//     Description varchar (1000),
//     Foreign Key (CountryID) REFERENCES countries (CountryID) 
// )";

// $runQuery5 = mysqli_query ($connect, $campsiteTB);
// if ($runQuery5)
// {
//     echo "Campsite Table created successfully.";
// }
// else
// {
//     echo "Error in  creating Campsite Table.";
// }

// $campsite_featureTB = "CREATE table Campsite_Feature
// (
//     CampsiteID int,
//     FeatureID int, 
//     Foreign Key (CampsiteID) REFERENCES Campsites (CampsiteID),
//     Foreign Key (FeatureID) REFERENCES Features (FeatureID),
//     Primary Key (CampsiteID, FeatureID)
// )";

// $runQuery6 = mysqli_query ($connect, $campsite_featureTB);
// if ($runQuery6)
// {
//     echo "CampsiteFeature Table created successfully.";
// }
// else
// {
//     echo "Error in  creating CampsiteFeature Table.";
// }

// $campsite_pitchTypeTB = "CREATE table Campsite_PitchType
// (
//     CampsiteID int,
//     PitchTypeID int,
// 	PricePerSlot decimal (10, 2),
//     Foreign Key (CampsiteID) REFERENCES Campsites (CampsiteID),
//     Foreign Key (PitchTypeID) REFERENCES PitchTypes (PitchTypeID),
//     Primary Key (CampsiteID, PitchTypeID)
// )";

// $runQuery7 = mysqli_query ($connect, $campsite_pitchTypeTB);
// if ($runQuery7)
// {
//     echo "CampsitePitchType Table created successfully.";
// }
// else
// {
//     echo "Error in  creating CampsitePitchType Table.";
// }

$reviewsTB = "CREATE table Reviews
(
    CampsiteID int,
    CustomerID int,
	ReviewTitle Varchar(50),
    ReviewDesc Varchar (1000),
    StarCount int check (StarCount > 0 AND StarCount <= 5),
    Foreign Key (CampsiteID) REFERENCES Campsites (CampsiteID),
    Foreign Key (CustomerID) REFERENCES Customers (CustomerID),
    Primary Key (CampsiteID, CustomerID)
)";

$runQuery8 = mysqli_query ($connect, $reviewsTB);
if ($runQuery8)
{
    echo "Reviews Table created successfully.";
}
else
{
    echo "Error in  creating Reviews Table.";
}
?>