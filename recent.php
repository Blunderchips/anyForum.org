<!DOCTYPE html>

<?php
include("./counter_config.php");

$link = mysql_connect($localhost, $dbuser, $dbpass);
if (!$link) {
    die('Could not connect to database : ' . mysql_error());
}

$db_selected = mysql_select_db($dbname, $link);
if (!$db_selected) {
    die('Can\'t use database : ' . mysql_error());
}

session_start();

$tmp = htmlspecialchars($_POST["threads"]);
if ($tmp != "") {
    $_SESSION["threads"] = $tmp;
} elseif ($_SESSION["threads"] == "") {
    $_SESSION["threads"] = "ALL";
}

$tmp = htmlspecialchars($_POST["watch"]);
if ($tmp != "") {
    $_SESSION["watch"] = $tmp;
} elseif ($_SESSION["watch"] == "") {
    $_SESSION["watch"] = "ALL";
}
?>

<html itemtype="http://schema.org/WebPage">  

    <!--                  _____ 
       _ __ _ _ __  _   _|  ___|__  _ __ _   _ _ __ ___    ___  _ __ __ _ _   
      (_) _` | '_ \| | | | |_ / _ \| '__| | | | '_ ` _ \  / _ \| '__/ _` (_)  
     _ | (_| | | | | |_| |  _| (_) | |  | |_| | | | | | || (_) | | | (_| |_ _ 
    (_|_)__,_|_| |_|\__, |_|  \___/|_|   \__,_|_| |_| |_(_)___/|_|  \__, (_|_)
                    |___/                                           |___/                                            
    -->

    <head>
        <?php include_once("meta.php"); ?> 
        <meta http-equiv="refresh" content="300"/>

        <title>Recent - anyForum.org</title>

        <link rel="stylesheet" type="text/css" href="./css/main.css"/>
    </head>

    <body lang="en-ZA">
        <?php include_once("analyticstracking.php"); ?>

        <div align="right" style="margin-top:3%;">
            <a title="Home" href="./">Home</a> |
            <a title="Recent" href="./recent.php">Recent</a> |
            <a title="About" href="./about.php">About</a> |
            <a title="Rules" href="./rules.php">Rules</a> |
            <a title="Frequently Asked Questions" href="./faq.php">FAQ</a>
        </div> <br/>

        <h1 title=".:anyForum.org:." align="center">
            <a href="./" style="text-decoration:none;">.:anyForum.org:.</a>
        </h1>

        <p align="center">
            A place where anyone can talk about anything at anytime.
        </p> <br/>

        <span>
            <h3><span style="float:left;"><a title="YouTube Videos" name="videos" href="recent.php#videos" style="text-decoration:none;">YouTube Videos</a></span></h3>

            <span style="float:right;">
                <form method="post" action="./recent.php">
                    <select name="watch">
                        <?php
                        $states = array(
                            'ALL' => "All Time",
                            'HOUR' => "Last Hour",
                            'DAY' => "Last Day",
                            'WEEK' => "Last Week",
                            'MONTH' => "Last Month",
                            'QUARTER' => "Last Quarter",
                            'YEAR' => "Last Year"
                        );

                        foreach ($states as $key => $val) {
                            echo ($key == $_SESSION["watch"]) ? "<option selected=\"selected\" value=\"$key\">$val</option>\n" : "<option value=\"$key\">$val</option>\n";
                        }
                        ?>
                    </select>
                    <input type="submit" title="Refresh" value="Refresh"/>
                </form>
            </span>
        </span>
        <table width='100%' border='0'>
            <tr>
                <th width="400">Video</th> 
                <th width="169">Views</th>
            </tr>

            <?php
            if ($_SESSION["watch"] == "ALL") {
                $result = mysql_query("SELECT page, count FROM hits WHERE page LIKE '%watch%' ORDER BY count DESC LIMIT 50");
            } else {
                $result = mysql_query("SELECT * FROM hits WHERE stamp >= NOW() - INTERVAL 1 " . $_SESSION["watch"] . " AND page LIKE '%watch%' ORDER BY count DESC LIMIT 50");
            }

            while ($row = mysql_fetch_array($result)) {
                $id = $row['page'];
                $page = file_get_contents('https://www.youtube.com/' . $id);

                $user = getUser($page);
                $title = getTitle($page);

                echo '<tr><td>';
                if ($user == "") {
                    echo "<a title='" . $title . "' href='" . $id . "'>" . $title . "</a>";
                } else {
                    echo "<a title='" . $title . " - " . $user . "' href='" . $id . "'>" . $title . "</a>";
                }
                echo '</td><td>';
                echo $row['count'];
                echo '</td></tr>' . "\n";
            }

            if ($_SESSION["watch"] == "ALL") {
                $result = mysql_query("SELECT SUM(count) AS totalhits FROM hits WHERE page LIKE '%watch%' LIMIT 50") or die(mysql_error());
            } else {
                $result = mysql_query("SELECT SUM(count) AS totalhits FROM hits WHERE page LIKE '%watch%' AND stamp >= NOW() - INTERVAL 1 " . $_SESSION["watch"] . " LIMIT 50") or die(mysql_error());
            }
            while ($row = mysql_fetch_array($result)) {
                $totalViews = $row['totalhits'];
            }
            ?>

            <tr title="Total Views: <?php echo $totalViews; ?>">
                <td bgcolor="#4CAF50"><strong>Total Views</strong></td>
                <td bgcolor="#4CAF50"><strong><?php echo $totalViews; ?></strong></td>
            </tr>
        </table> <br/>

        <span>
            <h3><span style="float:left;"><a title="Threads" name="threads" href="recent.php#threads" style="text-decoration:none;">Threads</a></span></h3>

            <span style="float:right;">
                <form method="post" action="./recent.php">
                    <select name="threads">
                        <?php
                        $states = array(
                            'ALL' => "All Time",
                            'HOUR' => "Last Hour",
                            'DAY' => "Last Day",
                            'WEEK' => "Last Week",
                            'MONTH' => "Last Month",
                            'QUARTER' => "Last Quarter",
                            'YEAR' => "Last Year"
                        );

                        foreach ($states as $key => $val) {
                            echo ($key == $_SESSION["threads"]) ? "<option selected=\"selected\" value=\"$key\">$val</option>\n" : "<option value=\"$key\">$val</option>\n";
                        }
                        ?>
                    </select>
                    <input type="submit" title="Refresh" value="Refresh"/>
                </form>
            </span>
        </span>
        <table width='100%' border='0'>
            <tr>
                <th height="2" width="400">Name</th> 
                <th height="2" width="169">Views</th>
            </tr>

            <?php
            if ($_SESSION["threads"] == "ALL") {
                $result = mysql_query("SELECT page, count FROM hits WHERE page LIKE '%thread%' ORDER BY count DESC LIMIT 50");
            } else {
                $result = mysql_query("SELECT * FROM hits WHERE stamp >= NOW() - INTERVAL 1 " . $_SESSION["threads"] . " AND page LIKE '%thread%' ORDER BY count DESC LIMIT 50");
            }

            while ($row = mysql_fetch_array($result)) {
                $pageID = str_replace("/thread.php?id=", "", $row['page']);

                echo '<tr><td>';
                echo "<a title='$pageID - anyForum.org' href='/thread.php?id=$pageID'>$pageID</a>";
                echo '</td><td>';
                echo $row['count'];
                echo '</td></tr>' . "\n";
            }

            if ($_SESSION["threads"] == "ALL") {
                $result = mysql_query("SELECT SUM(count) AS totalhits FROM hits WHERE page LIKE '%thread%' LIMIT 50") or die(mysql_error());
            } else {
                $result = mysql_query("SELECT SUM(count) AS totalhits FROM hits WHERE page LIKE '%thread%' AND stamp >= NOW() - INTERVAL 1 " . $_SESSION["threads"] . " LIMIT 50") or die(mysql_error());
            }
            while ($row = mysql_fetch_array($result)) {
                $totalViews = $row['totalhits'];
            }
            ?>

            <tr title="Total Views: <?php echo $totalViews; ?>">
                <td bgcolor="#4CAF50"><strong>Total Views</strong></td>
                <td bgcolor="#4CAF50"><strong><?php echo $totalViews; ?></strong></td>
            </tr>
        </table> <br/>

        <footer>
            <br/> <br/>
            <br/> <br/>
        </footer>
    </body>
</html>

<?php

function getTitle($page) {
    if (preg_match_all("/^.*" . preg_quote('<title>', '/') . ".*\$/m", $page, $matches)) {
        return getTextBetweenTags(str_replace(" - YouTube", "", explode("<link ", $matches[0][0])[0]), "title");
    }
}

function getUser($page) {
    if (preg_match_all("/^.*" . preg_quote('<link itemprop="url" href="http://www.youtube.com/user/', '/') . ".*\$/m", $page, $matches)) {
        return str_replace("          ", "", implode("\n", str_replace('">', "", str_replace('<link itemprop="url" href="http://www.youtube.com/user/', "", $matches[0]))));
    }
}

function getTextBetweenTags($string, $tagname) {
    preg_match("/<$tagname ?.*>(.*)<\/$tagname>/", $string, $matches);
    return $matches[1];
}
