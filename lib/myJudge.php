<?php
class myJudge{

    var $db;
    public function __construct($db){
       $this->db = $db;       
    }

    
    //############################################################################
    function judgeFound($judgeCode, $id) {
        if (empty($judgeCode)) return ""; 
        if (empty($id)) return ""; 

        global $debug;

        $output = "";

        $sql = "SELECT pkJudgeId ";
        $sql .= "FROM tblJudge ";
        $sql .= "WHERE fldJudgeCode = ? ";
        $sql .= "AND fkSponsorId = ? ";


        if($debug) echo "<p>" . $sql . $judgeCode . " " . $id;

        $results = $this->db->select($sql, array($judgeCode, $id));
        
        if($results[0]["pkJudgeId"]>0){
            return true;
        }else{
            return false;
        }
    }


}
?>