<?php
include ("../top.php");
//#############################################################################
// 
// Initialize variables
//  
$debug = false;

if ($debug)
    print "<p>DEBUG MODE IS ON</p>";

//$baseURL = "https://www.uvm.edu/~rerickso/csfair/vote/";
$randomVote = 99999;
$NOTICE = "";
$maxVotes = 100;
$totalVotes = 0;
$voting = false;
$user = htmlentities(getenv('REMOTE_USER'), ENT_QUOTES, "UTF-8");
$voteAccepted = false;


$pmk = 1;
$qr = 0;


$schedule = false;  //are we coming from the schedule page?
$dayOfEvent = "2014-12-01";   // if today is the day of the event we set voting to 
$todaysDate = date("Y-m-d");  // for coming from the scheduele page

$yourURL = "www.uvm.edu/~csfair/2014/vote/vote.php";

$admin = "bill";
$sql = "SELECT pkUsername FROM tblAdmin WHERE pkUsername='" . $user . "'";

if ($debug)
    echo "<p>" . $sql;

$result = $thisDatabase->select($sql);
$admin = $result[0]["pkUsername"];


if ($debug)
    print "<p>user: " . $user;

// two of these must be set in order to view page.
// page will just be blank if they are not
// vid and pid are for voting
// wid and qid are display the page.
//https://www.uvm.edu/~rerickso/csfair/vote/vote.php?vid=181&pid=2

/* &*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&
 * 
 *  vote.php?qid=104&sid=6  comes from schedule.php
 * 
 *  voting is set to false but we need to add if it is the day
 *  of the event voting is open
 * 
 * 
 * 
 */

if (isset($_GET["sid"]) OR isset($_GET["amp;sid"])) {
    $schedule = true;
    if ($debug)
        print "<p>SID set Get - schedule: " . $key1;
}

if (isset($_GET["wid"])) {
    $key1 = htmlentities($_GET["wid"], ENT_QUOTES, "UTF-8");
    $voting = false;
    if ($debug)
        print "<p>WID set - Get Key 1: " . $key1;
}

if (isset($_GET["qid"])) {
    $key2 = htmlentities($_GET["qid"], ENT_QUOTES, "UTF-8");

    $pmk = $key2;

//$%^&$%^&$%^&$%^&$%^&$%^&$%^&$%^&$%^&$%^&$%^&$%^&$%^&$%^&$%^&$%^&$%^&$%^&$%^&$%^&$%^&
// commented out for testing

    if ($todaysDate == $dayOfEvent) {
        $voting = true;
    } else {
        $voting = false;
    }
    //$voting = true;

    if ($debug)
        print "<p>qid set - Get Key 2: " . $key2;
}

if (isset($_GET["vid"])) {
    $key1 = htmlentities($_GET["vid"], ENT_QUOTES, "UTF-8");
    $voting = true;
    $qr = $key1;
    if ($debug)
        print "<p>vid set - Get v Key 1: " . $key1;
}

if (isset($_GET["pid"])) {
    $key2 = htmlentities($_GET["pid"], ENT_QUOTES, "UTF-8");
    $voting = true;
    $pmk = $key2;
    if ($debug)
        print "<p>pid set Get p Key 2: " . $key2;
}

if (isset($_POST["vid"])) {
    $key1 = htmlentities($_POST["vid"], ENT_QUOTES, "UTF-8");
    $voting = true;
    $qr = $key1;
    if ($debug)
        print "<p>vid set Post Key 1: " . $key1;
}

if (isset($_POST["pid"])) {
    $key2 = htmlentities($_POST["pid"], ENT_QUOTES, "UTF-8");
    $pmk = $key2;
    $voting = true;
    if ($debug)
        print "<p>pid set - POST Key 2: " . $key2;
}


if ($debug)
    print "<p>pmk: " . $pmk . " - " . $key2;

//#############################################################################
//check to see if person can still vote
$voteFor = $user;
if (isset($_POST["txtNetID"])) {
    if ($admin) {
        $voteFor = htmlentities($_POST["txtNetID"], ENT_QUOTES, "UTF-8");
    }
}

//double check to make sure they are allowed to vote ie check table total votes
$sql = "SELECT count(*) as totVotes FROM tblVotes WHERE fkUVMId='" . $voteFor . "' ";

if ($debug)
    echo "<p>" . $sql;

//$stmt = $db->prepare($sql);
//$stmt->execute(); 
//$result = $stmt->fetch(PDO::FETCH_ASSOC);

