<?php 

	/**
	 * Model for session table
	 */
	class Session extends CI_Model{
		
		/**
		 * Insert new session. For tracking. 
		 * @param profileID(INT) reference key.
		 * @param data(ARRAY) data to be inserted
		*/
		public function insertSession($data){
			$this->db->insert('tbl_sessions' $data);
			return $this->insert_id();
		}

		public function fetchAllSession(){

		}

		public function filterSession(){

		}
	}

?>