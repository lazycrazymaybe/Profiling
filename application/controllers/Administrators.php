<?php 

	class Administrators extends CI_Controller{

		function __construct(){
			parent:: __construct();
			$this->load->model("Administrator");
			date_default_timezone_set('Asia/Manila');
		}

		function trial(){
			echo uniqid(rand(), TRUE). '<br>';
			echo $_SERVER['REMOTE_ADDR'];
		}

		/**
			@description This will create new user in the system. Used by ajax functionality.
		*/
		public function createUser(){
			if ($_POST){
				//Cleans the inputs
				$fname = ucwords(strtolower(trim($this->input->post('fname'))));
				$lname = ucwords(strtolower(trim($this->input->post('lname'))));
				$username = strtolower(trim($this->input->post('username')));
				//Sets up for saving
				$form_data = array(
										 'fname'=>$fname,
										 'lname'=>$lname,
										 'mname'=>ucfirst(strtolower(trim($this->input->post('mname')))),
										 'phone'=>trim($this->input->post('contact_number')),
										 'username'=>$username,
										 'password'=>md5(sha1('123')),
										 'type'=>$this->input->post('userType'),
										 'isactive'=>intval($this->input->post('isActive')),
				);
				$response = $this->Administrator->createUser($form_data,$fname,$lname,$username);
				echo $response;
			}
		}

		/**
			@description Fetch single user. Use by ajax.
		*/
		public function fetchUser(){
			$cather = $this->Administrator->fetchUser($_POST['empID']);
			$data['empID'] = $cather->empID;
			$data['fname'] = $cather->fname;
			$data['lname'] = $cather->lname;
			$data['mname'] = $cather->mname;
			$data['username'] = $cather->username;
			$data['contact_number'] = $cather->phone;
			$data['userType'] = $cather->type;
			$data['isActive'] = $cather->isactive;
			$data['password'] = $cather->password;
			$data['date'] = $cather->date;
			echo json_encode($data);
		}

		/**
			@description Update user. Use by ajax.
		*/
		public function updateUser(){
			if ($_POST) {
				$password = "";
				$empID = $this->input->post('empID');
				$fname = ucwords(strtolower(trim($this->input->post('fname'))));
				$lname = ucwords(strtolower(trim($this->input->post('lname'))));
				$username = strtolower(trim($this->input->post('username')));
				//Conditions to see if the password is reseted or if it is still the same
				if($this->input->post('password') == '123'){
					$password = md5(sha1('123'));
				}else{
					$password = $this->input->post('password');
				}
				if($this->input->post('password1') != ''){
					$password = md5(sha1($this->input->post('password1')));
				}
				$form_data = array(
										 'fname'=>$fname,
										 'lname'=>$lname,
										 'mname'=>ucwords(strtolower(trim($this->input->post('mname')))),
										 'phone'=>trim($this->input->post('contact_number')),
										 'username'=>$username,
										 'password'=>$password,
										 'type'=>$this->input->post('userType'),
										 'isactive'=>$this->input->post('isActive'),
										 'date'=>$this->input->post('date')

				);
				$user = $this->Administrator->fetchUser($empID);
				//Condition to check for duplicate username entry
				if($user->fname == $fname && $user->lname == $lname){
					if($user->username == $username){
						$this->Administrator->updateUser($empID,$form_data);
						echo "updated";
					}else{
						if($this->Administrator->usernameTraper($username) == true){
							echo "username";
						}else{
							$this->Administrator->updateUser($empID,$form_data);
							echo "updated";
						}
					}
				//Check for duplicate name entry
				}else{
					if($this->Administrator->nameTraper($fname,$lname) == true){
						echo "person";
					}else{
						if($user->username == $username){
							$this->Administrator->updateUser($empID,$form_data);
							echo "updated";
						}else{
							if($this->Administrator->usernameTraper($username) == true){
								echo "username";
							}else{
								$this->Administrator->updateUser($empID,$form_data);
								echo "updated";
							}
						}
					}
				}
			}
		}

		/**
			@description Gets the list of employee list in the database. Depends on model condition
		*/
		public function ajaxEmployeeList(){
			$holder = $this->Administrator->dataTablesEployees();
			$data = array();
			//Sets up for datatables.
			foreach ($holder as $value) {
				if($value['empID'] != $this->session->userdata('empID')){
					$sub_array = array();
					$sub_array[] = $value['empID'];
					$sub_array[] = $value['lname'].', '.$value['fname']." ".substr($value['mname'], 0,1);
					$sub_array[] = $value['username'];
					$sub_array[] = $value['phone'];
					$sub_array[] = date('Y-m-d h:i A',strtotime($value['date']));
					$sub_array[] = $value['type'];
					if($value['isactive'] == 1){
						$sub_array[] = '<span class="label label-success">Active</span>';
					}else{
						$sub_array[] = '<span class="label label-danger">Deactivated</span>';
					}
					if($this->session->userdata('type') == 'Admin'){
						$sub_array[] = '<button type="button" data-toggle="modal" data-target="#edit-data" class="btn btn-primary edit-data" id="'.$value['empID'].'" style="margin-left:-6px;"><i class="fa fa-edit"></i></button>';
					}else{
						$sub_array[] = '<button type="button" data-toggle="modal" data-target="#edit-data" class="btn btn-primary edit-data" id="'.$value['empID'].'" style="margin-left:-6px;" disabled><i class="fa fa-edit"></i></button>';
					}
					$data[] = $sub_array;
				}
			}
			//Sets the out put according to datatables set of pre-defined variables
			$output = array(  
	            "draw"=>intval($_POST["draw"]),  
	            "recordsTotal"=>($this->Administrator->getAllDataEmployees()-1),  
	            "recordsFiltered"=>($this->Administrator->filteredDataEmployees()-1),  
	            "data"=>$data  
		    );  
		    // echo the result for rendering
		    echo json_encode($output);
		}

		/**
			@description Gets profiles data in the database. Depends on model condition
		*/
		public function ajaxProfileList(){
			$holder = $this->Administrator->dataTablesProfiles();
			$data = array();
			$filtered = $this->Administrator->filteredDataProfiles();
			//Sets up for datatables
			foreach ($holder as $value) {
				$sub_array = array();
				$sub_array[] = $value['lname'].', '.$value['fname']." ".substr($value['mname'], 0,1);
				$sub_array[] = $value['birth'];
				$sub_array[] = $value['gender'];
				$sub_array[] = ucwords(strtolower($value['sitio'].', '.$value['brgy']));
				$sub_array[] = $value['bhw'];
				$sub_array[] = '<a href='.base_url().'Routes/udpateProfilePage/'.$value['profileID'].' class=""><button type="button" class="btn btn-primary" id="'.$value['profileID'].'" style="margin-left:-6px;"><i class="fa fa-edit"></i></button></a>

					<a href='.base_url().'Routes/casePage/'.$value['profileID'].' class=""><button type="button" class="btn btn-success" id="'.$value['profileID'].'" style="margin-left:-3px;"><i class="fa fa-list-alt"></i></button></a>

					<button type="button" class="btn btn-danger remove_confirmation" id="'.$value['profileID'].'"><i class="fa fa-remove"></i></button>';
				$data[] = $sub_array;
			}
			$output = array(  
	            "draw"=>intval($_POST["draw"]),  
	            "recordsTotal"=>$this->Administrator->getAllDataProfiles(),  
	            "recordsFiltered"=>$filtered,  
	            "data"=>$data  
      		);  
      		echo json_encode($output);
		}

		/**
			@description Gets all removed profile in the database.
		*/
		public function ajaxRemovedProfileList(){
			$holder = $this->Administrator->dataTablesRemovedProfiles();
			$data = array();
			$filtered = $this->Administrator->filteredDataRemovedProfiles();
			foreach ($holder as $value) {
				$sub_array = array();
				$sub_array[] = $value['lname'].', '.$value['fname']." ".substr($value['mname'], 0,1);
				$sub_array[] = $value['birth'];
				$sub_array[] = $value['gender'];
				$sub_array[] = ucwords(strtolower($value['sitio'].', '.$value['brgy']));
				$sub_array[] = $value['bhw'];
				$sub_array[] = '<button type="button" class="btn btn-danger delete_confirmation" id="'.$value['profileID'].'" style="margin-left:-6px;"><i class="fa fa-trash"></i></button>
												<button type="button" class="btn btn-success add_confirmation" id="'.$value['profileID'].'"><i class="fa fa-plus"></i></button>';
				$data[] = $sub_array;
			}
			$output = array(  
	            "draw"=>intval($_POST["draw"]),  
	            "recordsTotal"=>$this->Administrator->getAllDataRemovedProfiles(),  
	            "recordsFiltered"=>$filtered,  
	            "data"=>$data  
      		);  
      		echo json_encode($output);
		}

		/**
			@description Use to disable or enable profile
		*/
		public function disableEnableProfile(){
			if ($_POST) {
				$isactive = 0;
				$profileID = $_POST['profileID'];
				$cather = $this->Administrator->fetchProfile($profileID);
				$date = $cather->date;
				if($cather->isactive == 1){
					$isactive = 0;
				}else{
					$isactive = 1;
				}
				$form_data = array(
							 'isactive'=>$isactive,
							 'date'=>$date
				);
				$checker = $this->Administrator->disableEnableProfile($form_data,$profileID);
				if($checker > 0){
					echo "success";
				}else{
					echo "error";
				}
			}
		}

		/**
			@description Totally remove profile to the database.
		*/
		public function deleteProfile(){
			if ($_POST) {
				$profileID = $_POST['profileID'];
				$this->Administrator->deleteProfile($profileID);
				$this->Administrator->deleteAddress($profileID);
				$this->Administrator->deleteFamilyMember($profileID);
				echo "success";
			}
		}

		/**
			@description Totally remove a case to the database.
		*/
		public function removeCase(){
			if ($_POST) {
				$profileID = $_POST['profileID'];
				$caseID = $_POST['caseID'];
				$this->Administrator->removeCase($caseID);
				echo base_url()."Routes/casePage/".$profileID;
			}
		}

		/**
			@description Adds a case for a particular person.
		*/
		public function addCase(){
			if ($_POST) {
				$form_data = array(
							 'profileID'=>$this->input->post('profileID'),
							 'caseTitle'=>ucwords(strtolower(trim($this->input->post('ctitle')))),
							 'byWhome'=>ucwords(strtolower(trim($this->input->post('cwhome')))),
							 'lupon'=>ucwords(strtolower(trim($this->input->post('clupon')))),
							 'status'=>$this->input->post('cstatus'),
							 'date'=>$this->input->post('cdate'),
							 'description'=>$this->input->post('cdescription'),
				);
				$return = $this->Administrator->addCase($form_data);
				if($return > 0){
					echo base_url()."Routes/casePage/".$this->input->post('profileID');
				}else{
					echo "error";
				}
			}
		}

		/**
			@description Change case status. 
		*/
		public function changeStatus($caseID){
			$data = $this->Administrator->fetchCase($caseID);
			$form_data = array(
					'status'=>"Served"
			);
			$this->Administrator->updateCase($caseID,$form_data);
			redirect(base_url()."Routes/casePage/".$data[0]->profileID);
		}

		/**
			@description Updates case.
		*/
		public function updateCase(){
			$form_data = array(
							 'profileID'=>$this->input->post('profileID'),
							 'caseTitle'=>ucwords(strtolower(trim($this->input->post('ctitle')))),
							 'byWhome'=>ucwords(strtolower(trim($this->input->post('cwhome')))),
							 'lupon'=>ucwords(strtolower(trim($this->input->post('clupon')))),
							 'status'=>$this->input->post('cstatus'),
							 'date'=>$this->input->post('cdate'),
							 'description'=>$this->input->post('cdescription'),
				);
			$return = $this->Administrator->updateCase($this->input->post('caseID'),$form_data);
			if($return > 0){
				echo base_url()."Routes/casePage/".$this->input->post('profileID');
			}else{
				echo "error";
			}
		}
		
		/**
			@description Add New Profile to the database
		*/
		public function addProfile(){
			$data['success'] = 0;
			$data['error'] = 0;
			if($_POST){
				$form_data = $this->staging();
				//Cleans the input before sending to the database.
				$insert_id = $this->Administrator->addProfile($form_data[0],$form_data[1],$form_data[2],$form_data[3],$form_data[4]);
				//Insert data to the address table parallel to the users data.
				if($insert_id > 0){
					$form_data = array(
											 'profileID'=>$insert_id,
											 'region'=>$this->input->post('region'),
											 'province'=>$this->input->post('province'),
											 'city'=>$this->input->post('city'),
											 'sitio'=>strtoupper(trim($this->input->post('sitio'))),
											 'brgy'=>strtoupper(trim($this->input->post('barangay')))
					);
					$insert_id1 = $this->Administrator->addAddress($form_data);
					//Inssert data to the family member table parallel to the users data.
					if($insert_id1){
						if(isset($_POST['name'])){
							for($count = 0; $count < count($_POST['name']); $count++){
								if($_POST['name'][$count] != '' && $_POST['relationship'][$count] != ''){
									$form_data = array(
											 'profileID'=>$insert_id,
											 'name'=>ucwords(strtolower(trim($_POST['name'][$count]))),
											 'relation'=>$_POST['relationship'][$count]
									);
									$this->Administrator->addFamilyMember($form_data);
								}
							}
						}
					
					}
					echo base_url().'Routes/profiles';
				}else{
					echo "error";
				}
			}
		}

			/**
				*@return String
				*@usage Use to update certain profile.
			*/
		public function updateProfile(){
			$data['success'] = 0;
			$data['error'] = 0;
			if($_POST){
				$profileID = $this->input->post('profileID');
				$form_data = $this->staging();
				$update_reponse = $this->Administrator->updateProfile($form_data[0],$profileID,$form_data[1],$form_data[2],$form_data[3],$form_data[4]);
				if($update_reponse > 0){
					$form_data = array(
											 'profileID'=>$profileID,
											 'region'=>$this->input->post('region'),
											 'province'=>$this->input->post('province'),
											 'city'=>$this->input->post('city'),
											 'sitio'=>strtoupper(trim($this->input->post('sitio'))),
											 'brgy'=>strtoupper(trim($this->input->post('barangay')))
					);
					$insert_id1 = $this->Administrator->updateAddress($form_data,$profileID);
					if($insert_id1){
						if(isset($_POST['name'])){
							$familyMembers = $this->Administrator->fetchFamilyMember($profileID);
							for($count = 0; $count < count($_POST['name']); $count++){
								if($_POST['name'][$count] != '' && $_POST['relationship'][$count] != ''){
									if(count($familyMembers) != 0){
										foreach ($familyMembers as $value) {
											if(in_array(intval($value->fmemberID), $_POST['fmemberID']) == false){
												$this->Administrator->deleteFamilyMember2($value->fmemberID);
											}
										}
									}
									$name = ucwords(strtolower(trim($_POST['name'][$count])));
									$relation = $_POST['relationship'][$count];
									$form_data = array(
											 'profileID'=>$profileID,
											 'name'=>$name,
											 'relation'=>$relation
									);
									if(isset($_POST['fmemberID'])){
										if($count < count($_POST['fmemberID'])){
											$this->Administrator->updateFamilyMember($form_data,$_POST['fmemberID'][$count]);
										}else{
											$this->Administrator->addFamilyMember($form_data);
										}
									}else{
										$this->Administrator->addFamilyMember($form_data);
									}
								}
							}
						}else{
							$familyMembers = $this->Administrator->fetchFamilyMember($profileID);
							foreach ($familyMembers as $value) {
									$this->Administrator->deleteFamilyMember2($value->fmemberID);
								}
							}
					}
					echo base_url().'Routes/profiles';
				}else{
					echo "error";
				}
			}
		}

		/**
			*@param String
			*@return String
			*@usage Use to auto fill fields that are not filled when the form is submitted.
		*/
		private function fieldCheckerString($var){
			return $var == '' ? 'N/A' : $var;
		}

		/**
			*@param String
			*@return String
			*@usage Use to auto fill fields that are not filled when the form is submitted.
		*/
		private function fieldCheckerInt($var){
			return $var == '' ? '0' : $var;
		}

		/**
			*@return Array
			@usage Catches all the post input from adding or updating a profile info.
		*/
		private function staging(){
			$name_extension = $this->fieldCheckerString($this->input->post('name_extension'));
			$vin = $this->fieldCheckerString($this->input->post('vin'));
			$no_siblings = $this->fieldCheckerInt($this->input->post('no_siblings'));
			$present_address = $this->fieldCheckerString($this->input->post('present_address'));
			$spouse = $this->fieldCheckerString($this->input->post('spouse'));
			$occupation = $this->fieldCheckerString($this->input->post('occupation'));
			$mother = $this->fieldCheckerString($this->input->post('mother'));
			$mother_occupation = $this->fieldCheckerString($this->input->post('mother_occupation'));
			$father = $this->fieldCheckerString($this->input->post('occupation'));
			$father_occupation = $this->fieldCheckerString($this->input->post('occupation'));
			$no_children = $this->fieldCheckerInt($this->input->post('no_children'));
			$firstName = ucwords(strtolower(trim($this->input->post('firstName'))));
			$lastName = ucwords(strtolower(trim($this->input->post('lastName'))));
			$middleName = ucwords(strtolower(trim($this->input->post('middleName'))));
			$confirm = $this->input->post('yes_no');
			$form_data = array(
					 'isactive'=>1,
					 'fname'=>$firstName,
					 'lname'=>$lastName,
					 'mname'=>$middleName,
					 'extension'=>ucfirst(strtolower(trim($name_extension))),
					 'birth'=>$this->input->post('dob'),
					 'gender'=>$this->input->post('gender'),
					 'pob'=>ucwords(strtolower(trim($this->input->post('pob')))),
					 'civilstatus'=>$this->input->post('civil_status'),
					 'profession'=>ucwords(strtolower(trim($occupation))),
					 'mother'=>ucwords(strtolower(trim($mother))),
					 'occupationm'=>ucwords(strtolower(trim($mother_occupation))),
					 'father'=>ucwords(strtolower(trim($father))),
					 'occupationf'=>ucwords(strtolower(trim($father_occupation))),
					 'presadd'=>ucwords(strtolower(trim($present_address))),
					 'nos'=>intval($no_siblings),
					 'noc'=>intval($no_children),
					 'spouse'=>ucwords(strtolower(trim($spouse))),
					 'bhw'=>ucwords(strtolower(trim($this->input->post('bhw')))),
					 'vin'=>trim($vin),
					 'comstat'=>$this->input->post('comelect_status'),
			);
			return [$form_data,$firstName,$lastName,$middleName,$confirm];
		}

	}

?>