$result = $thisDatabase->select($sql);

$totalVotes = $result[0]["totVotes"];

if ($debug) {
    print "<p>Total Votes: " . $totalVotes;
}

// check to make sure they have not voted for this person before
//double check to make sure they are allowed to vote ie check table total votes
$sql = "SELECT fkProjectId FROM tblVotes WHERE fkUVMId='" . $voteFor . "' ";
$sql .= "AND fkProjectId=" . $key2;

if ($debug)
    echo "<p>" . $sql;

//$stmt = $db->prepare($sql);
//$stmt->execute(); 
//$result = $stmt->fetch(PDO::FETCH_ASSOC);

$result = $thisDatabase->select($sql);

$votedProject = $result[0]["fkProjectId"];

if ($debug) {
    print "<p>Voted Project: " . $votedProject;
}
?>

<section id="main">

    <?php
//if(!$schedule) {
    //   print "<h1>Voting does not count till day of event</h2>";
//    if($admin){
//            print "Return to <a href='list.php'>List</a>";
//    }
//}
// &*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&
// lets process the vote
// $voting is a flag set when the pid and vid are passed into this page
// $totalVotes is defined when we first come to the page and is how
//             many votes this person has had
// $votedProject is set above and is just a query to see if the person has
//             voted for this project already
    if ($voting AND $totalVotes < $maxVotes AND ! $votedProject AND ! $schedule) {
        $fromPage = $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
        if ($debug) {
            print "<p>From: " . $fromPage . " should match ";
            print "<p>Your: " . $yourURL;
        }
        if ($fromPage != $yourURL AND ! $_SERVER['HTTPS']) {
            die("<p>Sorry you cannot access this page. Security breach detected and reported.</p>");
        }

        try {
            $thisDatabase->db->beginTransaction();

            /* need to identify vote from student,
             * faculty
             * overall judge
             * spnoser judge
             * other

              use ldap on person's net id the
              array edupersonaffiliation will contain
              student if the person is a student. not perfect because
              they could also be a faculty member taking a class.
              Faculty
              Student
              first i will search if they are judge in my table, if not
              then i will see if they show up in uvm ldap

             */

            $sql = "SELECT fldTypeofJudge FROM tblJudge WHERE fldJudgeCode ='"
                    . $voteFor . "' ";

            if ($debug)
                echo "<p>" . $sql;

//        $stmt = $db->prepare($sql);
//        $stmt->execute(); 
//        $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $result = $thisDatabase->select($sql);
            $type = $result[0]["fldTypeofJudge"];

            if (!$type) {  //this person was not a judge so lets check uvm status
                include("ldap.php");
                $type = LDAPstatus($voteFor);
            }

            // ldap displays some php warnings if they dont find a person so that
            // should be cleaned up
            if (!$type) {
                print "<p class='redText'>There was an error with this vote. The user is not in the system.</p>";
                $type = "Invalid";
            }

            //check to see if this is your project, you cannot vote for yourself
            $sql = "SELECT fkProjectID FROM tblStudentProject ";
            $sql .= "WHERE fkUVMId ='" . $voteFor . "' ";
            $sql .= "AND fkProjectID=" . $key2;

            if ($debug)
                echo "<p>" . $sql;

            $result = $thisDatabase->select($sql);
            $voteForYourself = $result[0]["fkProjectID"];

            if (!$voteForYourself) {
                // if they are allowed to vote lets cast a vote for this project
                $sql = "INSERT INTO tblVotes SET fkUVMId=?, ";
                $sql .= "fkProjectId = ?, ";
                $sql .= "fldType = ?";

                $data = array($voteFor, $key2, $type);

                if ($debug) {
                    echo "<p>" . $sql . "<p><pre>";
                    print_r($data);
                    print "</pre></p>";
                }

                $voted = $thisDatabase->insert($sql, $data);

                // all sql statements are done so lets commit to our changes
                $dataEntered = $thisDatabase->db->commit();

                $totalVotes++;
                $votedProject = $key2;
                $voteAccepted = true;
            }

            if ($type == "Student") { //pick random winner
                //select total votes to see if random winner
                // Total Student votes
                $sql = 'SELECT fkProjectId ';
                $sql .= 'FROM  tblVotes ';
                $sql .= 'WHERE fldType =  "Student"';
                if ($debug)
                    print "<p>Student " . $sql;

                $TotalPeerVotesSubmitted = $thisDatabase->numRows($sql);

                if ($TotalPeerVotesSubmitted == $randomVote) {
                    $NOTICE = "<p>Congratulations " . $voteFor . " has cast the " . $TotalPeerVotesSubmitted . " vote!</p>";
                    $to = $voteFor . "@uvm.edu"; //, rerickso@uvm.edu";
                    $from = "";
                    $subject = "CS FAIR: : " . $TotalPeerVotesSubmitted . " vote cast!";
                    $mailed = sendMail($to, $from, $subject, $NOTICE);
                }
            }
            if ($debug)
                print "<p>transaction complete ";
        } catch (PDOExecption $e) {
            $thisDatabase->db->rollback();
            if ($debug)
                print "Error!: " . $e->getMessage() . "</br>";
            print "<h2>Error!: There was a problem with accpeting your Vote please contact us directly.</h2>";
        }
    }  //end processing vote
    // 
    // 
