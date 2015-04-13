<?php
class myProject{

//############################################################################
function projectMembers($id) {
    if (empty($id)) return ""; 
    
    global $thisDatabase;
    global $debug;
    
    $output = "";
    
    $sql = "SELECT fldFirstName, fldLastName ";
    $sql .= "FROM tblStudent, tblStudentProject ";
    $sql .= "WHERE pkUsername=fkUVMId ";
    $sql .= "AND fkProjectId=" . $id;
    $sql .= " ORDER BY fldOrder";

    if($debug) echo "<p>" . $sql;

    $results = $thisDatabase->select($sql);
    
    $output = "<span class='studentPresentor'>";
    $comma=0;
    foreach($results as $member){  
        if($comma>=1) $output .= ", ";
        $comma++;
        $output .= $member["fldFirstName"] . "&nbsp;" . $member["fldLastName"];
    }
    $output .= "</span> ";
    return $output;
}
//############################################################################
function projectName($id) {
	if (empty($id)) return ""; 
	
	global $thisDatabase;
	global $debug;
        
	$sql  = "SELECT fldProjectName ";
	$sql .= "FROM tblProject ";
	$sql .= "WHERE pkProjectId=" . $id;

	$results = $thisDatabase->select($sql);
	if ($results > 0) {
            $results = $thisDatabase->select($sql);
		return $results[0]['fldProjectName'];
	} else {
		return "";
	}		 
}


//############################################################################
function projectTableNumber($id) {
	if (empty($id)) return "";  
	
	global $thisDatabase;
	global $debug;
        
	$sql  = "SELECT fldProjectBoothNum, fldBoothSide ";
	$sql .= "FROM tblProject ";
	$sql .= "WHERE pkProjectId=" . $id;

	$results = $thisDatabase->select($sql);
	if ($results > 0) {
            $results = $thisDatabase->select($sql);
		return $results[0]['fldProjectBoothNum'] . " - " . $results[0]['fldBoothSide'];
	} else {
		return "";
	}		 
}

//############################################################################
function projectTime($id) {
	if (empty($id)) return ""; 
	
	global $thisDatabase;
	global $debug;
        
	$sql  = "SELECT fldPresentationTimeSlot ";
	$sql .= "FROM tblProject ";
	$sql .= "WHERE pkProjectId=" . $id;

	$results = $thisDatabase->select($sql);
	if ($results > 0) {
            $results = $thisDatabase->select($sql);
		return $results[0]['fldPresentationTimeSlot'];
	} else {
		return "";
	}		 
}


} // end class
	
?>

