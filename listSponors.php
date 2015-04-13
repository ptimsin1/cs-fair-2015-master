<?php
print '<section class="sponsors">';

if ($debug)
    print "<p>DEBUG MODE IS ON </p>";
print '<div class="row">';
print '<div class="col-md-12">';

$sql = "SELECT fldCompanyName, fldCompanySite, fldCompanyLogo, fldSponsorLevel ";
$sql .= "FROM tblSponsor ";
$sql .= "WHERE fldApproved=1 ";
$sql .= "ORDER BY fldSponsorAmount DESC, fldDateSubmitted";

$rstSponsors = $thisDatabase->select($sql);

if ($debug)
    print "<p>sql " . $sql;

$sponsorLevel="";
$firstTime = true;

foreach ($rstSponsors as $sponsor) {
    
    if($sponsorLevel!=$sponsor["fldSponsorLevel"]){
	if(!$firstTime) print '</ol>' . "\n";
	$firstTime = false;

	print '<h3 class="' . $sponsor["fldSponsorLevel"] . '">' . 
$sponsor["fldSponsorLevel"] . "</h3>";
	print '<ol class="list-unstyled list-inline">';
        $sponsorLevel=$sponsor["fldSponsorLevel"];
    }

    print '<li class="' . htmlentities($sponsor["fldSponsorLevel"], ENT_QUOTES, "UTF-8");
    print '"><a href="' . htmlentities($sponsor["fldCompanySite"], ENT_QUOTES, "UTF-8") . '">';

    if (htmlentities($sponsor["fldCompanyLogo"], ENT_QUOTES, "UTF-8") != "") {

        print '<img src="images/logos/' . htmlentities($sponsor["fldCompanyLogo"], ENT_QUOTES, "UTF-8") . '" class="img-thumbnail ' . htmlentities($sponsor["fldSponsorAmt"], ENT_QUOTES, "UTF-8") . '" alt="' . htmlentities($sponsor["fldCompanyName"], ENT_QUOTES, "UTF-8") . '">';
    } else {
        print htmlentities($sponsor["fldCompanyName"], ENT_QUOTES, "UTF-8");
    }

    print '</a></li>';
}

print '</ol>' . "\n";

if ($debug) {
    print "<p>END</p>";
}
print '</div>';
print '</div>';
print '</section>' . "\n";
?>
