<?php
//require_once("connect.php");
//#############################################################################
// 
// Initialize variables
//  

$debug = false;

if ($debug) print "<p>DEBUG MODE IS ON</p>";

include ("top.php");

?>

<section id="main">
<h1 class="page-title">Projects</h1>
<hr/>
<div class="row">
<div class="col-md-8">
<p class="lead">
Registration is now closed
<!--Registration is open but space is limited.-->
</p>
<!--
<a href="register/register.php">
<button type="button" class="btn btn-primary btn-lg btn-block">Submit a 
Project!</button>
</a>
-->
<img src="images/gallery/CS_Fair-15.jpg" alt="CS Fair 2013"
class="img-thumbnail dis projects-img" />
</div>
<div class="col-md-4 sidebar">
<?
include ("votingStats.php");
//include ("rules.php");
?>
</div>
</div>



<div class="row">
<div class="col-md-10">
<?php
$sortOrder= "  ORDER BY RAND()";
$sortDisplay = "Random Sort";

if(isset($_GET["g"])){
    switch (htmlentities($_GET["g"],ENT_QUOTES,"UTF-8")){
        case 10:
            $sortOrder = " ORDER BY fldPresentationTimeSlot, fldProjectDesc";
            $sortDisplay = "Sorted by Presentation Time";
            break;
        
        case 20:
            $sortOrder= " ORDER BY fldProjectBoothNum, fldBoothSide, fldPresentationTimeSlot";
            $sortDisplay = "Sorted by Booth Number";
            break;
        
        case 30:
            $sortOrder= " ORDER BY fldPresentationTimeSlot, fldProjectBoothNum, fldBoothSide ASC";
            $sortDisplay = "Sorted by Presentation Time";
            break;

        case 40:
            $sortOrder= " ORDER BY fldProjectName, fldDateSubmitted ASC";
            $sortDisplay = "Sorted by Project Name";
            break;

        default:
            $sortOrder= "  ORDER BY RAND()";
            $sortDisplay = "Random Sort";
            
    }
      
}

/* i don't think we need this code here. it does not show up in 
older committs.

$key1 = -1;
$key2 = -1;

if (isset($_GET["e"])) {
    $key1 = htmlentities($_GET["e"], ENT_QUOTES, "UTF-8");
    $key2 = htmlentities($_GET["r"], ENT_QUOTES, "UTF-8");

    $sql = "SELECT pkProjectID, fldProjectName, fldProjectSite, fldProjectDesc, fldProjectCourses, fldProjectImageURL, fldProjectBoothNum, fldBoothSide, fldFullPresent, fldPresentationTimeSlot, fldProjectNotes, fldConfirmed, fldDateSubmitted, fldAttemptedConfirms, fldApproved FROM tblProject WHERE fldApproved=1" . $sortOrder;

    $result = $thisDatabase->select($sql, array($key2));

    $dateSubmitted = $result["fldDateSubmitted"];

    $k1 = sha1($dateSubmitted);

    if ($key1 == $k1 AND count($result) != 0) {  // result would be 0 if its not approved
        //identify confirmed
        if ($debug)
            print "<h1>Confirmed</h1>";
    }else {
        print "<p>I am sorry we cannot process this request. Please contact us for more information regarding this error (802-656-3330).";
        die();
    }
}


$rstProjects = $thisDatabase->select($sql, array($key2)); 
*/

    $sql = "SELECT pkProjectID, fldProjectName, fldProjectSite, fldProjectDesc, fldProjectCourses, fldProjectImageURL, fldProjectBoothNum, fldBoothSide, fldFullPresent, fldPresentationTimeSlot, fldProjectNotes, fldConfirmed, fldDateSubmitted, fldAttemptedConfirms, fldApproved FROM tblProject WHERE fldApproved=1" . $sortOrder;
$rstProjects = $thisDatabase->select($sql); 

$num_rows = count($rstProjects);

//print "<h1>Projects </h1>";
print "<p>Sort by: <a href='?g=30'>Presentation Time</a> | <a href='?g=20'>Booth Number</a> | <a href='?g=40'>Title</a> | <a href='?g=1'>Random</a></p>";
print "<p>Total Projects (" . $sortDisplay . "): " .  $num_rows . 
" <br>(Note: If 
your project does not show did you confirm your registration?)</br></p>";

foreach($rstProjects as $oneProject){

    print '<table class="table table-striped table-bordered">';
    print '<thead>';
    print '<tr><th>';
    if($oneProject['fldProjectSite']!=""){    
        print '<a href="' . $oneProject['fldProjectSite'] . '">';
    }

//why get rid of the screen shot?
    // if($oneProject['fldProjectImageURL']!=""){
    //     print '<img src="' . $oneProject['fldProjectImageURL'] . '" class="gravatar" alt="" >';
    // }

    print $oneProject['fldProjectName'];
    if($oneProject['fldProjectSite']!=""){ 
        print '</a>';
    }

print " - " . $oneProject['pkProjectID'];
    print '</th></tr>';
    print '</thead>';

    //add first name and last to student table set up ldap to retrieve names
    print '<tr><td><strong>By:</strong> ';

    $sql = "SELECT fldFirstName, fldLastName FROM tblStudent, tblStudentProject WHERE fkProjectId= " . $oneProject['pkProjectID'] . " AND fkUVMId=pkUsername ORDER BY fldOrder";

    if($debug) echo "<p>" . $sql;

    
    $rstGroup = $thisDatabase->select($sql);
    $lastElement = end($rstGroup);
    foreach($rstGroup as $student){
    if ($student == $lastElement){
        print $student['fldFirstName'] . "&nbsp;" . $student['fldLastName'];
    }else{
           print $student['fldFirstName'] . "&nbsp;" . $student['fldLastName'] . ", ";
       }
    }    




print '</td></tr>';

 /* liking not implemented 
   print '<a href="vote?g=' . 
$oneProject['pkProjectID'] 
. '" class="voteButton"><span>6</span> Likes</a>';
*/
    print '<tr><td><strong>Booth:</strong> ';

    if($oneProject['fldProjectBoothNum']>0){
	print $oneProject['fldProjectBoothNum'] ." - " . $oneProject['fldBoothSide'];
    }else {
	print "Not Assigned Yet";
    }

    print '</td></tr>';
    
    print '<tr><td><strong>Presentation Time:</strong> ';

    switch (date("G", strtotime($oneProject['fldPresentationTimeSlot']))){
        case 12:
        case 13:
        case 14:
        case 15:
            print date("g:i a", strtotime($oneProject['fldPresentationTimeSlot']));
                
            break;
        default:
         print "Not Assigned Yet";   
       }       

    print '</td></tr>';

    if($oneProject['fldFullPresent']){
        print '<p>Be sure to see the Full Presentation</p>'; 
    }
    
    print '<tr><td><strong>Related Course(s):</strong> ';
    print $oneProject['fldProjectCourses'];
    print '</td></tr>';

    print '<tr><td><strong>Description:</strong> ';
    print $oneProject['fldProjectDesc'];
    print '</td></tr>';
    
    print '</table>';
}
?>
</div>
</div>
</section>


<?
include ("footer.php");
?>

</body>
</html>
