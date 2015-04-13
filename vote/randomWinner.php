<?php
include ("../top.php");
print "<p>t=";
print "<ol>";
print "<li>12:50</li>";
print "<li>1:55</li>";
print "<li>3:00</li>";
print "<ol>";

$debug=false;
$admin=false;
$user = getenv('REMOTE_USER');

$sql = "SELECT pkUsername FROM tblAdmin WHERE pkUsername='" . $user . "'";



if($debug) echo "<p>" . $sql;

$Admins = $thisDatabase->select($sql);
if ($debug) {
    print "<p>admins: <pre>";
    print_r($Admins);
    print "</pre>";
}
//$admin = count($Admins); //;

if ($debug) print "<p>admin: " . $admin;

print '<section id="main">';

if($Admins[0]["pkUsername"]=='rerickso'){
if($_GET["t"]==1){
    $timeSlot="2014-12-01 12:50:00";
}elseif($_GET["t"]==2){
    $timeSlot="2014-12-01 13:55:00";
}elseif($_GET["t"]==3){
    $timeSlot="2014-12-01 15:00:00";
}   
    //%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^
// get top five best this hour
$sql  = 'SELECT pkProjectID, fldProjectName, fldProjectBoothNum, fldBoothSide ';
$sql .= 'FROM tblProject  ';
$sql .= 'WHERE fldPresentationTimeSlot="' . $timeSlot .  '" ';
$sql .= 'AND fldApproved>0 ';
$sql .= 'ORDER BY RAND() ';
$sql .= 'LIMIT 1';

if($debug) print "<p>time hour 12:50 " . $sql;

 $results = $thisDatabase->select($sql);
 if ($debug) {
    print "<p>th12 top five: <pre>";
    print_r($results);
    print "</pre>";
}
 
print "<h2>Random Winner for " . date("g:i", strtotime($timeSlot)) . " Time Slot</h2>";
print "<table>\n";
print "<tr><th>Project Name</th><th>Time Slot : Table Number</th><th>Group Memebers</th>\n";
foreach($results as $project){
    print "<tr>\n";
    print "<td>" . $thisProject->projectName($project["pkProjectID"]) . "</td>";
    print "<td class='center'>";
    print $thisProject->projectTableNumber($project["pkProjectID"]) . "</td>";
    print "<td>" . $thisProject->projectMembers($project["pkProjectID"]) . "</td>";
    print "</tr>\n";
}
print "</table>\n";
}

print '</section>';

//include ("../listSponors.php");
include ("../footer.php");
?>
</body>
</html>