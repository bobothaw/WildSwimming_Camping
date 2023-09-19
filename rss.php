<?php 
include ('connection.php');
header('Content-Type: text/xml');

echo "<?xml version='1.0' encoding='UTF-8'?>
<rss version='2.0'>
<channel>
<title>Global Wild Swimming and Camping Website</title>";
    
$rssQuery = "SELECT * FROM rssfeed ORDER BY RSSPageID DESC";
$runrssQuery = mysqli_query($connect, $rssQuery);
while($rssRow = mysqli_fetch_assoc($runrssQuery))
{
    echo "<item>";
    echo "<title>".htmlspecialchars($rssRow["PageTitle"])."</title>";
    echo "<description>".htmlspecialchars($rssRow["Description"])."</description>";
    echo "<link>".htmlspecialchars($rssRow["URL"])."</link>";
    echo "</item>";
}

echo "</channel>
</rss>";
?>
