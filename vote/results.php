<?php
include ("../top.php");
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

$ext = pathinfo(basename($_SERVER['PHP_SELF']));
$file_name = basename($_SERVER['PHP_SELF'], '.' . $ext['extension']);

print '<body id="' . $file_name . '">';
include ("../menu.php");

include ("../header.php");


print '<section id="main">';

if($Admins[0]["pkUsername"]=='rerickso'){
    include ("votingResults.php");
}

print '</section>';

//include ("../listSponors.php");
include ("../footer.php");
?>
</body>
</html>