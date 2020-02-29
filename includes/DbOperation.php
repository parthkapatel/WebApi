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
		$stmt = $this->con->prepare("INSERT INTO `dept_details`(`dname`, `duname`, `dpwd`) VALUES (?, ?, ?)");
		$stmt->bind_param("sss", $nm, $unm, $pwd);
		if($stmt->execute())
			return true; 
		return false; 
	}
	
	//fetching all records from the database 
	public function getDeptDetails($Session_id){
		$stmt = $this->con->prepare("SELECT `did`, `dname`, `duname` FROM `dept_details` WHERE `did`=".$Session_id);
		$stmt->execute();
		$stmt->bind_result($did, $dname, $duname);
		$dept = array();
		
		while($stmt->fetch()){
			$temp = array(); 
			$temp['id'] = $did; 
			$temp['name'] = $dname; 
			$temp['uname'] = $duname; 
			array_push($dept, $temp);
		}
		return $dept; 
	}
}