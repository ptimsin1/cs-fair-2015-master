<!DOCTYPE html>
<html lang="en">
    <head>
        <title>UVM CS Fair</title>
        <meta charset="utf-8">
        <!-- needed ? fails w3validation      <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
        <meta name="author" content="">
        <meta name="description" content="A Showcase of Student Projects held once a year in decemeber during the last week of classes. Students compete for prizes in several categories, best overall, best in class and my favorite random!">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
        <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

        <!--[if lt IE 9]>
            <script src="//html5shim.googlecode.com/sin/trunk/html5.js"></script>
        <![endif]-->

        <?php
        $debug = false;
        $debugLog = "";
        $user = "guest";
        $adminEmail = "rerickso@uvm.edu";

        $maxJudges = 5;  /* if you change this number you will need to update the 
         * sponsor form in two places
         * roughly line 255 find: " fifth ";
         *  roughly line 725, find: print "Fifth "; 
         * 
         */
        $numJudges = 0;

        $maxGroupSize = 10;

        if (isset($_SERVER['REMOTE_USER'])) {
            $user = htmlentities($_SERVER['REMOTE_USER'], ENT_QUOTES, "UTF-8");
        }
// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^% 
// 
//  PATH SETUP
//  
// used for setting path to CSS not sure if any place else
// $domain = "https://www.uvm.edu" or http://www.uvm.edu;

        if ($_SERVER['HTTPS']) {
            $domain = "https://";
        } else {
            $domain = "http://";
        }
        $server = htmlentities($_SERVER['SERVER_NAME'], ENT_QUOTES, "UTF-8");

        $domain .= $server;

        $phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");

        $path_parts = pathinfo($phpSelf);

        $basePath = $domain . $path_parts['dirname'] . "/";

        // sets the path to go from the sub folder up one level
        // needed for register/register.php

        if ((stristr($path_parts['dirname'], "register") != false) OR stristr($path_parts['dirname'], "vote") != false) {
            $cssDomain = $basePath . "../css";
            $confirmationPath = dirname($basePath);
            $siteUrl = dirname($basePath) . "/";
            $jsPath = $basePath . "../";
        } else {
            $cssDomain = $basePath . "css";
            $confirmationPath = $basePath;
            $siteUrl = $basePath;
            $jsPath = "";
        }


        $fromPage = htmlentities(getenv("http_referer"), ENT_QUOTES, "UTF-8");

        if ($debug) {
            $debugLog[] = "<p>basePath" . $basePath;
            $debugLog[] = print_r($path_parts);
        }

// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^% 
// 
//  inlcude all libraries
//  
        require_once('lib/myDatabase.php');
        $thisDatabase = new myDatabase;

        require_once('lib/myJudge.php');
        $thisJudge = new myJudge($thisDatabase);

        require_once('lib/myProject.php');
        $thisProject = new myProject;

        require_once('lib/security.php');
        require_once('lib/mailMessage.php');
// had mistakes make new one
        // require_once('lib/validation_functions.php');

// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^% 
// 
//  javascript code for the register page to allow a person to add group members
//
        // CSS Files: Bootstrap and Custom CSS
        /* print '<link href="css/bootstrap.min.css" rel="stylesheet">';
          print '<link href="css/custom.css" rel="stylesheet">';
          need to use the cssdomain for register and some admin pages
         */
        print '<link rel="stylesheet" href="' . $cssDomain . '/bootstrap.min.css">';
        print '<link rel="stylesheet" href="' . $cssDomain . '/custom.css">';

        // Boostrap Modernizer
        print '<script src="' . $jsPath . 'js/flexslider/modernizr.js"></script>';

        // Google fonts
        print "<link href='http://fonts.googleapis.com/css?family=Yesteryear' rel='stylesheet' type='text/css'>";

        // Flexslider
        if ($path_parts['filename'] == "home") {
            ?>
            <!-- Flexslider CSS -->
            <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
            <!-- Flexslider Modernizr -->
            <script src="js/flexslider/modernizr.js"></script>

            <?php
        }  // end if for home page 

        if ($path_parts['filename'] == "photos") {
            ?>
            <script src="js/jquery-1.10.2.min.js"></script>
            <script src="js/lightbox-2.6.min.js"></script>

            <link href="css/lightbox.css" rel="stylesheet" />  
            <?php
        } // end if for photo gallery page

        if ($path_parts['filename'] == "register") {
            ?>    

            <script type="text/javascript">
                        <!--
                function showNextGroup(index) {
                        //index=index+1;
                        //obj = "" + index

                        switch (index) {

    <?php
    for ($i = 1; $i < $maxGroupSize; $i++) {
        print 'case ' . $i . ':';
        echo "\n";
        echo 'document.getElementById("group';
        echo $i + 1;
        echo '").style.display="block"; ';
        echo "\n";
        print 'document.getElementById("btnAdd' . $i . '").style.display="none"; ';
        echo "\n";
        print 'break; ';
        echo "\n";
    }
    ?>

                        }
                        }
                //-->
            </script>
            <?php
        } // ends file name register


        if ($path_parts['filename'] == "sponsorsForm") {
            ?>    

            <script type="text/javascript">
                <!--
                    function showNextJudge(nextJudge) {
                switch (nextJudge) {

    <?php
    for ($z = 0; $z < $maxJudges; $z++) {
        print "\n" . 'case ' . $z . ':' . "\n";
        print 'document.getElementById("judge';
        print $z + 1 . '").style.display="block";' . "\n";
        print 'document.getElementById("btnAdd' . $z . '").style.display="none";' . "\n";
        print 'document.getElementById("txtJudgesFirstName';
        print $z + 1 . '").focus();';
        print 'break;' . "\n";
    }
    ?>
                }
                }
                //-->
            </script>

            <?php
        } // ends file name SPONSOR FORM
// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^% 
// 
//  load JavaScript for the slideshow
        if ($path_parts["filename"] == "index") {
            // print '<meta http-equiv="refresh" content="100">';
            print "<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js?ver=3.0.1'></script>";
            print "<script type='text/javascript' src='infinite-rotator.js'></script>";
        }

        print '</head>';

        print '<body id="' . $path_parts["filename"] . '">';

//############################################################################

        if (!securityCheck()) {
            print "<p>Login failed for: " . $user . "</p>\n";
            print "<p>Login failed: " . date("F j, Y") . " at " . date("h:i:s") . "</p>\n";
            die("<p>Sorry you cannot access this page. Security breach detected and reported</p>");
        }
        if ($debug)
            print "<h1>security check=:" . securityCheck() . "eoj</h1>";

//############################################################################
        print '<section id="page-wrap">';
        include ("header.php");

        include ("menu.php");

        if ($debug) {
            if (isset($output)) {
                $output = join("\n<p>", $debugLog);
                echo $output;
            }
        }
        ?>
