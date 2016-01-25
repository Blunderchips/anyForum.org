<!DOCTYPE html>

<?php
$id = htmlspecialchars($_GET["v"]);
if ($id == "") {
    header("Location: ../");
}
$contents = file_get_contents('https://www.youtube.com/watch?v=' . $id);

if (preg_match_all("/^.*" . preg_quote('<link itemprop="url" href="http://www.youtube.com/user/', '/') . ".*\$/m", $contents, $matches)) {
    $user = str_replace("          ", "", implode("\n", str_replace('">', "", str_replace('<link itemprop="url" href="http://www.youtube.com/user/', "", $matches[0]))));
}
if (preg_match_all("/^.*" . preg_quote('<title>', '/') . ".*\$/m", $contents, $matches)) {
    $title = getTextBetweenTags(str_replace(" - YouTube", "", explode("<link ", $matches[0][0])[0]), "title");
}
?>

<html itemtype="http://schema.org/WebPage">

    <!--                  _____ 
       _ __ _ _ __  _   _|  ___|__  _ __ _   _ _ __ ___    ___  _ __ __ _ _   
      (_) _` | '_ \| | | | |_ / _ \| '__| | | | '_ ` _ \  / _ \| '__/ _` (_)  
     _ | (_| | | | | |_| |  _| (_) | |  | |_| | | | | | || (_) | | | (_| |_ _ 
    (_|_)__,_|_| |_|\__, |_|  \___/|_|   \__,_|_| |_| |_(_)___/|_|  \__, (_|_)
                    |___/                                           |___/                                            
    
    Copyright Disclaimer Under Section 107 of the Copyright Act 1976, allowance 
    is made for fair use for purposes such as criticism, comment, news reporting, 
    teaching, scholarship, research, commentary, and or parody. Fair use is a use 
    permitted by copyright statute that might otherwise be infringing. Non-profit,
    educational or personal use tips the balance in favor of fair use. 
    -->

    <head>
        <?php include_once("../meta.php"); ?> 

        <link rel="stylesheet" type="text/css" href="http://www.htmlcommentbox.com/static/skins/default/skin.css"/>
        <link rel="stylesheet" type="text/css" href="//www.htmlcommentbox.com/static/skins/bootstrap/twitter-bootstrap.css?v=0"/>

        <style type="text/css">
            html {
                margin-top:3%;
                margin-right:10%;
                margin-left:10%;
            }

            iframe {
                background:#FFF none;
            }

            A:link, A:active, A:visited {
                color:inherit; 
                text-decoration:none;
            }
            A:hover {
                color:inherit;
                text-decoration:underline;
            }
        </style>

        <!-- customize labels of htmlcommentbox.com -->
        <script type="text/javascript">
            hcb_user = {
                comments_header: 'Comments - <?php echo $id; ?>',
                name_label: 'Anonymous',
                content_label: 'Enter your comment here...',
                submit: 'Post',
                email_label: 'e-mail (optional)',
                MAX_CHARS: 16384,
            };
        </script>
        <!-- done customizing labels of htmlcommentbox.com -->

        <title><?php echo $title . " - " . $user; ?></title>
    </head>

    <body>
        <?php include_once("../analyticstracking.php") ?>

        <table align="center">
            <tr>
                <td align="right">   
                    <div align="right" style="margin-top:3%;">
                        <a title="Home" href="../">Home</a> |
                        <a title="Recent" href="../recent.php">Recent</a> |
                        <a title="About" href="../about.php">About</a> |
                        <a title="Rules" href="../rules.php">Rules</a> |
                        <a title="Frequently Asked Questions" href="../faq.php">FAQ</a>
                    </div> 
                </td> 
            </tr>
            <tr>
                <td align="center">
                    <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/<?php echo $id; ?>" frameborder="0" allowfullscreen showinfo="1"></iframe>
                </td>
            </tr>
            <tr>
                <td>
                    <div>
                        <span style="float:left;">
                            <span class='st_googleplus_hcount' displayText='Google +'></span>
                            <span class='st_twitter_hcount' displayText='Tweet'></span>
                            <span class='st_tumblr_hcount' displayText='Tumblr'></span>
                        </span>

                        <span style="float:right;">
                            <!-- LikeBtn.com BEGIN -->
                            <span class="likebtn-wrapper"
                                  data-rich_snippet="true"
                                  data-identifier="<?php echo $id; ?>"
                                  data-show_dislike_label="true"
                                  data-counter_clickable="true"
                                  data-counter_zero_show="true"
                                  data-item_url="http://<?php echo htmlspecialchars($_SERVER[HTTP_HOST]) . htmlspecialchars($_SERVER[REQUEST_URI]); ?>"
                                  data-item_title="<?php echo $title; ?>  (anyForum.org)"
                                  data-item_description="<?php echo $title . " -  " . $user; ?> (anyForum.org)"
                                  data-loader_show="true">
                            </span>
                            <script type="text/javascript">
                                (function (d, e, s) {
                                    if (d.getElementById("likebtn_wjs")) {
                                        return;
                                    }
                                    a = d.createElement(e);
                                    m = d.getElementsByTagName(e)[0];
                                    a.async = 1;
                                    a.id = "likebtn_wjs";
                                    a.src = s;
                                    m.parentNode.insertBefore(a, m)
                                })(document, "script", "//w.likebtn.com/js/w/widget.js");
                            </script>
                            <!-- LikeBtn.com END -->
                        </span>
                    </div> <br/><br/><br/>

                    <span style="float:right;">
                        <?php include_once "../counter.php"; ?>
                    </span>

                    <div align="left">
                        <iframe id="fr" src="http://widget.socialblade.com/widget.php?v=1&u=<?php echo $user; ?>" style="overflow:hidden; height:125px; width:200px; border:0;" scrolling="no" frameBorder="0"></iframe>

                        <br/>
                        <div class="g-ytsubscribe" data-channel="<?php echo $user; ?>" data-layout="default" data-count="default"></div>
                    </div>
                    <br/><hr/>
                </td>
            </tr>
            <tr>
                <td>
                    <!-- begin wwww.htmlcommentbox.com -->
                    <div id="HCB_comment_box">
                        <a title="htmlcommentbox.com" href="http://www.htmlcommentbox.com">Widget</a> is loading comments...
                    </div>
                    <script type="text/javascript" id="hcb">
                        if (!window.hcb_user) {
                            hcb_user = {};
                        }
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

                    <br/>
                    <!-- BEGIN: Powered by Supercounters.com -->
                    <script type="text/javascript" src="http://widget.supercounters.com/online_t.js"></script>
                    <script type="text/javascript">sc_online_t(1168968, "Users Online", "170ddb");</script>
                    <br><noscript><a href="http://www.supercounters.com/">Free Users Online Counter</a></noscript>
                    <!-- END: Powered by Supercounters.com -->
                </td>
            </tr>
            <tr>
                <td align="center">
                    <br/>

                    <div style="font-size:12px;">
                        <a title="Terms of Service" href="../tos.php">Terms of Service</a>
                        &nbsp; · &nbsp;
                        <a title="Privacy Policy" href="../privacy.php">Privacy Policy</a>
                        &nbsp; · &nbsp;
                        <a title="Contact" href="../contact.php">Contact</a>
                    </div> <hr/>

                    <?php
                    switch (mt_rand(0, 3)) {
                        case 0:
                            $adID = 1;
                            break;
                        case 1:
                            $adID = 3;
                            break;
                        case 2:
                            $adID = 4;
                            break;
                        case 3:
                            $adID = 5;
                            break;
                    }
                    ?> 

                    <!-- Start of adf.ly banner code -->
                    <div style="width: 468px; text-align: center; font-family: verdana; font-size: 10px;">
                        <a href="http://adf.ly/?id=1737776">
                            <img border="0" src="https://cdn.adf.ly/images/banners/adfly.468x60.<?php echo $adID; ?>.gif" width="468" height="60" title="AdF.ly - shorten links and earn money!" />
                        </a> <br/>
                        <a title="Get paid to share your links!" href="http://adf.ly/?id=1737776">Get paid to share your links!</a>
                    </div>
                    <!-- End of adf.ly banner code -->

                    <br/>
                    <div style="font-size:10px; text-align:center; padding:2px; color:#ffffff; background-color:#999999">
                        This website is not affiliated with <a title="YouTube.com" href="https://www.youtube.com/">YouTube.com</a>
                    </div>
                </td>
            </tr>
        </table>

        <footer>
            <br/> <br/>
            <br/> <br/>
        </footer>

        <script src="https://apis.google.com/js/platform.js"></script>
        <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
        <script type="text/javascript">
                        stLight.options({
                            publisher: "8afa2b17-6885-41eb-9173-15eb8760abc9",
                            doNotHash: false,
                            doNotCopy: false,
                            hashAddressBar: true
                        });
        </script>

        <script type="text/javascript">
            var adfly_id = 1737776;
            var popunder_frequency_delay = 0;
        </script>
        <script src="https://cdn.adf.ly/js/display.js"></script> 
    </body>
</html>

<?php

function getTextBetweenTags($string, $tagname) {
    preg_match("/<$tagname ?.*>(.*)<\/$tagname>/", $string, $matches);
    return $matches[1];
}
