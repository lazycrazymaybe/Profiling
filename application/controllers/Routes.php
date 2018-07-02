<?php 

	class Routes extends CI_Controller{

		function __construct(){
			parent:: __construct();
			//Loads Administrator model 
			$this->load->model('Administrator');
			if($this->session->userdata('sessionID') === null){
				redirect(base_url()."Logins");
			}
		}

		/**
		 * Load the global pages.
		 * @param String, Array 
		*/
		private function template($pageName, $data){
			$this->load->view('Header',$data);
			$this->load->view('Sidebar',$data);
			$this->load->view($pageName,$data);
			$this->load->view('Footer',$data);
		}

		/**
		 * Loads the dashboard page.
		*/
		public function dashboard(){
			$this->load->model('Dashboard');
			$data['title'] = "Profiling | Dashboard";
			$data['is_active'] = ['active', '', '', '', '', ''];
			$overViewData = $this->Dashboard->adminOverview();
			$data['employees'] = $overViewData['userCounter'];
			$data['admins'] = $overViewData['adminCounter'];
			$data['monthlyInputs'] = $overViewData['monthlyRegs'];
			$data['totalPeople'] = $overViewData['peopleCounter'];
			$data['newRegistrations'] = $this->Dashboard->newRegistrations();
			$data['newProfiles'] = $this->Dashboard->newProfiles();
			$this->template('Dashboard' ,$data);
		}

		/**
		 * Loads the Employee page.
		*/
		public function employeesList(){
			$data['is_active'] = ['', 'active', '', '', '', ''];
			$data['title'] = "Profiling | Employee List";
			$this->template('Employees' ,$data);
		}

		/**
		 * Loads the Profile page.
		*/
		public function profiles(){
			$data['is_active'] = ['', '', '', 'active', '', ''];
			$data['title'] = "Profiling | Profiles";
			$this->template('ProfileList' ,$data);
		}

		/**
		 * Loads the RemovedProfile page.
		*/
		public function removedProfiles(){
			$data['is_active'] = ['', '', '', '', 'active', ''];
			$data['title'] = "Profiling | Removed Profiles";
			$this->template('RemovedProfileList' ,$data);
		}

		/**
		 * Loads the AddProfile page.
		*/
		public function addProfilePage(){
			$data['is_active'] = ['', '', 'active', '', '', ''];
			$data['title'] = "Profiling | Add Profile";
			$this->template('AddProfile' ,$data);
		}

		/**
		 * Loads The UpdateProfilePage page.
		*/
		public function udpateProfilePage($profileID){
			$data['is_active'] = ['', '', '', 'active', '', ''];
			$data['data'] = $this->Administrator->fetchProfile($profileID);
			$data['fmember'] = $this->Administrator->fetchFamilyMember($profileID);
			$data['title'] = "Profiling | Update Profile Profile";
			$this->template('UpdateProfile' ,$data);
		}

		/**
		 * Loads the CasePage page.
		*/
		public function casePage($profileID){
			$this->load->model('Instance');
			$data['is_active'] = ['', '', '', 'active', '', ''];
			$data['profile'] = $this->Administrator->fetchProfile($profileID);
			$data['cases'] = $this->Instance->getAllCases($profileID);
			$data['title'] = 'Profiling | '.$data['profile']->lname.', '.$data['profile']->fname.' '.$data['profile']->mname." cases";
			$this->template('CasePage' ,$data);
		}

		/**
		 * Loads the page to add case.
		*/
		public function addCasePage($profileID){
			$data['is_active'] = ['', '', '', 'active', '', ''];
			$data['title'] = "Profiling | Add Case";
			$data['profile'] = $this->Administrator->fetchProfile($profileID);
			$data['fname'] = strtoupper($data['profile']->fname);
			$data['lname'] = strtoupper($data['profile']->lname);
			$data['mname'] = strtoupper($data['profile']->mname);
			$data['profileID'] = $profileID;
			$this->template('addCasePage' ,$data);
		}

		/**
		 * Loads the page that will be used to update.
		*/
		public function updateCasePage($caseID){
			$this->load->model('Instance');
			$data['is_active'] = ['', '', '', 'active', '', ''];
			$data['title'] = "Profiling | Updating Case";
			$data['case'] = $this->Instance->fetchCase($caseID);
			$data['profile'] = $this->Administrator->fetchProfile($data['case'][0]->profileID);
			$data['fname'] = strtoupper($data['profile']->fname);
			$data['lname'] = strtoupper($data['profile']->lname);
			$data['mname'] = strtoupper($data['profile']->mname);
			$data['profileID'] = $data['case'][0]->profileID;
			$this->template('UpdateCasePage' ,$data);
		}

		/**
		 * Loads the user profile page.
		*/
		public function profile(){
			$data['is_active'] = ['', '', '', '', '', ''];
			$data['title'] = "Your Profile";
			$this->template('Profile' ,$data);
		}

		/**
		 * Backup database
		*/
		public function backupDatabase(){
			$data['is_active'] = ['', '', '', '', '','active'];
			$data['title'] = "Profiling | Manage Database";
			$this->template('ManageDatabase', $data);
		}
	}

?>