<?php
 
class DbOperation
{
    private $con;
 
    function __construct()
    {
        require_once dirname(__FILE__) . '/DbConnect.php';
        $db = new DbConnect();
        $this->con = $db->connect();
    }

	//adding a record to database 
	public function insertDeptDetails($nm, $unm, $pwd){
		
		$result = $this->getDeptDetails($unm,$pwd);
		if($result == 0)
		{
			$stmt = $this->con->prepare("INSERT INTO `dept_details`(`dname`, `duname`, `dpwd`) VALUES (?, ?, ?)");
			$stmt->bind_param("sss", $nm, $unm, $pwd);
			if($stmt->execute())
				return true; 
			return false; 
		}
		else{
			return 0;
		}
	}
	
	//fetching all records from the database 
	public function getDeptDetails($nm,$pwd){
		$stmt = $this->con->prepare("SELECT * FROM `dept_details` WHERE `duname`='$nm' AND `dpwd`='$pwd'");
		$result = $stmt->execute();
		$result = $stmt->fetch();
		return $result; 
	}
	
	public function changePassword($old,$new){
		
		$sql = "UPDATE `dept_details` SET `dpwd`='$new' WHERE dpwd='$old'"; 
		$stmt = $this->con->prepare($sql); 
		$stmt->bind_param("ss", $nm,$pwd);
		if($stmt->execute())
				return true; 
		return false;
	}
	
	public function insertResDetails($rnm,$rqty,$rpr,$rbd){
		
		/*$result = $this->getDeptDetails($unm,$pwd);
		if($result == 0)
		{*/
			$newDate   =   date("Y-m-d", strtotime($rbd));
			$stmt = $this->con->prepare("INSERT INTO `res_details`( `rname`, `rqty`, `rprice`, `rbuydate`) VALUES (?, ?, ?,?)");
			$stmt->bind_param("ssss", $rnm,$rqty,$rpr,$newDate);
			if($stmt->execute())
				return true; 
			return false; 
		/*}
		else{
			return 0;
		}*/
	}
	
	 function insertRoomDetails($roname,$rodes)
    {
        $q='';
        $stmt = $this->con->prepare("INSERT INTO `room_details`( `roname`, `rodesc`) VALUES (?,?)");
        $stmt->bind_param('ss', $roname,$rodes);
        if($r = $stmt->execute())
			return true;
        return false;
    }
}