<?php

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//performs a few security checks
function securityCheck($form = "") {

    // globals defined in top.php
    global $path_parts;
    global $server;
    global $domain;
    global $debug;
    global $user;
    global $adminEmail;
    $debug = false;
    $errorMsg = array();

    $passed = true;

    $whiteListPages = array("about.php",
        "confirmation.php",
        "contact.php",
        "home.php",
        "judges.php",
        "photos.php",
        "projects.php",
        "randomWinner.php",
        "register.php",
        "results.php",
        "schedule.php",
        "sponsor.php",
        "sponsorsForm.php",
        "paperBallot.php",
        "vote.php",
        "voting.php",
        "votingResults.php",
    );

    if ($debug)
        print "<P>A " . $path_parts['dirname'];
    // folders may be tricky on the cems account as i am not sure what they are :(
    $whiteListFolders = array($path_parts['dirname']);

    if (!in_array("admin", explode("/", $basePath))) {
        $whiteListFolders[] = "/admin";

        // add files from the admin folder which should be set up to seperate
        // the files
        $whiteListPages[] = "paperBallor.php";
        $whiteListPages[] = "votingResults.php";
    }

    /* we dont seem to set ip address
      if ($_SESSION["ipAddress"] == htmlentities($_SERVER['REMOTE_ADDR'], ENT_QUOTES, "UTF-8")) {
      $passed = true;
      $errorMsg[] = "<p>Passed ip address check</p>";
      } else {
      $errorMsg[] = "<p>Failed ip address check s=:" . $_SESSION["ipAddress"] . " f=" . htmlentities($_SERVER['REMOTE_ADDR'], ENT_QUOTES, "UTF-8") . "</p>";
      }

      if($debug) print "<p>IP: " . $passed . " - " . $_SESSION["ipAddress"] . " == " .  htmlentities($_SERVER['REMOTE_ADDR'], ENT_QUOTES, "UTF-8");
     */

    if (isset($_REQUEST["hiddenToken"])) {
        if ($_SESSION["token"] == htmlentities($_REQUEST["hiddenToken"], ENT_QUOTES, "UTF-8")) {
            $passed = true;
            if ($debug)
                print "<p>token t: " . $passed;
            $errorMsg[] = "<p>Passed token check</p>";
        }else {
            $passed = false;
            $errorMsg[] = "<p>Failed token check s=:" . $_SESSION["token"] . " f=" . htmlentities($_REQUEST["hiddenToken"], ENT_QUOTES, "UTF-8") . "</p>";
            if ($debug)
                print "<p>token f: " . $passed;
        }
    }

    if (!in_array($path_parts['basename'], $whiteListPages)) {
        $passed = false;
        $errorMsg[] = "<p>Failed white list pages check: " . $path_parts['basename'] . "</p>";
        if ($debug) {
            print "<p>white list pages: " . $path_parts['basename'] . "<pre>";
            print_r($whiteListPages);
            print "</pre><p>basename: " . $path_parts['basename'];
        }
    }

    if ($form != "") {
        $errorMsg[] = "<p>Entering form check</p>";

        if ($debug)
            print_r($my_parts);

        if (!in_array($path_parts["basename"], $whiteListPages)) {
            $passed = false;
            $errorMsg[] = "<p>Failed form submission white list pages check" . $path_parts["basename"] . "</p>";
            if ($debug)
                print "<p>white list pages form: " . $passed . $path_parts["basename"];
        }


        if (!in_array($path_parts['dirname'], $whiteListFolders)) {
            $passed = false;
            $errorMsg[] = "<p>Failed white list folders check" . $path_parts['dirname'] . "</p>";
            if ($debug) {
                print "<p>dirname: " . $passed . " : " . $path_parts['dirname'];
            }
        }

        if ($server != "www.uvm.edu") {
            $passed = false;
            $errorMsg[] = "<p>Failed server check: " . $server . "</p>";
            if ($debug)
                print "<p>server: " . $passed . $server;
        }
    }

    if ($debug)
        print "<p>returning C: " . $passed;

    if (!$passed) {
        //send message to me
        $message = "<p>Login failed for: " . $student . " and crn: " . $crn . "</p>\n";
        $message .= "<p>Login failed: " . date("F j, Y") . " at " . date("h:i:s") . "</p>\n";

        foreach ($errorMsg as $one) {
            $message .= $one . "\n";
        }

        $to = $adminEmail;
        $cc = "";
        $bcc = "";
        $from = "Cs Fair Login <security@uvm.edu>";
        $subject = "Login Status ";
        $mailed = sendMail($to, $from, $message, $cc, $bcc, $subject);
    }
    return $passed;
}

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
?>
