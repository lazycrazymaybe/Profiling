<?php 

	class Administrators extends CI_Controller{

		function __construct(){
			parent:: __construct();
			$this->load->model("Administrator");
			date_default_timezone_set('Asia/Manila');
		}

		public function trial(){
			$arr = array(1,1,1,1,1,1);
			for($count = 0; $count < count($arr); $count++){
				echo $count;
			}
		}

		public function index(){
			$data['title'] = "Brng. Camaman-an | People Monitoring System";
			$data['success'] = 1;
			if($this->input->post()){
				$username = $this->input->post("username");
				$password = $this->input->post("password");
				$login = $this->Administrator->adminLogin($username,$password);
				if($login){
					$this->session->set_userdata('empID',$login[0]['empID']);
					$this->session->set_userdata('username',$login[0]['username']);
					$this->session->set_userdata('password',$login[0]['password']);
					$this->session->set_userdata('fname',$login[0]['fname']);
					$this->session->set_userdata('lname',$login[0]['lname']);
					$this->session->set_userdata('mname',$login[0]['mname']);
					$this->session->set_userdata('type',$login[0]['type']);
					$this->session->set_userdata('phone',$login[0]['phone']);
					$data['success'] = 1;
					redirect(base_url().'Administrators/dashboard');
				}else{
					$data['success'] = 0;
				}
			}
			$this->load->view('Login',$data);
		}

		public function logout(){
			$this->session->sess_destroy();
			redirect(base_url().'Administrators');
		}

		public function dashboard(){
			$data['title'] = "Dashboard";
			$overViewData = $this->Administrator->adminOverview();
			$data['employees'] = $overViewData['userCounter'];
			$data['admins'] = $overViewData['adminCounter'];
			$data['monthlyInputs'] = $overViewData['monthlyRegs'];
			$data['totalPeople'] = $overViewData['peopleCounter'];
			$data['newRegistrations'] = $this->Administrator->newRegistrations();
			$data['newProfiles'] = $this->Administrator->newProfiles();
			if($this->session->userdata('empID') != null){
				$this->load->view('Header',$data);
				$this->load->view('Dashboard',$data);
				$this->load->view('Footer',$data);
			}else{
				redirect(base_url()."Administrators");
			}
			
		}

		public function employeesList(){
			if($this->session->userdata('empID') != null){
				$data['title'] = "Employee List";
				$this->load->view('Header',$data);
				$this->load->view('Employees',$data);
				$this->load->view('Footer',$data);
			}else{
				redirect(base_url()."Administrators");
			}
		}

		public function createUser(){
			if ($_POST){
				$fname = ucwords(strtolower(trim($this->input->post('fname'))));
				$lname = ucwords(strtolower(trim($this->input->post('lname'))));
				$username = strtolower(trim($this->input->post('username')));
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

		public function updateUser(){
			if ($_POST) {
				$password = "";
				$empID = $this->input->post('empID');
				$fname = ucwords(strtolower(trim($this->input->post('fname'))));
				$lname = ucwords(strtolower(trim($this->input->post('lname'))));
				$username = strtolower(trim($this->input->post('username')));
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
				// $response = $this->Administrator->updateUser($empID,$form_data,$fname,$lname,$username);
				// echo $response;
			}
		}

		public function ajaxEmployeeList(){
			$holder = $this->Administrator->dataTablesEployees();
			$data = array();
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
			$output = array(  
	            "draw"=>intval($_POST["draw"]),  
	            "recordsTotal"=>($this->Administrator->getAllDataEmployees()-1),  
	            "recordsFiltered"=>($this->Administrator->filteredDataEmployees()-1),  
	            "data"=>$data  
		    );  
		    echo json_encode($output);
		}

		public function profiles(){
			if($this->session->userdata('empID') != null){
				$data['title'] = "Profiles";
				$this->load->view('Header',$data);
				$this->load->view('ProfileList',$data);
				$this->load->view('Footer',$data);
			}else{
				redirect(base_url()."Administrators");
			}
		}

		public function removedProfiles(){
			if($this->session->userdata('empID') != null){
				$data['title'] = "Removed Profiles";
				$this->load->view('Header',$data);
				$this->load->view('RemovedProfileList',$data);
				$this->load->view('Footer',$data);
			}else{
				redirect(base_url()."Administrators");
			}
		}

		public function ajaxProfileList(){
			$holder = $this->Administrator->dataTablesProfiles();
			$data = array();
			$filtered = $this->Administrator->filteredDataProfiles();
			foreach ($holder as $value) {
				$sub_array = array();
				$sub_array[] = $value['lname'].', '.$value['fname']." ".substr($value['mname'], 0,1);
				$sub_array[] = $value['birth'];
				$sub_array[] = $value['gender'];
				$sub_array[] = ucwords(strtolower($value['sitio'].', '.$value['brgy']));
				$sub_array[] = $value['bhw'];
				$sub_array[] = '<a href='.base_url().'Administrators/udpateProfilePage/'.$value['profileID'].' class=""><button type="button" class="btn btn-primary" id="'.$value['profileID'].'" style="margin-left:-6px;"><i class="fa fa-edit"></i></button></a>

					<a href='.base_url().'Administrators/casePage/'.$value['profileID'].' class=""><button type="button" class="btn btn-success" id="'.$value['profileID'].'" style="margin-left:-3px;"><i class="fa fa-list-alt"></i></button></a>

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

		public function addProfilePage(){
			if($this->session->userdata('empID') != null){
				$data['title'] = "Add Profile";
				$this->load->view('Header',$data);
				$this->load->view('AddProfile',$data);
				$this->load->view('Footer');
			}else{
				redirect(base_url()."Administrators");
			}
		}

		public function udpateProfilePage($profileID){
			if($this->session->userdata('empID') != null){
				$data['data'] = $this->Administrator->fetchProfile($profileID);
				$data['fmember'] = $this->Administrator->fetchFamilyMember($profileID);
				$data['title'] = "Update Profile Profile";
				$this->load->view('Header',$data);
				$this->load->view('UpdateProfile',$data);
				$this->load->view('Footer');
			}else{
				redirect(base_url()."Administrators");
			}
		}


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

		public function deleteProfile(){
			if ($_POST) {
				$profileID = $_POST['profileID'];
				$this->Administrator->deleteProfile($profileID);
				$this->Administrator->deleteAddress($profileID);
				$this->Administrator->deleteFamilyMember($profileID);
				echo "success";
			}
		}

		public function removeCase(){
			if ($_POST) {
				$profileID = $_POST['profileID'];
				$caseID = $_POST['caseID'];
				$this->Administrator->removeCase($caseID);
				echo base_url()."Administrators/casePage/".$profileID;
			}
		}

		public function casePage($profileID){
			if($this->session->userdata('empID') != null){
				$data['profile'] = $this->Administrator->fetchProfile($profileID);
				$data['cases'] = $this->Administrator->getAllCases($profileID);
				$data['title'] = $data['profile']->lname.', '.$data['profile']->fname.' '.$data['profile']->mname." cases";
				$this->load->view('Header',$data);
				$this->load->view('CasePage',$data);
				$this->load->view('Footer');
			}else{
				redirect(base_url()."Administrators");
			}
		}

		public function addCasePage($profileID){
			if($this->session->userdata('empID') != null){
				$data['title'] = "Add Case";
				$data['profile'] = $this->Administrator->fetchProfile($profileID);
				$data['fname'] = strtoupper($data['profile']->fname);
				$data['lname'] = strtoupper($data['profile']->lname);
				$data['mname'] = strtoupper($data['profile']->mname);
				$data['profileID'] = $profileID;
				$this->load->view('Header',$data);
				$this->load->view('AddCasePage',$data);
				$this->load->view('Footer');
			}else{
				redirect(base_url()."Administrators");
			}
		}

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
					echo base_url()."Administrators/casePage/".$this->input->post('profileID');
				}else{
					echo "error";
				}
			}
		}

		public function changeStatus($caseID){
			$data = $this->Administrator->fetchCase($caseID);
			$form_data = array(
					'status'=>"Served"
			);
			$this->Administrator->updateCase($caseID,$form_data);
			redirect(base_url()."Administrators/casePage/".$data[0]->profileID);
		}

		public function updateCasePage($caseID){
			if($this->session->userdata('empID') != null){
				$data['title'] = "Updating Case";
				$data['case'] = $this->Administrator->fetchCase($caseID);
				$data['profile'] = $this->Administrator->fetchProfile($data['case'][0]->profileID);
				$data['fname'] = strtoupper($data['profile']->fname);
				$data['lname'] = strtoupper($data['profile']->lname);
				$data['mname'] = strtoupper($data['profile']->mname);
				$data['profileID'] = $data['case'][0]->profileID;
				$this->load->view('Header',$data);
				$this->load->view('UpdateCasePage',$data);
				$this->load->view('Footer');
			}else{
				redirect(base_url()."Administrators");
			}
		}

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
				echo base_url()."Administrators/casePage/".$this->input->post('profileID');
			}else{
				echo "error";
			}
		}
		
		public function addProfile(){
			$data['success'] = 0;
			$data['error'] = 0;
			if($_POST){
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
				$insert_id = $this->Administrator->addProfile($form_data,$firstName,$lastName,$middleName,$confirm);
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
					echo base_url().'Administrators/profiles';
				}else{
					echo "error";
				}
			}
		}

			public function updateProfile(){
			$data['success'] = 0;
			$data['error'] = 0;
			if($_POST){
				$profileID = $this->input->post('profileID');
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
				$update_reponse = $this->Administrator->updateProfile($form_data,$profileID,$firstName,$lastName,$middleName,$confirm);
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
					echo base_url().'Administrators/profiles';
				}else{
					echo "error";
				}
			}
		}

		public function profile(){
			if($this->session->userdata('empID') != null){
				$data['title'] = "Your Profile";
				$this->load->view('Header',$data);
				$this->load->view('Profile',$data);
				$this->load->view('Footer');
			}else{
				redirect(base_url()."Administrators");
			}
		}

		/**
			*@param String
			*@return String
			*@usage Use to auto fill fields that are not filled when the form is submitted.
		*/
		private function fieldCheckerString($var){
			if($var == ''){
				return 'N/A';
			}else{
				return $var;
			}
		}

		private function fieldCheckerInt($var){
			if($var == ''){
				return '0';
			}else{
				return $var;
			}
		}

	}

?>