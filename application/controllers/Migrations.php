<?php 

	class Migrations extends CI_Controller{

		function __construct(){
			parent:: __construct();
			$this->load->model("Migration");
			date_default_timezone_set('Asia/Manila');
		}

		public function trial(){
			$catcher = $this->Migration->getAllData();
			foreach ($catcher as $value) {
				if($value->one != ''){
					echo "<pre>";
					$one = rtrim($value->one,')');
					$exp = explode('(', $one);
					echo count($exp);
					echo "</pre>";
				}
			}
		}

		public function Migrate(){
			$catcher = $this->Migration->getAllData();
			foreach ($catcher as $value) {
				$fname = $value->fname;
				$lname = $value->lname;
				$mname = $value->mname;
				$extension = $value->extension;
				$checker = $this->Migration->duplicateTrapper($fname,$lname,$mname,$extension);
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
					$insert_id = $this->Migration->insertProfile($form_data);
					if($insert_id){
						$form_data = array(
							'profileID'=>$insert_id,
							'region'=>$value->region,
							'province'=>$value->province,
							'city'=>$value->city,
							'sitio'=>$value->sitio,
							'brgy'=>$value->brgy
						);
						$insert_id1 = $this->Migration->insertAddress($form_data);
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
				$this->Migration->insertFamilyMember($form_data);
			}
		}
		
	}

?>