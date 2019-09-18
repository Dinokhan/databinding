<?php
	if(!defined('BASEPATH'))exit('No direct script access allowed');
		class Logincontroller extends CI_Controller{
			function __construct(){
				parent::__construct();
			}

			function index(){
				$data['gagal']='';
				$this->load->view('loginview',$data);
			}

			function checkLogin() {
				$data= array(
					'username' =>$this->input->post('username'),
					'password' =>$this->input->post('password'),
					);
				$this->load->model('Usermodel');
				$result = $this->Usermodel->login($data);
				if($result) {
					$sess_array = array();
					foreach($result as $row) {
						//create the session
						$sess_array = array('IdLogin' => $row->IdLogin,
											'Username' => $row->Username,
											'NamaKaryawan' => $row->NamaKaryawan,
											'Role'=>$row->Role);
						//set session with value from database
						$this->session->set_userdata('logged_in', $sess_array);
					}
					redirect(site_url('Dashboardcontroller/'));
				} else {
					// $this->form_validation->set_message('check_database', 'Invalid username or password');
					// return FALSE;
					$data['gagal'] = '<div id="notification">Login Fail!<BR>1. Username or Password is wrong.<BR>2. Check again your input <span class="red"></span>.</div>';
					$this->load->view('loginview',$data);
				}
			}

			function logoutUser(){
				$this->session->unset_userdata('logged_in');
				$this->session->sess_destroy();
				// redirect(base_url('loginController'), 'refresh');
				redirect(site_url());
			}
		}
?>