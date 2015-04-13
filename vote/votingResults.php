<?php

include "../top.php";

/* require_once("connect.php");
  require_once('../lib/myDatabase.php');
  $thisDatabase = new myDatabase;
  $thisProject = new myProject;

 */
$debug = false;

$user = htmlentities(getenv('REMOTE_USER'), ENT_QUOTES, "UTF-8");
$admin = "bill";
$sql = "SELECT pkUsername FROM tblAdmin WHERE pkUsername='" . $user . "'";

if ($debug)
    echo "<p>" . $sql;

$result = $thisDatabase->select($sql);
$admin = $result[0]["pkUsername"];

if ($user == $admin) {

    print '<section id="main">';
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^
// get top ten 
    $sql = 'SELECT count( * ) AS votes, fkProjectId ';
    $sql .= 'FROM tblVotes ';
    $sql .= 'WHERE fldType != "Invalid" ';
    $sql .= 'GROUP BY fkProjectId ';
    $sql .= 'ORDER BY votes DESC ';
    $sql .= 'LIMIT 10';

    if ($debug)
        print "<p> Overall " . $sql;

    $results = $thisDatabase->select($sql);
    if ($debug) {
        print "<p>S top ten: <pre>";
        print_r($results);
        print "</pre>";
    }

    print "<h2>Everyone Vote - Top Ten</h2>";
    print "<table>\n";
    print "<tr><th>Total Votes</th><th>Project Name</th><th>Time Slot : Table Number</th><th>Group Memebers</th>\n";
    foreach ($results as $project) {
        print "<tr>\n";
        print "<td class='center'>" . $project["votes"] . "</td>";
        print "<td>" . $thisProject->projectName($project["fkProjectId"]) . "</td>";
        print "<td class='center'>" . date("g:i", strtotime($thisProject->projectTime($project["fkProjectId"])));
        print " : " . $thisProject->projectTableNumber($project["fkProjectId"]) . "</td>";
        print "<td>" . $thisProject->projectMembers($project["fkProjectId"]) . "</td>";

        print "</tr>\n";
    }
    print "</table>\n";


//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^
// get top five judges overall pick
    $sql = 'SELECT count( * ) AS votes, fkProjectId ';
    $sql .= 'FROM tblVotes ';
    $sql .= 'WHERE fldType = "Judge" ';
    $sql .= 'GROUP BY fkProjectId ';
    $sql .= 'ORDER BY votes DESC ';
    $sql .= 'LIMIT 5';

    if ($debug)
        print "<p>Judges Overall " . $sql;

    $results = $thisDatabase->select($sql);
    if ($debug) {
        print "<p>J top five: <pre>";
        print_r($results);
        print "</pre>";
    }

    print "<h2>Judges Votes - Top Five</h2>";
    print "<table>\n";
    print "<tr><th>Total Votes</th><th>Project Name</th><th>Time Slot : Table Number</th><th>Group Memebers</th>\n";
    foreach ($results as $project) {
        print "<tr>\n";
        print "<td class='center'>" . $project["votes"] . "</td>";
        print "<td>" . $thisProject->projectName($project["fkProjectId"]) . "</td>";
        print "<td class='center'>" . date("g:i", strtotime($thisProject->projectTime($project["fkProjectId"])));
        print " : " . $thisProject->projectTableNumber($project["fkProjectId"]) . "</td>";
        print "<td>" . $thisProject->projectMembers($project["fkProjectId"]) . "</td>";

        print "</tr>\n";
    }
    print "</table>\n";

//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^
// get top five Student overall pick
    $sql = 'SELECT count( * ) AS votes, fkProjectId ';
    $sql .= 'FROM tblVotes ';
    $sql .= 'WHERE fldType = "Student" ';
    $sql .= 'GROUP BY fkProjectId ';
    $sql .= 'ORDER BY votes DESC ';
    $sql .= 'LIMIT 5';

    if ($debug)
        print "<p>Student Overall " . $sql;

    $results = $thisDatabase->select($sql);
    if ($debug) {
        print "<p>St top five: <pre>";
        print_r($results);
        print "</pre>";
    }

    print "<h2>Student Votes - Top Five</h2>";
    print "<table>\n";
    print "<tr><th>Total Votes</th><th>Project Name</th><th>Time Slot : Table Number</th><th>Group Memebers</th>\n";
    foreach ($results as $project) {
        print "<tr>\n";
        print "<td class='center'>" . $project["votes"] . "</td>";
        print "<td>" . $thisProject->projectName($project["fkProjectId"]) . "</td>";
        print "<td class='center'>" . date("g:i", strtotime($thisProject->projectTime($project["fkProjectId"])));
        print " : " . $thisProject->projectTableNumber($project["fkProjectId"]) . "</td>";
        print "<td>" . $thisProject->projectMembers($project["fkProjectId"]) . "</td>";

        print "</tr>\n";
    }
    print "</table>\n";

//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^
// get top five faculty and staff projects
    $sql = 'SELECT count( * ) AS votes, fkProjectId ';
    $sql .= 'FROM tblVotes ';
    $sql .= 'WHERE fldType = "CSFac" ';
//    $sql .= 'OR fldType = "Other" ';
    $sql .= 'GROUP BY fkProjectId ';
    $sql .= 'ORDER BY votes DESC ';
    $sql .= 'LIMIT 5';

    if ($debug)
        print "<p>Faculty Staff " . $sql;

    $results = $thisDatabase->select($sql);
    if ($debug) {
        print "<p>FS top five: <pre>";
        print_r($results);
        print "</pre>";
    }

    print "<h2>Facutly and Staff  Votes - Top Five</h2>";
    print "<table>\n";
    print "<tr><th>Total Votes</th><th>Project Name</th><th>Time Slot : Table Number</th><th>Group Memebers</th>\n";
    foreach ($results as $project) {
        print "<tr>\n";
        print "<td class='center'>" . $project["votes"] . "</td>";
        print "<td>" . $thisProject->projectName($project["fkProjectId"]) . "</td>";
        print "<td class='center'>" . date("g:i", strtotime($thisProject->projectTime($project["fkProjectId"])));
        print " : " . $thisProject->projectTableNumber($project["fkProjectId"]) . "</td>";
        print "<td>" . $thisProject->projectMembers($project["fkProjectId"]) . "</td>";
        print "</tr>\n";
    }
    print "</table>\n";


//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^
// get top five best this category  
    $sql = 'SELECT count( * ) AS votes, fkProjectId ';
    $sql .= 'FROM tblVotes, tblProject  ';
    $sql .= 'WHERE pkProjectID=fkProjectId ';
    $sql .= 'AND fldCategory="Advanced Projects" ';
    $sql .= 'AND fldType != "Invalid" ';
    $sql .= 'GROUP BY fkProjectId ';
    $sql .= 'ORDER BY votes DESC ';
    $sql .= 'LIMIT 5';

    if ($debug)
        print "<p>Advanced Projects " . $sql;

    $results = $thisDatabase->select($sql);
    if ($debug) {
        print "<p>Advanced Projects top five: <pre>";
        print_r($results);
        print "</pre>";
    }

    print "<h2>Top Five Best in Advanced Projects</h2>";
    print "<table>\n";
    print "<tr><th>Total Votes</th><th>Project Name</th><th>Time Slot : Table Number</th><th>Group Memebers</th>\n";
    foreach ($results as $project) {
        print "<tr>\n";
        print "<td class='center'>" . $project["votes"] . "</td>";
        print "<td>" . $thisProject->projectName($project["fkProjectId"]) . "</td>";
        print "<td class='center'>" . date("g:i", strtotime($thisProject->projectTime($project["fkProjectId"])));
        print " : " . $thisProject->projectTableNumber($project["fkProjectId"]) . "</td>";
        print "<td>" . $thisProject->projectMembers($project["fkProjectId"]) . "</td>";
        print "</tr>\n";
    }
    print "</table>\n";



//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^
// get top five best this category  
    $sql = 'SELECT count( * ) AS votes, fkProjectId ';
    $sql .= 'FROM tblVotes, tblProject  ';
    $sql .= 'WHERE pkProjectID=fkProjectId ';
    $sql .= 'AND fldCategory="Intermediate Projects" ';
    $sql .= 'AND fldType != "Invalid" ';
    $sql .= 'GROUP BY fkProjectId ';
    $sql .= 'ORDER BY votes DESC ';
    $sql .= 'LIMIT 5';

    if ($debug)
        print "<p>Intermediate Projects " . $sql;

    $results = $thisDatabase->select($sql);
    if ($debug) {
        print "<p>Intermediate Projects top five: <pre>";
        print_r($results);
        print "</pre>";
    }

    print "<h2>Top Five Best in Intermediate Projects</h2>";
    print "<table>\n";
    print "<tr><th>Total Votes</th><th>Project Name</th><th>Time Slot : Table Number</th><th>Group Memebers</th>\n";
    foreach ($results as $project) {
        print "<tr>\n";
        print "<td class='center'>" . $project["votes"] . "</td>";
        print "<td>" . $thisProject->projectName($project["fkProjectId"]) . "</td>";
        print "<td class='center'>" . date("g:i", strtotime($thisProject->projectTime($project["fkProjectId"])));
        print " : " . $thisProject->projectTableNumber($project["fkProjectId"]) . "</td>";
        print "<td>" . $thisProject->projectMembers($project["fkProjectId"]) . "</td>";
        print "</tr>\n";
    }
    print "</table>\n";







//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^
// get top five best this category  
    $sql = 'SELECT count( * ) AS votes, fkProjectId ';
    $sql .= 'FROM tblVotes, tblProject  ';
    $sql .= 'WHERE pkProjectID=fkProjectId ';
    $sql .= 'AND fldCategory="Intermediate Web Design" ';
    $sql .= 'AND fldType != "Invalid" ';
    $sql .= 'GROUP BY fkProjectId ';
    $sql .= 'ORDER BY votes DESC ';
    $sql .= 'LIMIT 5';

    if ($debug)
        print "<p>Intermediate Web Design " . $sql;

    $results = $thisDatabase->select($sql);
    if ($debug) {
        print "<p>Intermediate Web Design top five: <pre>";
        print_r($results);
        print "</pre>";
    }

    print "<h2>Top Five Best in Intermediate Web Design</h2>";
    print "<table>\n";
    print "<tr><th>Total Votes</th><th>Project Name</th><th>Time Slot : Table Number</th><th>Group Memebers</th>\n";
    foreach ($results as $project) {
        print "<tr>\n";
        print "<td class='center'>" . $project["votes"] . "</td>";
        print "<td>" . $thisProject->projectName($project["fkProjectId"]) . "</td>";
        print "<td class='center'>" . date("g:i", strtotime($thisProject->projectTime($project["fkProjectId"])));
        print " : " . $thisProject->projectTableNumber($project["fkProjectId"]) . "</td>";
        print "<td>" . $thisProject->projectMembers($project["fkProjectId"]) . "</td>";
        print "</tr>\n";
    }
    print "</table>\n";







//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^
// get top five best this category  
    $sql = 'SELECT count( * ) AS votes, fkProjectId ';
    $sql .= 'FROM tblVotes, tblProject  ';
    $sql .= 'WHERE pkProjectID=fkProjectId ';
    $sql .= 'AND fldCategory="Beginner Programming" ';
    $sql .= 'AND fldType != "Invalid" ';
    $sql .= 'GROUP BY fkProjectId ';
    $sql .= 'ORDER BY votes DESC ';
    $sql .= 'LIMIT 5';

    if ($debug)
        print "<p>Beginner Programming " . $sql;

    $results = $thisDatabase->select($sql);
    if ($debug) {
        print "<p>Beginner Programming top five: <pre>";
        print_r($results);
        print "</pre>";
    }

    print "<h2>Top Five Best in Beginner Programming</h2>";
    print "<table>\n";
    print "<tr><th>Total Votes</th><th>Project Name</th><th>Time Slot : Table Number</th><th>Group Memebers</th>\n";
    foreach ($results as $project) {
        print "<tr>\n";
        print "<td class='center'>" . $project["votes"] . "</td>";
        print "<td>" . $thisProject->projectName($project["fkProjectId"]) . "</td>";
        print "<td class='center'>" . date("g:i", strtotime($thisProject->projectTime($project["fkProjectId"])));
        print " : " . $thisProject->projectTableNumber($project["fkProjectId"]) . "</td>";
        print "<td>" . $thisProject->projectMembers($project["fkProjectId"]) . "</td>";
        print "</tr>\n";
    }
    print "</table>\n";





//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^
// get top five best this category  
    $sql = 'SELECT count( * ) AS votes, fkProjectId ';
    $sql .= 'FROM tblVotes, tblProject  ';
    $sql .= 'WHERE pkProjectID=fkProjectId ';
    $sql .= 'AND fldCategory="Beginner Web Design" ';
    $sql .= 'AND fldType != "Invalid" ';
    $sql .= 'GROUP BY fkProjectId ';
    $sql .= 'ORDER BY votes DESC ';
    $sql .= 'LIMIT 5';

    if ($debug)
        print "<p>Beginner Web Design " . $sql;

    $results = $thisDatabase->select($sql);
    if ($debug) {
        print "<p>Beginner Web Design top five: <pre>";
        print_r($results);
        print "</pre>";
    }

    print "<h2>Top Five Best in Beginner Web Design</h2>";
    print "<table>\n";
    print "<tr><th>Total Votes</th><th>Project Name</th><th>Time Slot : Table Number</th><th>Group Memebers</th>\n";
    foreach ($results as $project) {
        print "<tr>\n";
        print "<td class='center'>" . $project["votes"] . "</td>";
        print "<td>" . $thisProject->projectName($project["fkProjectId"]) . "</td>";
        print "<td class='center'>" . date("g:i", strtotime($thisProject->projectTime($project["fkProjectId"])));
        print " : " . $thisProject->projectTableNumber($project["fkProjectId"]) . "</td>";
        print "<td>" . $thisProject->projectMembers($project["fkProjectId"]) . "</td>";
        print "</tr>\n";
    }
    print "</table>\n";







    /*

      //%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^
      // get top five best this hour
      $sql  = 'SELECT count( * ) AS votes, fkProjectId ';
      $sql .= 'FROM tblVotes, tblProject  ';
      $sql .= 'WHERE pkProjectID=fkProjectId ';
      $sql .= 'AND fldPresentationTimeSlot="2014-12-01 12:50:00" ';
      $sql .= 'GROUP BY fkProjectId ';
      $sql .= 'ORDER BY votes DESC ';
      $sql .= 'LIMIT 5';

      if($debug) print "<p>time hour 12:50 " . $sql;

      $results = $thisDatabase->select($sql);
      if ($debug) {
      print "<p>th12 top five: <pre>";
      print_r($results);
      print "</pre>";
      }

      print "<h2>Top Five Best in 12:50 Time Slot</h2>";
      print "<table>\n";
      print "<tr><th>Total Votes</th><th>Project Name</th><th>Time Slot : Table Number</th><th>Group Memebers</th>\n";
      foreach($results as $project){
      print "<tr>\n";
      print "<td class='center'>" . $project["votes"] . "</td>";
      print "<td>" . $thisProject->projectName($project["fkProjectId"]) . "</td>";
      print "<td class='center'>" . date("g:i", strtotime($thisProject->projectTime($project["fkProjectId"])));
      print " : " . $thisProject->projectTableNumber($project["fkProjectId"]) . "</td>";
      print "<td>" . $thisProject->projectMembers($project["fkProjectId"]) . "</td>";
      print "</tr>\n";
      }
      print "</table>\n";



      //%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^
      // get top five best this hour
      $sql  = 'SELECT count( * ) AS votes, fkProjectId ';
      $sql .= 'FROM tblVotes, tblProject  ';
      $sql .= 'WHERE pkProjectID=fkProjectId ';
      $sql .= 'AND fldPresentationTimeSlot="2014-12-01 13:55:00" ';
      $sql .= 'GROUP BY fkProjectId ';
      $sql .= 'ORDER BY votes DESC ';
      $sql .= 'LIMIT 5';

      if($debug) print "<p>time hour 1:55 " . $sql;

      $results = $thisDatabase->select($sql);
      if ($debug) {
      print "<p>th1 top five: <pre>";
      print_r($results);
      print "</pre>";
      }

      print "<h2>Top Five Best in 1:55 Time Slot</h2>";
      print "<table>\n";
      print "<tr><th>Total Votes</th><th>Project Name</th><th>Time Slot : Table Number</th><th>Group Memebers</th>\n";
      foreach($results as $project){
      print "<tr>\n";
      print "<td class='center'>" . $project["votes"] . "</td>";
      print "<td>" . $thisProject->projectName($project["fkProjectId"]) . "</td>";
      print "<td class='center'>" . date("g:i", strtotime($thisProject->projectTime($project["fkProjectId"])));
      print " : " . $thisProject->projectTableNumber($project["fkProjectId"]) . "</td>";
      print "<td>" . $thisProject->projectMembers($project["fkProjectId"]) . "</td>";
      print "</tr>\n";
      }
      print "</table>\n";



      //%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^
      // get top five best this hour
      $sql  = 'SELECT count( * ) AS votes, fkProjectId ';
      $sql .= 'FROM tblVotes, tblProject  ';
      $sql .= 'WHERE pkProjectID=fkProjectId ';
      $sql .= 'AND fldPresentationTimeSlot="2014-12-01 15:00:00" ';
      $sql .= 'GROUP BY fkProjectId ';
      $sql .= 'ORDER BY votes DESC ';
      $sql .= 'LIMIT 5';

      if($debug) print "<p>time hour 3:00 " . $sql;

      $results = $thisDatabase->select($sql);
      if ($debug) {
      print "<p>th3 top five: <pre>";
      print_r($results);
      print "</pre>";
      }

      print "<h2>Top Five Best in 3:00 Time Slot</h2>";
      print "<table>\n";
      print "<tr><th>Total Votes</th><th>Project Name</th><th>Time Slot : Table Number</th><th>Group Memebers</th>\n";
      foreach($results as $project){
      print "<tr>\n";
      print "<td class='center'>" . $project["votes"] . "</td>";
      print "<td>" . $thisProject->projectName($project["fkProjectId"]) . "</td>";
      print "<td class='center'>" . date("g:i", strtotime($thisProject->projectTime($project["fkProjectId"])));
      print " : " . $thisProject->projectTableNumber($project["fkProjectId"]) . "</td>";
      print "<td>" . $thisProject->projectMembers($project["fkProjectId"]) . "</td>";
      print "</tr>\n";
      }
      print "</table>\n";
     * 
     */
    print '</section> <!-- id main -->';
} else {

    print "<p>Results are not available at this time</p>";
}
include "../footer.php";
?>
