<?php  

	/**
	 * Model for users.
	 */
	class User extends CI_Model{
		
		function __construct(){
			parent:: __construct();
			date_default_timezone_set('Asia/Manila');
		}

		/**
		 * Use to create new user for the system.
		 * @param data(ARRAY) array of data.
		 * @param fname(STRING) for validation.
		 * @param lname(STRING) for validation.
		 * @param username(STRING) for validation.
		 * @return String
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
		 * Fetch single user in the database
		 * @param empID(INT) unique ID to be searched
		 * @return Array of Object
		*/
		public function fetchUser($empID){
			$this->db->select()->from('tbl_employees')->where('empID',$empID);
			$query = $this->db->get();
			return $query->first_row();
		}

		/**
		 * Use to update single Employee information in the database
		 * @param empID(INT) unique ID to be searched
		 * @param data(ARRAY) array of data
		 * @return Int
		*/
		public function updateUser($empID,$data){
			$this->db->where('empID',$empID);
			$this->db->update('tbl_employees',$data);
			return $this->db->affected_rows();
		}

		/**
	 	 * This will be used as the base for the display in the tabe. It could also do the search and the order thing in the DataTables
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
		 * This will be used to display exact number of record into the DataTabes
		 * @return Array()
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
		 * Return a number of filtered records
		 * @return Integer
		*/
		public function filteredDataEmployees(){
			$this->ajaxEmployeeList();
			$query = $this->db->get();
			return $query->num_rows();
		}

		/**
		 * Use to return a number of all records found in the database
		 * @return Integer
			
		*/
		public function getAllDataEmployees(){
			$this->db->select('*')->from('tbl_employees');
			return $this->db->count_all_results();
		}

		/**
		 * Use to check for duplicate entry for usernames
		 * @param username(STRING) use for comparison
		 * @return Boolean
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
		 * Use to check for duplicate entry for names
		 * @param fname(STRING) use for comparison
		 * @param lname(STRING) use for comparison
		 * @return Boolean
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