<!DOCTYPE html>

<?php
$id = htmlspecialchars($_GET["id"]);
if ($id == "") {
    header("Location: ./");
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

        <title><?php echo $id; ?> - anyForum.org</title>

        <link rel="stylesheet" type="text/css" href="./css/main.css"/>
        <link rel="stylesheet" type="text/css" href="//www.htmlcommentbox.com/static/skins/bootstrap/twitter-bootstrap.css?v=0"/>

        <!-- customize labels of htmlcommentbox.com -->
        <script type="text/javascript">
            hcb_user = {
                comments_header: 'Comments - <?php echo $id; ?>',
                name_label: 'Anonymous',
                content_label: 'Enter your comment here...',
                submit: 'Post',
                email_label: 'e-mail (optional)',
                MAX_CHARS: 16384,
                PAGE: 'http://<?php echo htmlspecialchars($_SERVER[HTTP_HOST]) . htmlspecialchars($_SERVER[REQUEST_URI]); ?>'
            };
        </script>
        <!-- done customizing labels of htmlcommentbox.com -->
    </head>

    <body>
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

        <br/> <br/>

        <!-- begin wwww.htmlcommentbox.com -->
        <div id="HCB_comment_box">
            <a title="htmlcommentbox.com" href="http://www.htmlcommentbox.com">Widget</a> is loading comments...
        </div>
        <script type="text/javascript" id="hcb">
            if (!window.hcb_user) {
                hcb_user = {};
            }
            hcb_user.PAGE = "http://<?php echo htmlspecialchars($_SERVER[HTTP_HOST]) . htmlspecialchars($_SERVER[REQUEST_URI]); ?>";
            (function () {
                var s = document.createElement("script"), l = hcb_user.PAGE || ("" + window.location).replace(/'/g, "%27"), h = "//www.htmlcommentbox.com";
                s.setAttribute("type", "text/javascript");
                s.setAttribute("src", h + "/jread?page=" + encodeURIComponent(l).replace("+", "%2B") + "&opts=18319&num=25&ts=1453535497839");
                if (typeof s != "undefined") {
                    document.getElementsByTagName("head")[0].appendChild(s);
                }
            })();
        </script>
        <!-- end www.htmlcommentbox.com -->

        <div> <br/><br/>
            <Strong title="Share this Thread!">Share this Thread - </Strong>
            <span class='st_facebook_hcount' displayText='Facebook'></span>
            <span class='st_googleplus_hcount' displayText='Google +'></span>
            <span class='st_twitter_hcount' displayText='Tweet'></span>
            <span class='st_tumblr_hcount' displayText='Tumblr'></span>

            <br/><br/>
            Views <?php
            if ($id != "") {
                include_once "./counter.php";
            }
            ?>
            &nbsp; - &nbsp;
            <!-- BEGIN: Powered by Supercounters.com -->
            <script type="text/javascript" src="http://widget.supercounters.com/online_t.js"></script>
            <script type="text/javascript">sc_online_t(1168968, "Users Online", "170ddb");</script>
            <noscript><a href="http://www.supercounters.com/">Free Users Online Counter</a></noscript>
            <!-- END: Powered by Supercounters.com -->
        </div>

        <div style="font-size:12px;" align="center"> <br/><br/>
            <a title="Terms of Service" href="./tos.php">Terms of Service</a>
            &nbsp; · &nbsp;
            <a title="Privacy Policy" href="./privacy.php">Privacy Policy</a>
            &nbsp; · &nbsp;
            <a title="Contact" href="./contact.php">Contact</a>
        </div>

        <footer>
            <br/> <br/>
            <br/> <br/>
        </footer>

        <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
        <script type="text/javascript">
            var adfly_id = 1737776;
            var popunder_frequency_delay = 5;
        </script>
        <script src="https://cdn.adf.ly/js/display.js"></script> 
    </body>
</html>
