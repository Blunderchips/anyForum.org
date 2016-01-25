<?php

include ('counter_config.php');

$page = explode("&amp;", htmlspecialchars($_SERVER[REQUEST_URI]))[0];

// ################################################
// ######### connect + select  database ###########
// ################################################

global $localhost, $dbuser, $dbpass, $dbname, $maxrows;

$link = mysql_connect($localhost, $dbuser, $dbpass);

if (!$link) {
    die('Could not connect: ' . mysql_error());
}

$dbselect = mysql_select_db($dbname);
if (!$dbselect) {
    die("Can't use database $dbname! : " . mysql_error());
}

// ########################################################
// ######### check if counter exsist and update ###########
// ########################################################

if (mysql_num_rows($result = mysql_query("SELECT count FROM hits WHERE page = '$page'"))) {
    //A counter for this page  already exsists. Now we have to update it.
    $updatecounter = mysql_query("UPDATE hits SET count = count+1 WHERE page = '$page'");
    if (!$updatecounter) {
        die("Can't update the counter : " . mysql_error());
    }

    echo mysql_result($result, 0);
} else {
    // This page did not exsist in the counter database. A new counter must be created for this page.
    $insert = mysql_query("INSERT INTO hits (page, count) VALUES ('$page', '1')");

    if (!$insert) {
        die("Can\'t insert into hits : " . mysql_error());
    }

    echo "1";
}

// ####################################################
// ######### add IP and user-agent and time ###########
// ####################################################
// gather user data
$ip = htmlspecialchars($_SERVER["REMOTE_ADDR"]);
$agent = htmlspecialchars($_SERVER["HTTP_USER_AGENT"]);
$datetime = date("Y/m/d") . ' ' . date('H:i:s');


if (!mysql_num_rows(mysql_query("SELECT ip_address FROM info WHERE ip_address = '$ip'"))) { // check if the IP is in database
    // if not , add it.	
    $adddata = mysql_query("INSERT INTO info (ip_address, user_agent, datetime) VALUES('$ip' , '$agent','$datetime' ) ");
    if (!$adddata) {
        die('Could not add IP : ' . mysql_error());
    }
}

// ***************************************************************
// ** delete the first entry in $dbtableinfo if rows > $maxrows **
// ***************************************************************

$result = mysql_query("SELECT * FROM info", $link);
$num_rows = mysql_num_rows($result);
$to_delete = $num_rows - $maxrows;
if ($to_delete > 0) {
    for ($i = 1; $i <= $to_delete; $i++) {
        $delete = mysql_query("DELETE FROM info ORDER BY id LIMIT 1");
        if (!$delete) {
            die('Could not delete : ' . mysql_error());
        }
    }
}

mysql_close($link);
