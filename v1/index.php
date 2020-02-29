<?php 
	
	//adding dboperation file 
	require_once '../includes/DbOperation.php';
	
	//response array 
	$response = array(); 
	
	//if a get parameter named op is set we will consider it as an api call 
	if(isset($_REQUEST['op'])){
		
		//switching the get op value 
		switch($_REQUEST['op']){
			
			//if it is add Department 
			//that means we will add an Department 
			case 'addDept':
				
					$db = new DbOperation(); 
					$record=$db->insertDeptDetails($_REQUEST['dname'], $_REQUEST['duname'], $_REQUEST['dpwd']);
					if($record){
							
							//$response['error'] = false;
						//$response['message'] = 'Department added successfully';
						
						$response = $record;
					}else{
						$response['error'] = true;
						$response['message'] = 'Could not add Department';
					}
				
			break; 
			
			//if it is getartist that means we are fetching the records
			case 'getDept':
				$db = new DbOperation();
				$dept = $db->getDeptDetails($_GET['session_id']);
				if(count($dept)<=0){
					$response['error'] = true; 
					$response['message'] = 'Nothing found in the database';
				}else{
					$response['error'] = false; 
					$response['dept'] = $dept;
				}
			break; 
			
			default:
				$response['error'] = true;
				$response['message'] = 'No operation to perform';
			
		}
		
	}else{
		$response['error'] = false; 
		$response['message'] = 'Invalid Request';
	}
	
	//displaying the data in json 
	echo json_encode($response);