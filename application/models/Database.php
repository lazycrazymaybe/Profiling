<?php 

	class Database extends CI_Model{


		function __construct(){
			parent:: __construct();
			date_default_timezone_set('Asia/Manila');
		}

		public function getAllData(){
			$query = $this->db->get('tbl_profile');
			return $query->result();
		}

		public function duplicateTrapper($fname,$lname,$mname,$extension){
			$this->db->select()->from('tbl_addprofile')
							   ->where(array('fname'=>$fname,'lname'=>$lname,'mname'=>$mname,'extension'=>$extension));
			$query = $this->db->get();
			if($query->num_rows() == 0){
				return false;
			}else{
				return true;
			}
		}

		public function insertProfile($data){
			$this->db->insert('tbl_addprofile',$data);
			return $this->db->insert_id();
		}

		public function insertAddress($data){
			$this->db->insert('tbl_address',$data);
			return $this->db->insert_id();
		}

		public function insertFamilyMember($data){
			$this->db->insert('tbl_fmember',$data);
			return $this->db->insert_id();
		}

	}

?>