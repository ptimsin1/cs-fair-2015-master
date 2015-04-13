<?php
//#############################################################################
//
// List all the judges for the fair by category
//
/* since we added more categories we are just going to list the judges abs
for now as we cannot gaurentee that they will be a judge for the
category they selected.
*/
include ("top.php");
?>
<!-- MAIN CONTENT -->
<section id="main">
<h1 class="page-title">Judges</h1>
<hr/>
<?
include ("judgesRules.php");
if ($debug) print "<p>DEBUG MODE IS ON</p>";
//$sql = "SELECT DISTINCT pkJudgeId, fldTypeofJudge as sortMe,
// RIGHT(fldTypeofJudge, LENGTH(fldTypeofJudge)-3) as fldTypeofJudge, fldFirstName, fldLastName, fldEmail, fldImageName, fldCompany, fldJobTitle,
// fldBio ";
$sql = "SELECT DISTINCT pkJudgeId, fldFirstName, fldLastName, fldEmail, fldImageName, fldCompany, fldJobTitle, fldBio ";
$sql .= "FROM tblJudge, tblSponsor ";
$sql .= "WHERE fkSponsorId=pkSponsorId ";
$sql .= "AND tblSponsor.fldApproved = 1 "; // stops judge from automatically being shown
$sql .= "OR tblJudge.fldApproved = 1 "; // allows judge to work for a company that is not sponsoring us.
$sql .= "ORDER BY fldLastName, fldFirstName";
// removed sortMe
$rstJudges = $thisDatabase->select($sql);
if($debug) {
print "<p>" . $sql . "<pre>";
print_r($rstJudges);
print "</pre>";
}
$judgeType = "NA";
$i=0;
foreach($rstJudges as $judge){
// print out new header if the type of judge has changed
if($judge["fldTypeofJudge"]!=$judgeType){
//if one set has printed end previous ol
if($i>0) print '</ol>' . "\n";
// $judgeType = htmlentities($judge["fldTypeofJudge"], ENT_QUOTES, "UTF-8");
$judgeType="";
print "<hr/>";
print "<h2>" . $judgeType . ' Judges</h2>' . "\n";
print '<ol class="judges list-unstyled">' . "\n";
}
print '<li>' . "\n";
print '<div class="row">';
print '<div class="col-md-4">';
print "<article class='judge-pic-container'";
print ' style="background-image:url(';
print "'images/judges/" . htmlentities($judge["fldImageName"], ENT_QUOTES, "UTF-8");
print "');" . '">' . "\n";
print '</article></div>' . "\n";
print '<div class="col-md-8">';
print '<h2>' . htmlentities($judge["fldFirstName"], ENT_QUOTES, "UTF-8") . "&nbsp;" . htmlentities($judge["fldLastName"], ENT_QUOTES, "UTF-8") . '</h2>';
print '<h4>' . htmlentities($judge["fldJobTitle"], ENT_QUOTES, "UTF-8") . " from " . htmlentities($judge["fldCompany"], ENT_QUOTES, "UTF-8") . "</h4>";
print '<p>' . nl2br(htmlentities($judge["fldBio"], ENT_QUOTES, "UTF-8")) . "</p>";
print '</div>';
print '</div>';
print '</li>'. "\n\n";
$i++; //mainly used to flag for printing ending ol
}
print '</ol>' . "\n";
print '</section>';
include ("footer.php");
if ($debug) print "<p>END</p>";
?>
</section> <!-- page-wrap -->
</body>
</html>
