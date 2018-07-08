<?php 

	class Administrator extends CI_Model{

		function __construct(){
			parent:: __construct();
			date_default_timezone_set('Asia/Manila');
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
		 * Create User session
		 * @param data(ARRAY)
		*/
		public function createSession($data){
			$this->db->insert('tbl_sessions', $data);
		}
		
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
				$this->db->where("(lname LIKE '%".$searchValue."%' OR fname LIKE '%".$searchValue."%' OR mname LIKE '%".$searchValue."%' OR birth LIKE '%".$searchValue."%' OR gender LIKE '%".$searchValue."%' OR bhw LIKE '%".$searchValue."%' OR sitio LIKE '".$searchValue."%' OR fullname LIKE '".$searchValue."%')",null,false);
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
				$this->db->where("(lname LIKE '%".$searchValue."%' OR fname LIKE '%".$searchValue."%' OR mname LIKE '%".$searchValue."%' OR birth LIKE '%".$searchValue."%' OR gender LIKE '%".$searchValue."%' OR bhw LIKE '%".$searchValue."%' OR sitio LIKE '".$searchValue."%' OR fullname LIKE '".$searchValue."%')",null,false);
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
	}

?>