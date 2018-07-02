<?php 

	class Databases extends CI_Controller{

		function __construct(){
			parent:: __construct();
			$this->load->model("Database");
			date_default_timezone_set('Asia/Manila');
		}

		public function backup(){
			$this->load->dbutil();

			$prefs = array(     
			    'format'      => 'zip',             
			    'filename'    => 'profiling.sql'
			    );

			$backup =& $this->dbutil->backup($prefs); 
			$db_name = 'database_backup-' . date("Y-m-d-H-i-s") .'.zip';
			
			mkdir('D:/Profiling');
			$save = 'D:/Profiling';
			if(!is_dir('D:/Profiling')){
				mkdir('E:/Profiling');
				$save = 'E:/Profiling/'.$db_name;
			}else{
				$save = 'D:/Profiling/'.$db_name;
			}

			$this->load->helper('file');
			write_file($save, $backup); 


			$this->load->helper('download');
			force_download($db_name, $backup);
		}

		/**
		 * Migrate Database record from one Database to this one.
		*/
		public function Migrate(){
			$catcher = $this->Database->getAllData();
			foreach ($catcher as $value) {
				$fname = $value->fname;
				$lname = $value->lname;
				$mname = $value->mname;
				$extension = $value->extension;
				$checker = $this->Database->duplicateTrapper($fname,$lname,$mname,$extension);
				if($checker == false){
					$form_data = array(
						'isactive'=>1,
						'fname'=>$value->fname,
						'lname'=>$value->lname,
						'mname'=>$value->mname,
						'extension'=>$value->extension,
						'birth'=>$value->birth,
						'gender'=>$value->gender,
						'pob'=>$value->place,
						'civilstatus'=>$value->civilstatus,
						'profession'=>$value->profession,
						'mother'=>$value->mother,
						'occupationm'=>$value->occupationm,
						'father'=>$value->father,
						'occupationf'=>$value->occupationf,
						'presadd'=>$value->presadd,
						'nos'=>$value->nos,
						'noc'=>$value->noc,
						'spouse'=>$value->spouse,
						'bhw'=>$value->bhw,
						'vin'=>$value->vin,
						'comstat'=>$value->comstat
					);
					$insert_id = $this->Database->insertProfile($form_data);
					if($insert_id){
						$form_data = array(
							'profileID'=>$insert_id,
							'region'=>$value->region,
							'province'=>$value->province,
							'city'=>$value->city,
							'sitio'=>$value->sitio,
							'brgy'=>$value->brgy
						);
						$insert_id1 = $this->Database->insertAddress($form_data);
						if($insert_id1){
							$this->disecter($insert_id,$value->one);
							$this->disecter($insert_id,$value->two);
							$this->disecter($insert_id,$value->three);
							$this->disecter($insert_id,$value->four);
							$this->disecter($insert_id,$value->five);
							$this->disecter($insert_id,$value->six);
							$this->disecter($insert_id,$value->seven);
							$this->disecter($insert_id,$value->eight);
							$this->disecter($insert_id,$value->nine);
							$this->disecter($insert_id,$value->ten);
							$this->disecter($insert_id,$value->eleven);
							$this->disecter($insert_id,$value->twelv);
							$this->disecter($insert_id,$value->tirten);
							$this->disecter($insert_id,$value->fourteen);
						}
					}
				}else{
					//echo "DOne";
				}
			}
		}

		/**
		 * Helper Function 
		*/
		public function disecter($profileID,$string){
			if($string != ''){
				$disecting = rtrim($string,')');
				$exp = explode('(', $disecting);
				$relation = 'son';
				if(count($exp) > 1){
					$relation = $exp[1];
				}
				$form_data = array(
					'profileID'=>$profileID,
					'name'=>$exp[0],
					'relation'=>$relation
				);
				$this->Database->insertFamilyMember($form_data);
			}
		}
		
	}

?>