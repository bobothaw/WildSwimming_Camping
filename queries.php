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

// $reviewsTB = "CREATE table Reviews
// (
//     ReviewID int AUTO_INCREMENT,
//     CampsiteID int,
//     CustomerID int,
// 	ReviewTitle Varchar(50),
//     ReviewDesc Varchar (1000),
//     StarCount int check (StarCount > 0 AND StarCount <= 5),
//     ReviewDate DateTime,
//     Foreign Key (CampsiteID) REFERENCES Campsites (CampsiteID),
//     Foreign Key (CustomerID) REFERENCES Customers (CustomerID),
//     Primary Key (ReviewID)
// )";

// $runQuery8 = mysqli_query ($connect, $reviewsTB);
// if ($runQuery8)
// {
//     echo "Reviews Table created successfully.";
// }
// else
// {
//     echo "Error in  creating Reviews Table.";
// }
// $availabilityTB = "CREATE table Available_Campsites
// (
//     AvailibilityID int AUTO_INCREMENT,
//     CampsiteID int,
//     PitchTypeID int,
//     Avail_Spaces int,
//     Avail_Date Date,
//     Foreign Key (CampsiteID) REFERENCES Campsites (CampsiteID),
//     Foreign Key (PitchTypeID) REFERENCES PitchTypes (PitchTypeID),
//     Primary Key (AvailibilityID)
// )";
// $runQuery9 = mysqli_query ($connect, $availabilityTB);
// if ($runQuery9)
// {
//     echo "AvailableCampsites Table created successfully.";
// }
// else
// {
//     echo "Error in  creating AvailableCampsites Table.";
// }
// $bookingsTB = "CREATE table Bookings
// (
//     BookingID int AUTO_INCREMENT,
//     BookingDateTime DATETIME,
//     NumOfGuests int,
//     CheckInDate Date,
//     CheckOutDate Date,
//     TotalPrice Decimal (5,2),
//     CampsiteID int,
//     PitchTypeID int,
//     CustomerID int,
//     Foreign Key (CampsiteID) REFERENCES Campsites (CampsiteID),
//     Foreign Key (PitchTypeID) REFERENCES PitchTypes (PitchTypeID),
//     Foreign Key (CustomerID) REFERENCES Customers (CustomerID),
//     Primary Key (BookingID)
// )";
// $runQuery10 = mysqli_query ($connect, $bookingsTB);
// if ($runQuery10)
// {
//     echo "Bookings Table created successfully.";
// }
// else
// {
//     echo "Error in  creating Bookings Table.";
// }
// $contactTB = "CREATE table Contacts
// (
//     ContactID int AUTO_INCREMENT,
//     ContactName Varchar (100),
//     Email Varchar (200),
//     ContactSubject Varchar (100),
//     ContactMessage Varchar (1000),
//     ContactDateTime DateTime,
//     Primary Key (ContactID)
// )";
// $runQuery11 = mysqli_query ($connect, $contactTB);
// if ($runQuery11)
// {
//     echo "Contacts Table created successfully.";
// }
// else
// {
//     echo "Error in creating Contacts Table.";
// }
// $loginAttemptsTB = "CREATE table LoginAttempts
// (
//     LoginAttemptsID int AUTO_INCREMENT not null,
//     Email Varchar (200),
//     LastFailedAttemptTime Timestamp,
//     Primary Key (LoginAttemptsID)
// )";
// $runQuery12 = mysqli_query ($connect, $loginAttemptsTB);
// if ($runQuery12)
// {
//     echo "LoginAttempts Table created successfully.";
// }
// else
// {
//     echo "Error in creating LoginAttempts Table.";
// }
// $alterQuery = "Alter table Campsites
// Add City Varchar (100)";
// $runalterQuery = mysqli_query($connect, $alterQuery);
// if ($runalterQuery)
// {
//     echo "Table Altered successfully";
// }
// else
// {
//     echo "Something went wrong";
// }
// $updateQuery = "UPDATE campsites
// SET City = 'Isle of Skye'
// WHERE CampsiteName = 'Glenbrittle Campsite';

// UPDATE campsites
// SET City = 'Cornwall'
// WHERE CampsiteName = 'Bude Camping and Caravanning';

// UPDATE campsites
// SET City = 'Devon'
// WHERE CampsiteName = 'Karrageen Caravan & Camping Park';

// UPDATE campsites
// SET City = 'Northern Territory'
// WHERE CampsiteName = 'Ellery Creek Big Hole Campground';

// UPDATE campsites
// SET City = 'Victoria'
// WHERE CampsiteName = 'Tidal River Campground';

// UPDATE campsites
// SET City = 'Victoria'
// WHERE CampsiteName = 'Waratah Bay Caravan Park';

// UPDATE campsites
// SET City = 'Ontario'
// WHERE CampsiteName = 'Bruce Peninsula National Park';

// UPDATE campsites
// SET City = 'British Columbia'
// WHERE CampsiteName = 'Rathtrevor Beach Provincial Park';

// UPDATE campsites
// SET City = 'Alberta'
// WHERE CampsiteName = 'Lake Louise Soft-Sided Trailer Park';

// UPDATE campsites
// SET City = 'Devon'
// WHERE CampsiteName = 'Dartmoor Camping';

// UPDATE campsites
// SET City = 'Scotland'
// WHERE CampsiteName = 'Glen Nevis Caravan & Camping Park';

// UPDATE campsites
// SET City = 'Victoria'
// WHERE CampsiteName = 'Apollo Bay Holiday Park';

// UPDATE campsites
// SET City = 'Northern Territory'
// WHERE CampsiteName = 'Kakadu National Park';

// UPDATE campsites
// SET City = 'Alberta'
// WHERE CampsiteName = 'Cypress Hills Camp';

// UPDATE campsites
// SET City = 'Yukon'
// WHERE CampsiteName = 'Kluane National Park and Reserve';";
// $runUpdateQuery = mysqli_multi_query($connect, $updateQuery);
// if ($runUpdateQuery)
// {
//     echo "data updated successfully";
// }
// else
// {
//     echo "Something went wrong";
// }
$alterQuery = "ALTER TABLE Bookings
ADD COLUMN PaymentType VARCHAR(30),
ADD COLUMN PaymentCredential VARCHAR (200)";
$runAlterQuery = mysqli_query($connect, $alterQuery);

?>