<?php 

	/**
	 * Holds all the queries to the database. Model For Case.
	 */
	class Instance extends CI_Model{

		function __construct(){
			parent:: __construct();
			date_default_timezone_set('Asia/Manila');
		}

		/**
		 * Get all the cases of a particular profile
		 * @param profileID(INT) unique ID to be searched
		 * @return Array of Objects
		*/
		public function getAllCases($profileID){
			$this->db->select()->from('tbl_cases')
							   ->where('tbl_cases.profileID',$profileID)
							   ->order_by('tbl_cases.date','DESC');
			$query = $this->db->get();
			return $query->result();
		}

		/**
		 * Add new case to the database.
		 * @param data(ARRAY) array of data to be inserted to the database.
		*/
		public function addCase($data){
			$this->db->insert('tbl_cases',$data);
			return $this->db->insert_id();
		}

		/**
		 * Fetch a single case.
		 * @param caseID(INT) unique ID to be searched.
		*/
		public function fetchCase($caseID){
			$this->db->select()->from('tbl_cases')->where('caseID',$caseID);
			$query = $this->db->get();
			return $query->result();
		}

		/**
 		 * Update a particular case.
 		 * @param caseID(INT) unique ID to be searched.
 		 * @param data(ARRAY) array of data. 
		*/
		public function updateCase($caseID,$data){
			$this->db->where('caseID',$caseID);
			$this->db->update('tbl_cases',$data);
			return 200;
		}

		/**
		 * Totally remove a case in the database
		 * @param $caseID(INT) unique ID to be searched.
		*/
		public function removeCase($caseID){
			$this->db->delete('tbl_cases', array('caseID' => $caseID));
		}
	}

 ?>