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
						$this->createSession($login[0]['empID'], $key, 'Login');
						$data['success'] = 1;
						redirect(base_url().'Routes/dashboard');
					}else{
						$this->User->updateUser($login[0]['empID'], ['sessionKey' => NULL]);
						$data['success'] = 404;
					}
					
				}else{
					$data['success'] = 0;
				}
			}
			$this->load->view('Login',$data);
		}

		/**
		 * @ Create Login Session for user tracking
		 * @param profileID(INT)
		 * @param sessionKey(STRING)
		 * @param action(STRING)
		 * @param ipaddress(STRING)
		 * @return
		*/
		public function createSession($profileID, $sessionKey, $action, $ipaddress = null){
			$session_data = array(
								'profileID'=>$profileID,
								'sessionKey'=>$sessionKey,
								'action'=>$action,
								'ipaddress'=>$ipaddress
							);
			$this->load->model('Administrator');
			$this->Administrator->createSession($session_data);
		}

		/**
		 * Logout controller 
		*/
		public function logout(){
			$this->load->model('User');
			$this->User->updateUser($this->session->userdata('empID'), ['sessionKey' => NULL]);
			$this->createSession($this->session->userdata('empID'), NULL, 'Logout');
			$this->session->sess_destroy();
			redirect(base_url().'Logins');
		}
	}

?>