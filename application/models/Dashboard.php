<?php  

	/**
	 * Dashboard model
	 */
	class Dashboard extends CI_Model{
		
		function __construct(){
			parent:: __construct();
		}

		/**
		 * Use Fetching Data That will be desplayed in the Admin Dashboard
		 * @return Array()
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
		 * Use to retrive new registrations.
		 * @return Array()
		*/
		public function newRegistrations(){
			$this->db->select()->from('tbl_employees')->like('date',date('Y-m'))->order_by('date','DESC')->limit(10);
			$query = $this->db->get();
			return $query->result_array();
		}

		/**
		 * Use to retrive newly created profiles.
		 * @return Array()
		*/
		public function newProfiles(){
			$this->db->select()->from('tbl_addprofile profiles, tbl_address address')
					 ->like('date',date('Y-m'))
					 ->where('profiles.profileID = address.profileID')
					 ->order_by('date','DESC')->limit(20);
			$query = $this->db->get();
			return $query->result_array();
		}
	}

?>