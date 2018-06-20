<?php  

	class Users extends CI_Controller {

		function __construct(){
			parent:: __construct();
			$this->load->model('Administrator');
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
	}
?>