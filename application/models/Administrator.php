<?php 

	class Administrator extends CI_Model{

		function __construct(){
			parent:: __construct();
			date_default_timezone_set('Asia/Manila');
		}

		public function trial(){
			$this->db->select()->from('tbl_addprofile')->join('tbl_address', 'tbl_addprofile.profileID = tbl_address.profileID')->where('isactive',1);
			$query = $this->db->get();
			return $query->result();
		}

		/** 
			*@param username type(string), password type(string)
			*@return Array()
			*@usage This will be used for login authentication
		*/
		public function adminLogin($username,$password){
			$this->db->select()->from('tbl_employees')->where(array('username'=>$username,'password'=>md5(sha1($password)),'isactive'=>1));
			$query = $this->db->get();
			return $query->result_array();
		}

		/**
			*@return Array()
			*@usage Use Fetching Data That will be desplayed in the Admin Dashboard
		*/
		public function adminOverview(){
			$data = array();
			//Admin Counter
			$this->db->select()->from('tbl_employees')->where(array('isactive'=>1,'type'=>'Admin'));
			$query = $this->db->get();
			$data['adminCounter'] = $query->num_rows();
			//Employee Counter
			$this->db->select()->from('tbl_employees')->where(array('isactive'=>1,'type'=>'Employee'));
			$query = $this->db->get();
			$data['userCounter'] = $query->num_rows();
			//People Counter
			$this->db->select()->from('tbl_addprofile')->where('isactive',1);
			$query = $this->db->get();
			$data['peopleCounter'] = $query->num_rows();
			//Monthly Inputed Profiles
			$this->db->select()->from('tbl_addprofile')->like('date',date('Y-m'));
			$query = $this->db->get();
			$data['monthlyRegs'] = $query->num_rows();
			return $data;
		}

		/**
			*@return Array()
			*@usage Use to retrive new registrations.
		*/
		public function newRegistrations(){
			$this->db->select()->from('tbl_employees')->like('date',date('Y-m'))->order_by('date','DESC')->limit(10);
			$query = $this->db->get();
			return $query->result_array();
		}

		/**
			*@return Array()
			*@usage Use to retrive newly created profiles.
		*/
		public function newProfiles(){
			$this->db->select()->from('tbl_addprofile profiles, tbl_address address')
					 ->like('date',date('Y-m'))
					 ->where('profiles.profileID = address.profileID')
					 ->order_by('date','DESC')->limit(20);
			$query = $this->db->get();
			return $query->result_array();
		}
		
		//Start For EMPLOYEES
		/**
			*@return Array()
			*@usage This will be used as the base for the display in the tabe. It could also do the search and the order thing in the DataTables
		*/
		public function ajaxEmployeeList(){
			$order_column = array('empID','lname','username','phone','date','date','isactive',null);
			$this->db->select()->from('tbl_employees');
			if(isset($_POST['search']['value'])){
				$searchValue = $_POST['search']['value'];
				$this->db->or_like('empID',$searchValue)
							   ->or_like('lname',$searchValue)
							   ->or_like('fname',$searchValue)
							   ->or_like('mname',$searchValue)
							   ->or_like('username',$searchValue)
							   ->or_like('phone',$searchValue)
							   ->or_like('date',$searchValue);
			}
			if(isset($_POST['order'])){
				$this->db->order_by($order_column[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
			}
			else{
				$this->db->order_by('empID','DESC');
			}
		}
		/**
			*@return Array()
			@usage This will be used to display exact number of record into the DataTabes
		*/
		public function dataTablesEployees(){
			$this->ajaxEmployeeList();
			if($_POST['length'] != -1){
				$this->db->limit($_POST['length'],$_POST['start']);
			}
			$query = $this->db->get();
			return $query->result_array();
		}
		/**
			*@return Integer
			*@usage Return a number of filtered records
		*/
		public function filteredDataEmployees(){
			$this->ajaxEmployeeList();
			$query = $this->db->get();
			return $query->num_rows();
		}
		/**
			*@return Integer
			*@usage Use to return a number of all records found in the database
		*/
		public function getAllDataEmployees(){
			$this->db->select('*')->from('tbl_employees');
			return $this->db->count_all_results();
		}
		//End For EMPLOYEES

		//Start For PROFILES Active
		/**
			*@return Array()
			*@usage This will be used as the base for the display in the tabe. It could also do the search and the order thing in the DataTables
		*/
		public function ajaxProfiles(){
			$order_column = array('lname','birth','gender','sitio','bhw',null);
			$this->db->select()->from('tbl_addprofile')
							   				 ->join('tbl_address', 'tbl_addprofile.profileID = tbl_address.profileID')
												 ->where('isactive',1);
			if(isset($_POST['search']['value'])){
				$searchValue = $_POST['search']['value'];
				$this->db->where("(lname LIKE '%".$searchValue."%' OR fname LIKE '%".$searchValue."%' OR mname LIKE '%".$searchValue."%' OR birth LIKE '%".$searchValue."%' OR gender LIKE '%".$searchValue."%' OR bhw LIKE '%".$searchValue."%' OR sitio LIKE '".$searchValue."%')",null,false);
			}
			if(isset($_POST['order'])){
				$this->db->order_by($order_column[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
			}
			else{
				$this->db->order_by('date','DESC');
			}
		}
	
		/**
			*@return Array()
			@usage This will be used to display exact number of record into the DataTabes
		*/
		public function dataTablesProfiles(){
			$this->ajaxProfiles();
			if($_POST['length'] != -1){
				$this->db->limit($_POST['length'],$_POST['start']);
			}
			$query = $this->db->get();
			return $query->result_array();
		}
		/**
			*@return Integer
			*@usage Return a number of filtered records
		*/
		public function filteredDataProfiles(){
			$this->ajaxProfiles();
			$query = $this->db->get();
			return $query->num_rows();
		}
		/**
			*@return Integer
			*@usage Use to return a number of all records found in the database where isactive = 1
		*/
		public function getAllDataProfiles(){
			$this->db->select('*')->from('tbl_addprofile')->where('isactive',1);
			return $this->db->count_all_results();
		}
		//End For PROFILES Active

		//Start For PROFILES Deactivated
		/**
			*@return Array()
			*@usage This will be used as the base for the display in the tabe. It could also do the search and the order thing in the DataTables
		*/
		public function ajaxRemovedProfiles(){
			$order_column = array('lname','birth','gender','sitio','bhw',null);
			$this->db->select()->from('tbl_addprofile')
												 ->join('tbl_address', 'tbl_address.profileID = tbl_addprofile.profileID','left')
												 ->where('isactive',0)
												 ->order_by('date','DESC');
			if(isset($_POST['search']['value'])){
				$searchValue = $_POST['search']['value'];
				$this->db->where("(lname LIKE '%".$searchValue."%' OR fname LIKE '%".$searchValue."%' OR mname LIKE '%".$searchValue."%' OR birth LIKE '%".$searchValue."%' OR gender LIKE '%".$searchValue."%' OR bhw LIKE '%".$searchValue."%' OR sitio LIKE '".$searchValue."%')",null,false);
			}
			if(isset($_POST['order'])){
				$this->db->order_by($order_column[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
			}
		}
	
		/**
			*@return Array()
			@usage This will be used to display exact number of record into the DataTabes
		*/
		public function dataTablesRemovedProfiles(){
			$this->ajaxRemovedProfiles();
			if($_POST['length'] != -1){
				$this->db->limit($_POST['length'],$_POST['start']);
			}
			$query = $this->db->get();
			return $query->result_array();
			// return $this->db->get_compiled_select();
		}
		/**
			*@return Integer
			*@usage Return a number of filtered records
		*/
		public function filteredDataRemovedProfiles(){
			$this->ajaxRemovedProfiles();
			$query = $this->db->get();
			return $query->num_rows();
		}
		/**
			*@return Integer
			*@usage Use to return a number of all records found in the database where isactive = 0
		*/
		public function getAllDataRemovedProfiles(){
			$this->db->select('*')->from('tbl_addprofile')->where('isactive',0);
			return $this->db->count_all_results();
		}
		//End For PROFILES Deactivated

		/**
			*@param Array()
			*@return String
			@usage Use to create new user for the system
		*/
		public function createUser($data,$fname,$lname,$username){
			$this->db->from('tbl_employees')->where(array('fname'=>$fname,'lname'=>$lname));
			$query = $this->db->get();
			if($query->num_rows() == 0){
				$this->db->from('tbl_employees')->where('username',$username);
				$query = $this->db->get();
				if($query->num_rows() == 0){
					$this->db->insert('tbl_employees',$data);
					return "created";
				}else{
					return "username";
				}
			}else{
				return "person";
			}
		}

		/**
			*@param Int
			*@return Array of Object
			@usage Fetch single user in the database
		*/
		public function fetchUser($empID){
			$this->db->select()->from('tbl_employees')->where('empID',$empID);
			$query = $this->db->get();
			return $query->first_row();
		}

		/**
			*@param Int,Array()
			*@return Int
			*@usage Use to update single Employee information in the database
		*/
		public function updateUser($empID,$data){
			$this->db->where('empID',$empID);
			$this->db->update('tbl_employees',$data);
			return $this->db->affected_rows();
		}

		/**
			*@param Array()
			*@return Int
			*@usage Use to insert new data into the tbl_addprofile table
		*/
		public function addProfile($data,$fname,$lname,$mname,$con){
			if($con == 'yes'){
				$this->db->insert('tbl_addprofile',$data);
				return $this->db->insert_id();
			}else{
				$this->db->from('tbl_addprofile')->where(array('fname'=>$fname,'lname'=>$lname,'mname'=>$mname));
				$query = $this->db->get();
				if($query->num_rows() == 0){
					$this->db->insert('tbl_addprofile',$data);
					return $this->db->insert_id();
				}else{
					return 0;
				}
			}
		}

		/**
			*@param Array()
			*@return Int
			*@usage Use to insert new data into the tbl_address table which is relative to adding new profile
		*/
		public function addAddress($data){
			$this->db->insert('tbl_address',$data);
			return $this->db->insert_id();
		}

		/**
			*@param Array()
			*@return Int
			*@usage Use to insert new data into the tbl_fmember table which is relative to adding new profile
		*/
		public function addFamilyMember($data){
			$this->db->insert('tbl_fmember',$data);
			return $this->db->insert_id();
		}

		/**
			*@param Int
			*@return Array()
			*@usage Use to fetch single profile data
		*/
		public function fetchProfile($profileID){
				$this->db->select()->from('tbl_addprofile')->where(array('tbl_addprofile.profileID'=>$profileID))
				->join('tbl_address', 'tbl_addprofile.profileID = tbl_address.profileID','left');
				$query = $this->db->get();
				return $query->first_row();
		}
		/**
			*@param Int
			*@return Array()
			*@usage Use to fetch the family members of the fetched profile
		*/
		public function fetchFamilyMember($profileID){
				$this->db->select()->from('tbl_fmember')->where('profileID',$profileID);
				$query = $this->db->get();
				return $query->result();
		}

		public function disableEnableProfile($data,$profileID){
			$this->db->where('profileID',$profileID);
			$this->db->update('tbl_addprofile',$data);
			return $this->db->affected_rows();
		}

		public function deleteProfile($profileID){
			$this->db->delete('tbl_addprofile', array('profileID' => $profileID));
		}

		public function deleteAddress($profileID){
			$this->db->delete('tbl_address', array('profileID' => $profileID));
		}

		public function deleteFamilyMember($profileID){
			$this->db->delete('tbl_fmember', array('profileID' => $profileID));
		}

		public function deleteFamilyMember2($fmemberID){
			$this->db->delete('tbl_fmember', array('fmemberID' => $fmemberID));
		}


		public function updateProfile($data,$profileID,$fname,$lname,$mname,$con){
			if($con == 'yes'){
				$this->db->where('profileID',$profileID);
				$this->db->update('tbl_addprofile',$data);
				return 200;
			}else{
				$this->db->from('tbl_addprofile')
						 ->where('profileID !=',$profileID)
						 ->where(array('fname'=>$fname,'lname'=>$lname,'mname'=>$mname));
				$query = $this->db->get();
				if($query->num_rows() == 0){
					$this->db->where('profileID',$profileID);
					$this->db->update('tbl_addprofile',$data);
					return 200;
				}else{
					return 0;
				}
			}
		}

		public function updateAddress($data,$profileID){
			$this->db->where('profileID',$profileID);
			$this->db->update('tbl_address',$data);
			return 200;
		}

		public function updateFamilyMember($data,$fmemberID){
			$this->db->where('fmemberID',$fmemberID);
			$this->db->update('tbl_fmember',$data);
			return 200;
		}

		public function getAllCases($profileID){
			$this->db->select()->from('tbl_cases')
							   ->where('tbl_cases.profileID',$profileID)
							   ->order_by('tbl_cases.date','DESC');
			$query = $this->db->get();
			return $query->result();
		}

		public function addCase($data){
			$this->db->insert('tbl_cases',$data);
			return $this->db->insert_id();
		}

		public function fetchCase($caseID){
			$this->db->select()->from('tbl_cases')->where('caseID',$caseID);
			$query = $this->db->get();
			return $query->result();
		}

		public function updateCase($caseID,$data){
			$this->db->where('caseID',$caseID);
			$this->db->update('tbl_cases',$data);
			return 200;
		}

		public function removeCase($caseID){
			$this->db->delete('tbl_cases', array('caseID' => $caseID));
		}

		//Area for Authentication purposes.
		/**
			*@return Boolean
			*@usage Use to check for duplicate entry for family member
		*/
		public function familyMemberTraper($profileID,$name,$relation){
			$this->db->from('tbl_fmember')->where(array('profileID'=>$profileID,'name'=>$name,'$relation'=>$relation));
			$query = $this->db->get();
			if($query->num_rows() == 0){
				return false;
			}else{
				return true;
			}
		}
		/**
			*@return Boolean
			*@usage Use to check for duplicate entry for usernames
		*/
		public function usernameTraper($username){
			$this->db->from('tbl_employees')->where('username',$username);
			$query = $this->db->get();
			if($query->num_rows() == 0){
				return false;
			}else{
				return true;
			}
		}

		/**
			*@return Boolean
			*@usage Use to check for duplicate entry for names
		*/
		public function nameTraper($fname,$lname){
			$this->db->from('tbl_employees')->where(array('fname'=>$fname,'lname'=>$lname));
			$query = $this->db->get();
			if($query->num_rows() == 0){
				return false;
			}else{
				return true;
			}
		}
	}

?>