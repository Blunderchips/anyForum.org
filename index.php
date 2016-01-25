<!DOCTYPE html>

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

        <title>anyForum.org</title>

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
        </div> <br/><br/>

        <div align="center" style="margin-top:15%;">
            <h1 title=".:anyForum.org:." align="center">
                <a href="./" style="text-decoration:none;">.:anyForum.org:.</a>
            </h1>

            <form method="get" action="./thread.php" id="searchform">
                <input type="text" name="id" size="50" placeholder="" title=""/> 
                <input type="submit" title="Submit!" value="Submit"/> 
            </form> 

            <div style="font-size:12px;">
                <a title="Terms of Service" href="./tos.php">Terms of Service</a>
                &nbsp; · &nbsp;
                <a title="Privacy Policy" href="./privacy.php">Privacy Policy</a>
                &nbsp; · &nbsp;
                <a title="Contact" href="./contact.php">Contact</a>
            </div>
        </div>

        <footer>
            <br/> <br/>
            <br/> <br/>
        </footer>
    </body>
</html>
