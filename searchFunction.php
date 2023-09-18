<?php
include('connection.php');
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
    $pitchTypeID = $_POST["cboPitchType"];
    $numPeople = $_POST["numOfPeople"];
    $_SESSION['searchStartDate'] = $startDate;
    $_SESSION['searchEndDate'] = $endDate;
    $_SESSION['searchPitchType'] = $pitchTypeID;
    $_SESSION['searchNumPeople'] = $numPeople;
    $campsiteQuery = "SELECT c.*
    FROM campsites c
    INNER JOIN available_campsites a ON a.CampsiteID = c.CampsiteID
    WHERE a.Avail_Date BETWEEN '$startDate' AND '$endDate'
        AND a.PitchTypeID = $pitchTypeID
    GROUP BY c.CampsiteID, c.CampsiteName, c.Image1, c.Image2, c.Image3, c.CountryID, c.NoOfViews, c.MapLocation, c.WildSwimming, c.Description
    HAVING SUM(CASE WHEN a.Avail_Spaces >= $numPeople THEN 1 ELSE 0 END) = DATEDIFF('$endDate', '$startDate') + 1;";
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
                    <div class="centre">
                        <span>Nearby : </span>
                        <?php
                        $localAttrQuery = "SELECT la.AttractionName
                        FROM local_attractions la, campsites ca
                        Where ca.CampsiteID = $campsiteID
                        AND la.CountryID = ca.CountryID
                        LIMIT 2";
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
    <?php
}
if (isset($_POST['btnSearch']))
{
    var_dump($_SESSION);
    $checkindate = $_POST['startDate'];
    $checkoutdate = $_POST['endDate'];
    $selectedPitch =  $_POST['cboPitchType'];
    $totalguest =  $_POST['numOfPeople'];
    $_SESSION['searchStartDate'] = $checkindate;
    $_SESSION['searchEndDate'] = $checkoutdate;
    $_SESSION['searchPitchType'] = $selectedPitch;
    $_SESSION['searchNumPeople'] = $totalguest;
    var_dump($_SESSION);
}
?>
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