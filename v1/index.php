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
					if($record == 1){
							
						$response['error'] = false;
						$response['message'] = 'Department register successfully';
						
						//$response = $record;
					}else if($record == 0){
							
						$response['error'] = true;
						$response['message'] = 'Department is already register';
						
						//$response = $record;
					}else{
						$response['error'] = true;
						$response['message'] = 'Could not register department';
					}
				
			break; 
			
			//if it is getartist that means we are fetching the records
			case 'getDept':
				$db = new DbOperation();
				$dept1 = $db->getDeptDetails($_REQUEST['duname'],$_REQUEST['dpwd']);
				
				if($dept1 == 1){
					$response['error'] = false; 
					$response['message'] = 'login successful';
				}else
				{
					$response['error'] = true; 
					$response['message'] = 'username or password is incorrect';
				}
			break; 
			
			case 'chnage':
				
					$db = new DbOperation(); 
					$record=$db->changePassword($_REQUEST['old_pwd'], $_REQUEST['new_pwd']);
					if(count($record)>0){
							
						$response['error'] = false;
						$response['message'] = 'Password change successfully';
						
					}else{
						$response['error'] = true;
						$response['message'] = 'Could not change Password';
					}
				
			break; 
			
			case 'addRes':
				
					$db = new DbOperation(); 
					$record=$db->insertResDetails($_REQUEST['resname'],$_REQUEST['resqty'],$_REQUEST['resprice'], $_REQUEST['resbuydate']);
					if(count($record)>0){
							
						$response['error'] = false;
						$response['message'] = 'resources added successfully';
						
					}else{
						$response['error'] = true;
						$response['message'] = 'Could not add resources';
					}
				
			break; 
			
			case 'addRoom':
				
					$db = new DbOperation(); 
					$record=$db->insertRoomDetails($_REQUEST['roomname'],$_REQUEST['roomdesc']);
					if(count($record)>0){
							
						$response['error'] = false;
						$response['message'] = 'room added successfully';
						
					}else{
						$response['error'] = true;
						$response['message'] = 'Could not add room';
					}
				
			break; 
			
			default:
				$response['error'] = true;
				$response['message'] = 'Invalid Request';
			
		}
		
	}else{
		$response['error'] = false; 
		$response['message'] = 'Invalid Request';
	}
	
	//displaying the data in json 
	echo json_encode($response);