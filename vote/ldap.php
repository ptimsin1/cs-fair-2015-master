<?php
function LDAPstatus($uvmID) {
    error_reporting(0);
    
    
    //you need to connect to the ldap server
    $ds = ldap_connect("ldap.uvm.edu");

    //if your connection worked lets get the info we need
    if ($ds) {
        //set up our parameters (no need to change them)
        $r = ldap_bind($ds);

        $dn = "uid=$uvmID,ou=People,dc=uvm,dc=edu";

        $filter = "(|(netid=$uvmID))";
        /* in this array (between the parenthisis you place all the LDAP names you 
          are looking for. You will notice that they are used below as well in the
          print statements.
         */

        $findthese = array("ou", "edupersonaffiliation");

        // now do the search and get the results which are storing in $info
        $sr = ldap_search($ds, $dn, $filter, $findthese);

        // if we found a match (in this example we should actually always find just one
        if (ldap_count_entries($ds, $sr) > 0) {
            $info = ldap_get_entries($ds, $sr);
            for ($k = 0; $k < $info[0]["edupersonaffiliation"]["count"]; $k++) {
		if($info[0]["edupersonaffiliation"][$k]=="Faculty"){
	     		if($info[0]["ou"][0]=="Computer Science"){
    				ldap_close($ds);
				return "CSfac";
	     		}else{
    				ldap_close($ds);
				return "Faculty";	     
	     		}
 		}

		
if($info[0]["edupersonaffiliation"][$k]=="Student"){
    			ldap_close($ds);
			return "Student";
		}
    	    }    	
	    		ldap_close($ds);
		return "Other";

	} else {
            // there is still a warning message before this line prints :(
    	    ldap_close($ds);
            
            return "Invalid";
 
        }
    } else {
        // same here, there is still a warning message before this line prints :(
        ldap_close($ds);

        return "Invalid"; // they had no uvm record
    }

    ldap_close($ds);
    return "Invalid"; // they were found
}
?>
