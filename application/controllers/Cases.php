<?php  

	class Cases extends CI_Controller{
		
		function __construct(){
			parent:: __construct();
			$this->load->model('Instance');
		}

		/**
		 * Totally remove a case to the database.
		 * @return String
		*/
		public function removeCase(){
			if ($_POST) {
				$profileID = $_POST['profileID'];
				$caseID = $_POST['caseID'];
				$this->Instance->removeCase($caseID);
				echo base_url()."Routes/casePage/".$profileID;
			}
		}

		/**
		 * Adds a case for a particular person.
		 * @return String
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
				$return = $this->Instance->addCase($form_data);
				if($return > 0){
					echo base_url()."Routes/casePage/".$this->input->post('profileID');
				}else{
					echo "error";
				}
			}
		}

		/**
		 * Change case status. 
		 * @return String
		*/
		public function changeStatus($caseID){
			$data = $this->Instance->fetchCase($caseID);
			$form_data = array(
					'status'=>"Served"
			);
			$this->Instance->updateCase($caseID,$form_data);
			redirect(base_url()."Routes/casePage/".$data[0]->profileID);
		}

		/**
		 * Updates case.
		 * @return String
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
			$return = $this->Instance->updateCase($this->input->post('caseID'),$form_data);
			if($return > 0){
				echo base_url()."Routes/casePage/".$this->input->post('profileID');
			}else{
				echo "error";
			}
		}
	}
?>