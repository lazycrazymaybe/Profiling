<?php  

	class Cases extends CI_Controller{
		
		function __construct(){
			parent:: __construct();
			$this->load->model('Administrator');
		}

		/**
			@description Totally remove a case to the database.
		*/
		public function removeCase(){
			if ($_POST) {
				$profileID = $_POST['profileID'];
				$caseID = $_POST['caseID'];
				$this->Administrator->removeCase($caseID);
				echo base_url()."Routes/casePage/".$profileID;
			}
		}

		/**
			@description Adds a case for a particular person.
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
				$return = $this->Administrator->addCase($form_data);
				if($return > 0){
					echo base_url()."Routes/casePage/".$this->input->post('profileID');
				}else{
					echo "error";
				}
			}
		}

		/**
			@description Change case status. 
		*/
		public function changeStatus($caseID){
			$data = $this->Administrator->fetchCase($caseID);
			$form_data = array(
					'status'=>"Served"
			);
			$this->Administrator->updateCase($caseID,$form_data);
			redirect(base_url()."Routes/casePage/".$data[0]->profileID);
		}

		/**
			@description Updates case.
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
			$return = $this->Administrator->updateCase($this->input->post('caseID'),$form_data);
			if($return > 0){
				echo base_url()."Routes/casePage/".$this->input->post('profileID');
			}else{
				echo "error";
			}
		}
	}
?>