// &*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&
// get project to display
    $sql = "SELECT pkProjectID, fldQrCode, fldProjectName, fldProjectSite, ";
    $sql .= "fldProjectDesc, fldProjectCourses, fldProjectImageURL, ";
    $sql .= "fldProjectBoothNum,fldBoothSide,fldPresentationTimeSlot ";
    $sql .= "FROM tblProject ";
    $sql .= "WHERE ";
    $sql .= "pkProjectID=" . $key2 . " ";
    if ($voting and ! $schedule) {
        $sql .= "AND fldQrCode=" . $key1;
    }

    if ($debug)
        echo "<p>Get Project to display: " . $sql;

    $rstProjects = $thisDatabase->select($sql);

    foreach ($rstProjects as $oneProject) {

        print '<article class="project">';

        print '<h3>';
        if ($oneProject['fldProjectSite'] != "") {
            print '<a href="' . $oneProject['fldProjectSite'] . '">';
        }
        if ($oneProject['fldProjectImageURL'] != "") {
            print '<img src="' . $siteURL . $oneProject['fldProjectImageURL'] . '" class="gravatar" alt="" >';
        }
        print $oneProject['pkProjectID'] . ' - ' . $oneProject['fldProjectName'];


        if ($oneProject['fldProjectSite'] != "") {
            print '</a>';
        }

        print '</h3>';

        /* display project */
        print '<p class="projectGroup">By:</p>';
        print '<ol class="groupNames">';

        $sql = "SELECT fldFirstName, fldLastName FROM tblStudent, 
    tblStudentProject WHERE fkProjectId=" .
                $oneProject['pkProjectID'] . " AND fkUVMId=pkUsername ORDER BY fldOrder";

        if ($debug)
            echo "<p>" . $sql;


        $rstGroup = $thisDatabase->select($sql);

        foreach ($rstGroup as $student) {
            print '<li>' . $student['fldFirstName'] . "&nbsp;" .
                    $student['fldLastName'] . "</li>" . "\n";
        }

        print "</ol>\n";

        print '<div class="event">';
        // print '<a href="vote?g=' . $oneProject['pkProjectID'] . '"  class="voteButton"><span>6</span> Likes</a>';

        print '<p>Booth Number: ';

        if ($oneProject['fldProjectBoothNum'] > 0) {
            print $oneProject["fldProjectBoothNum"] . " - " . $oneProject["fldBoothSide"];
        } else {
            print "Not Assigned Yet";
        }

        print '</p>';


        print '<p>Presentation Time: ';

        switch (date("G", strtotime($oneProject['fldPresentationTimeSlot']))) {
            case 12:
            case 13:
            case 14:
            case 15:
                print date("g:i a", strtotime($oneProject['fldPresentationTimeSlot']));

                break;
            default:
                print "Not Assigned Yet";
        }

        print '</p>';

        if ($oneProject['fldFullPresent']) {
            print '<p>Be sure to see the Full Presentation</p>';
        }
        print '</div>';


        print '<p class="projectAbstract">';
        print $oneProject['fldProjectDesc'];
        print '</p>';


        print '<p class="projectCourses">Class project is for (or related to): ';

        print '<span>' . $oneProject['fldProjectCourses'] . '</span>';
        print '</p>';
        print '</article>';

        //form will display for last project only but there should be only one
        $pmk = $key2; //$oneProject['pkProjectID'];
        $qr = 0; //$oneProject['fldQrCode'];
    } // for each project
    //#$#$#$#$#$#$$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$
    // prepare the voting aside

    print '<div id=voteForMe>';
    print $NOTICE;
    /* if($admin AND !$schedule){
      print "Return to <a href='list.php'>List</a>";
      print "<p>Conditional: ". ($voting AND (!$votedProject AND ($totalVotes < $maxVotes)) || $admin);
      } */
    //print "<h1>Voting now is only for testing</h1><p>Voting will be open the day of the event</p>";
    if ($schedule AND ! $voting) {
        print "<h1>Vote</h1><p>Voting will be open the day of the event</p>";
    }

    /* ok so if you have:
     *  
     *  voting is open
     *  not voted for this project AND  not used up all your votes
     *  or you are an admin who needs to vote for other people
     */
    if (($voting AND ( !$votedProject AND ( $totalVotes < $maxVotes)) || $admin)) {

        /* display the form */
        ?>

        <form action="<?php print $_SERVER['PHP_SELF']; ?>" 
              method="post"
              id="frmRegister">

            <fieldset class="vote">

                <label class="smallText">Voter: 
                    <input id ="txtNetID" name="txtNetID" class="element text medium netid <?php
                    if ($userERROR)
                        echo ' mistake';
                    ?>" type="text" maxlength="255" value= "<?php print $voteFor; ?>"  
                           onfocus="this.select()"  tabindex="20" 
                           <?php
                           if ($user != $admin) {
                               print "readonly";
                           }
                           ?>>
                </label>


                <label class="smallText">Project #: 
                    <input id ="pid" name="pid" class="element text medium netid 
                    <?php
                    if ($userERROR)
                        echo ' mistake';
                    ?>" type="text" maxlength="3" value= "<?php print $pmk; ?>"  
                           onfocus="this.select()"  tabindex="25" <?php
                           if ($user != $admin) {
                               print "readonly";
                           }
                           ?>/></label>

                <label><span id="tv" class="right <?php
                    print " greenText";

                    print '"> Your Votes: ';
                    print $totalVotes;
                    print "</span>";
                    print '<input type="hidden" id="vid" name="vid" value="' . $qr . '">';
                    print '</label>';

                    // print '    <input type="hidden" id="pid" name="pid" value="' . $oneProject['pkProjectID'] . '">';

                    if ($totalVotes < $maxVotes or $admin) {
                        print '<input type="submit" id="btnVote" name="btnSubmit" 
               value="Vote For Me" tabindex="991" class="button">';
                    }
                    ?>

                             </fieldset>
                             </form>

                             <?php
                         } // end displaying the form

                         /* have we entered the vote into the database just now
                          * $voteAccepted and $dataEntered appear to be the same thing
                          */
                         if ($voting) {
                             if ($voteAccepted) {
                                 print "<p class='smallText greenText'>" . $voteFor . " vote has been recorded for this project</p>";
                             } elseif (!$schedule) {
                                 print "<p class='smallText redText'>" . $voteFor . " vote was invalid.";
                                 if ($voteForYourself)
                                     print"<p class='smallText redText'>Sorry you cannot vote for your own project.</p>";
                                 if ($votedProject)
                                     print "<br>Project has already received your vote.";
                                 if ($totalVotes >= $maxVotes)
                                     print"<br>You have used up all your votes already.";
                                 print "</p>";
                             }elseif ($totalVotes >= $maxVotes) {
                                 print"<p class='smallText redText'>You have used up all your votes already.";
                                 if ($votedProject)
                                     print "<br>Project has already received your vote.";
                                 print "</p>";
                             }else {
                                 if ($votedProject)
                                     print "<p class='smallText redText'>Project has already received your 
vote.</p>";
                             }
                         } // ends voting

                         /* display QR code dotn need it on this page since if you scanned the
                          * qr code it voted for you   
                           if(!$votedProject and $voting and ($totalVotes < $maxVotes) || $admin){
                           print '<p class="smallText">Scan code or click above to vote</p>';

                           print '<img src="qrcodes/qr_code_' . $oneProject['pkProjectID'] . '.png" class="qr" alt="" >';
                           } */

                         print "<p><a href='../schedule.php#p" . $oneProject['pkProjectID'] . "'>Return to Schedule</a></p>";

                         print '</div> <!-- ends vote for me -->';
//#$#$#$#$#$#$$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$#$
                         ?>
                         </section>


                         <?php
                         include ("../votingStats.php");
                         include ("../footer.php");
                         ?>
                         </section>
                    </body>
                    </html>