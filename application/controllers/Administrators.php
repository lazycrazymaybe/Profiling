<?php 

	class Administrators extends CI_Controller{

		function __construct(){
			parent:: __construct();
			$this->load->model("Administrator");
			date_default_timezone_set('Asia/Manila');
		}

		/**
		 * Gets profiles data in the database. Depends on model condition
		 * @return JSON
		*/
		public function ajaxProfileList(){
			$holder = $this->Administrator->dataTablesProfiles();
			$data = array();
			$filtered = $this->Administrator->filteredDataProfiles();
			//Sets up for datatables
			foreach ($holder as $value) {
				$sub_array = array();
				$sub_array[] = $value['lname'].', '.$value['fname']." ".substr($value['mname'], 0,1);
				$sub_array[] = $value['birth'];
				$sub_array[] = $value['gender'];
				$sub_array[] = ucwords(strtolower($value['sitio'].', '.$value['brgy']));
				$sub_array[] = $value['bhw'];
				$sub_array[] = '<a href='.base_url().'Routes/udpateProfilePage/'.$value['profileID'].' class=""><button type="button" class="btn btn-primary" id="'.$value['profileID'].'" style="margin-left:-6px;"><i class="fa fa-edit"></i></button></a>

					<a href='.base_url().'Routes/casePage/'.$value['profileID'].' class=""><button type="button" class="btn btn-success" id="'.$value['profileID'].'" style="margin-left:-3px;"><i class="fa fa-list-alt"></i></button></a>

					<button type="button" class="btn btn-danger remove_confirmation" id="'.$value['profileID'].'"><i class="fa fa-remove"></i></button>';
				$data[] = $sub_array;
			}
			$output = array(  
	            "draw"=>intval($_POST["draw"]),  
	            "recordsTotal"=>$this->Administrator->getAllDataProfiles(),  
	            "recordsFiltered"=>$filtered,  
	            "data"=>$data  
      		);  
      		echo json_encode($output);
		}

		/**
		 * Gets all removed profile in the database.
		 * @return JSON
		*/
		public function ajaxRemovedProfileList(){
			$holder = $this->Administrator->dataTablesRemovedProfiles();
			$data = array();
			$filtered = $this->Administrator->filteredDataRemovedProfiles();
			foreach ($holder as $value) {
				$sub_array = array();
				$sub_array[] = $value['lname'].', '.$value['fname']." ".substr($value['mname'], 0,1);
				$sub_array[] = $value['birth'];
				$sub_array[] = $value['gender'];
				$sub_array[] = ucwords(strtolower($value['sitio'].', '.$value['brgy']));
				$sub_array[] = $value['bhw'];
				$sub_array[] = '<button type="button" class="btn btn-danger delete_confirmation" id="'.$value['profileID'].'" style="margin-left:-6px;"><i class="fa fa-trash"></i></button>
												<button type="button" class="btn btn-success add_confirmation" id="'.$value['profileID'].'"><i class="fa fa-plus"></i></button>';
				$data[] = $sub_array;
			}
			$output = array(  
	            "draw"=>intval($_POST["draw"]),  
	            "recordsTotal"=>$this->Administrator->getAllDataRemovedProfiles(),  
	            "recordsFiltered"=>$filtered,  
	            "data"=>$data  
      		);  
      		echo json_encode($output);
		}

		/**
		 * Use to disable or enable profile
		 * @return String
		*/
		public function disableEnableProfile(){
			if ($_POST) {
				$isactive = 0;
				$profileID = $_POST['profileID'];
				$cather = $this->Administrator->fetchProfile($profileID);
				$date = $cather->date;
				if($cather->isactive == 1){
					$isactive = 0;
				}else{
					$isactive = 1;
				}
				$form_data = array(
							 'isactive'=>$isactive,
							 'date'=>$date
				);
				$checker = $this->Administrator->disableEnableProfile($form_data,$profileID);
				if($checker > 0){
					echo "success";
				}else{
					echo "error";
				}
			}
		}

		/**
		 * description Totally remove profile to the database.
		 * @return String
		*/
		public function deleteProfile(){
			if ($_POST) {
				$profileID = $_POST['profileID'];
				$this->Administrator->deleteProfile($profileID);
				$this->Administrator->deleteAddress($profileID);
				$this->Administrator->deleteFamilyMember($profileID);
				echo "success";
			}
		}
		
		/**
		 * Add New Profile to the database
		 * @return String
		*/
		public function addProfile(){
			$data['success'] 	= 0;
			$data['error'] 		= 0;
			if($_POST){
				$form_data = $this->staging();
				//Cleans the input before sending to the database.
				$insert_id = $this->Administrator->addProfile($form_data[0],$form_data[1],$form_data[2],$form_data[3],$form_data[4]);
				//Insert data to the address table parallel to the users data.
				if($insert_id > 0){
					$form_data = array(
								'profileID'=>$insert_id,
								'region'=>$this->input->post('region'),
								'province'=>$this->input->post('province'),
								'city'=>$this->input->post('city'),
								'sitio'=>strtoupper(trim($this->input->post('sitio'))),
								'brgy'=>strtoupper(trim($this->input->post('barangay')))
					);
					$insert_id1 = $this->Administrator->addAddress($form_data);
					//Inssert data to the family member table parallel to the users data.
					if($insert_id1){
						if(isset($_POST['name'])){
							for($count = 0; $count < count($_POST['name']); $count++){
								if($_POST['name'][$count] != '' && $_POST['relationship'][$count] != ''){
									$form_data = array(
											 'profileID'=>$insert_id,
											 'name'=>ucwords(strtolower(trim($_POST['name'][$count]))),
											 'relation'=>$_POST['relationship'][$count]
									);
									$this->Administrator->addFamilyMember($form_data);
								}
							}
						}
					
					}
					echo base_url().'Routes/profiles';
				}else{
					echo "error";
				}
			}
		}

		/**
		 * Use to update certain profile.
		 * @return String
		*/
		public function updateProfile(){
			$data['success'] 	= 0;
			$data['error'] 		= 0;
			if($_POST){
				$profileID = $this->input->post('profileID');
				$form_data = $this->staging();
				$update_reponse = $this->Administrator->updateProfile($form_data[0],$profileID,$form_data[1],$form_data[2],$form_data[3],$form_data[4]);
				if($update_reponse > 0){
					$form_data = array(
								'profileID'=>$profileID,
								'region'=>$this->input->post('region'),
								'province'=>$this->input->post('province'),
								'city'=>$this->input->post('city'),
								'sitio'=>strtoupper(trim($this->input->post('sitio'))),
								'brgy'=>strtoupper(trim($this->input->post('barangay')))
					);
					$insert_id1 = $this->Administrator->updateAddress($form_data,$profileID);
					if($insert_id1){
						if(isset($_POST['name'])){
							$familyMembers = $this->Administrator->fetchFamilyMember($profileID);
							for($count = 0; $count < count($_POST['name']); $count++){
								if($_POST['name'][$count] != '' && $_POST['relationship'][$count] != ''){
									if(count($familyMembers) != 0){
										foreach ($familyMembers as $value) {
											if(in_array(intval($value->fmemberID), $_POST['fmemberID']) == false){
												$this->Administrator->deleteFamilyMember2($value->fmemberID);
											}
										}
									}
									$name = ucwords(strtolower(trim($_POST['name'][$count])));
									$relation = $_POST['relationship'][$count];
									$form_data = array(
											 'profileID'=>$profileID,
											 'name'=>$name,
											 'relation'=>$relation
									);
									if(isset($_POST['fmemberID'])){
										if($count < count($_POST['fmemberID'])){
											$this->Administrator->updateFamilyMember($form_data,$_POST['fmemberID'][$count]);
										}else{
											$this->Administrator->addFamilyMember($form_data);
										}
									}else{
										$this->Administrator->addFamilyMember($form_data);
									}
								}
							}
						}else{
							$familyMembers = $this->Administrator->fetchFamilyMember($profileID);
							foreach ($familyMembers as $value) {
									$this->Administrator->deleteFamilyMember2($value->fmemberID);
								}
							}
					}
					echo base_url().'Routes/profiles';
				}else{
					echo "error";
				}
			}
		}

		/**
		 * Catches all the post input from adding or updating a profile info.
		 * @return Array
		*/
		private function staging(){
			$name_extension 	= $this->fieldCheckerString($this->input->post('name_extension'));
			$vin 				= $this->fieldCheckerString($this->input->post('vin'));
			$no_siblings 		= $this->fieldCheckerInt($this->input->post('no_siblings'));
			$present_address 	= $this->fieldCheckerString($this->input->post('present_address'));
			$spouse 			= $this->fieldCheckerString($this->input->post('spouse'));
			$occupation 		= $this->fieldCheckerString($this->input->post('occupation'));
			$mother 			= $this->fieldCheckerString($this->input->post('mother'));
			$mother_occupation 	= $this->fieldCheckerString($this->input->post('mother_occupation'));
			$father 			= $this->fieldCheckerString($this->input->post('occupation'));
			$father_occupation 	= $this->fieldCheckerString($this->input->post('occupation'));
			$no_children 		= $this->fieldCheckerInt($this->input->post('no_children'));
			$firstName 			= ucwords(strtolower(trim($this->input->post('firstName'))));
			$lastName 			= ucwords(strtolower(trim($this->input->post('lastName'))));
			$middleName 		= ucwords(strtolower(trim($this->input->post('middleName'))));
			$confirm 			= $this->input->post('yes_no');
			$form_data 			= array(
								    'isactive'=>1,
								    'fname'=>$firstName,
								    'lname'=>$lastName,
								    'mname'=>$middleName,
								    'extension'=>ucfirst(strtolower(trim($name_extension))),
								    'birth'=>$this->input->post('dob'),
								    'gender'=>$this->input->post('gender'),
								    'pob'=>ucwords(strtolower(trim($this->input->post('pob')))),
								    'civilstatus'=>$this->input->post('civil_status'),
								    'profession'=>ucwords(strtolower(trim($occupation))),
								    'mother'=>ucwords(strtolower(trim($mother))),
								    'occupationm'=>ucwords(strtolower(trim($mother_occupation))),
								    'father'=>ucwords(strtolower(trim($father))),
								    'occupationf'=>ucwords(strtolower(trim($father_occupation))),
								    'presadd'=>ucwords(strtolower(trim($present_address))),
								    'nos'=>intval($no_siblings),
								    'noc'=>intval($no_children),
								    'spouse'=>ucwords(strtolower(trim($spouse))),
								    'bhw'=>ucwords(strtolower(trim($this->input->post('bhw')))),
								    'vin'=>trim($vin),
								    'comstat'=>$this->input->post('comelect_status'),
			);
			return [$form_data,$firstName,$lastName,$middleName,$confirm];
		}

		/**
			*@param String
			*@return String
			*@usage Use to auto fill fields that are not filled when the form is submitted.
		*/
		private function fieldCheckerString($var){
			return $var == '' ? 'N/A' : $var;
		}

		/**
			*@param String
			*@return String
			*@usage Use to auto fill fields that are not filled when the form is submitted.
		*/
		private function fieldCheckerInt($var){
			return $var == '' ? '0' : $var;
		}
	}
?>