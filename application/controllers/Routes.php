<?php 

	class Routes extends CI_Controller{

		function __construct(){
			parent:: __construct();
			//Loads Administrator model 
			$this->load->model('Administrator');
			if($this->session->userdata('empID') == null){
				redirect(base_url()."Logins");
			}
		}

		/**
			*@param String, Array
			*@description Load the global pages. 
		*/
		protected function template($pageName, $data){
			$this->load->view('Header',$data);
			$this->load->view('Sidebar',$data);
			$this->load->view($pageName,$data);
			$this->load->view('Footer',$data);
		}

		/**
			@description Loads the dashboard page.
		*/
		public function dashboard(){
			$data['title'] = "Dashboard";
			$data['is_active'] = ['active', '', '', '', ''];
			$overViewData = $this->Administrator->adminOverview();
			$data['employees'] = $overViewData['userCounter'];
			$data['admins'] = $overViewData['adminCounter'];
			$data['monthlyInputs'] = $overViewData['monthlyRegs'];
			$data['totalPeople'] = $overViewData['peopleCounter'];
			$data['newRegistrations'] = $this->Administrator->newRegistrations();
			$data['newProfiles'] = $this->Administrator->newProfiles();
			$this->template('Dashboard' ,$data);
		}

		/**
			@description Loads the Employee page.
		*/
		public function employeesList(){
			$data['is_active'] = ['', 'active', '', '', ''];
			$data['title'] = "Employee List";
			$this->template('Employees' ,$data);
		}

		/**
			@description Loads the Profile page.
		*/
		public function profiles(){
			$data['is_active'] = ['', '', '', 'active', ''];
			$data['title'] = "Profiles";
			$this->template('ProfileList' ,$data);
		}

		/**
			*@Description Loads the RemovedProfile page.
		*/
		public function removedProfiles(){
			$data['is_active'] = ['', '', '', '', 'active'];
			$data['title'] = "Removed Profiles";
			$this->template('RemovedProfileList' ,$data);
		}

		/**
			*@description Loads the AddProfile page.
		*/
		public function addProfilePage(){
			$data['is_active'] = ['', '', 'active', '', ''];
			$data['title'] = "Add Profile";
			$this->template('AddProfile' ,$data);
		}

		/**
			@description Loads The UpdateProfilePage page.
		*/
		public function udpateProfilePage($profileID){
			$data['is_active'] = ['', '', '', 'active', ''];
			$data['data'] = $this->Administrator->fetchProfile($profileID);
			$data['fmember'] = $this->Administrator->fetchFamilyMember($profileID);
			$data['title'] = "Update Profile Profile";
			$this->template('UpdateProfile' ,$data);
		}

		/**
			@description Loads the CasePage page.
		*/
		public function casePage($profileID){
			$data['is_active'] = ['', '', '', 'active', ''];
			$data['profile'] = $this->Administrator->fetchProfile($profileID);
			$data['cases'] = $this->Administrator->getAllCases($profileID);
			$data['title'] = $data['profile']->lname.', '.$data['profile']->fname.' '.$data['profile']->mname." cases";
			$this->template('CasePage' ,$data);
		}

		/**
			@description Loads the page to add case.
		*/
		public function addCasePage($profileID){
			$data['is_active'] = ['', '', '', 'active', ''];
			$data['title'] = "Add Case";
			$data['profile'] = $this->Administrator->fetchProfile($profileID);
			$data['fname'] = strtoupper($data['profile']->fname);
			$data['lname'] = strtoupper($data['profile']->lname);
			$data['mname'] = strtoupper($data['profile']->mname);
			$data['profileID'] = $profileID;
			$this->template('addCasePage' ,$data);
		}

		/**
			@description Loads the page that will be used to update.
		*/
		public function updateCasePage($caseID){
			$data['is_active'] = ['', '', '', 'active', ''];
			$data['title'] = "Updating Case";
			$data['case'] = $this->Administrator->fetchCase($caseID);
			$data['profile'] = $this->Administrator->fetchProfile($data['case'][0]->profileID);
			$data['fname'] = strtoupper($data['profile']->fname);
			$data['lname'] = strtoupper($data['profile']->lname);
			$data['mname'] = strtoupper($data['profile']->mname);
			$data['profileID'] = $data['case'][0]->profileID;
			$this->template('UpdateCasePage' ,$data);
		}

		/**
			@description Loads the user profile page.
		*/
		public function profile(){
			$data['is_active'] = ['', '', '', '', ''];
			$data['title'] = "Your Profile";
			$this->template('Profile' ,$data);
		}
	}

?>