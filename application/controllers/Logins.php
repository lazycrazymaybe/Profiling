<?php  

	class Logins extends CI_Controller{

		/**
		 * Login controller
		 * @return Int
		*/
		public function index(){
			$this->load->model('User');
			$this->load->model('Administrator');
			$data['title'] = "Brng. Camaman-an | People Monitoring System";
			$data['success'] = 1;
			if($this->input->post()){
				$username = $this->input->post("username");
				$password = $this->input->post("password");
				$login = $this->Administrator->adminLogin($username,$password);
				if($login){
					if($login[0]['sessionKey'] == NULL){
						$key = md5(uniqid(rand(), true));
						$this->session->set_userdata('empID',$login[0]['empID']);
						$this->session->set_userdata('username',$login[0]['username']);
						$this->session->set_userdata('password',$login[0]['password']);
						$this->session->set_userdata('fname',$login[0]['fname']);
						$this->session->set_userdata('lname',$login[0]['lname']);
						$this->session->set_userdata('mname',$login[0]['mname']);
						$this->session->set_userdata('type',$login[0]['type']);
						$this->session->set_userdata('phone',$login[0]['phone']);
						$this->session->set_userdata('sessionID', $key);
						$this->User->updateUser($login[0]['empID'], ['sessionKey' => $key]);
						$data['success'] = 1;
						redirect(base_url().'Routes/dashboard');
					}else{
						$data['success'] = 404;
					}
					
				}else{
					$data['success'] = 0;
				}
			}
			$this->load->view('Login',$data);
		}

		/**
		 * Logout controller 
		*/
		public function logout(){
			$this->load->model('User');
			$this->User->updateUser($this->session->userdata('empID'), ['sessionKey' => NULL]);
			$this->session->sess_destroy();
			redirect(base_url().'Logins');
		}
	}

?>