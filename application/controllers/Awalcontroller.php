<?php
	if(!defined('BASEPATH'))exit('No direct script access allowed');
		class Awalcontroller extends CI_Controller{
			function __construct(){
				parent::__construct();
			}
			function index(){
				$data['gagal']='';
				$this->load->view('loginakun',$data);
			}
			function checkLogin() {
				$data= array(
					'username' =>$this->input->post('username'),
					'password' =>$this->input->post('password'),
					);
				$this->load->model('Usermodel');
				$result = $this->Usermodel->loginakun($data);
				if($result) {
					$sess_array = array();
					foreach($result as $row) {
						//create the session
						$sess_array = array('IdMember' => $row->IdMember,
											'Username' => $row->username,
											'NamaMember' => $row->NamaMember,
											'NoMember'=> $row->NoMember);
						//set session with value from database
						$this->session->set_userdata('logged_in', $sess_array);
					}
					redirect(site_url('Belicontroller/'));
				} else {
					// $this->form_validation->set_message('check_database', 'Invalid username or password');
					// return FALSE;
					$data['gagal'] = '<div id="notification">Login Fail!<BR>1. Username or Password is wrong.<BR>2. Check again your input <span class="red"></span>.</div>';
					$this->load->view('loginakun',$data);
				}
			}

			function logoutUser(){
				$this->session->unset_userdata('logged_in');
				$this->session->sess_destroy();
				// redirect(base_url('loginController'), 'refresh');
				redirect(site_url());
			}

			function daftar(){
				$this->load->view('daftarakun');
			}

			function saveakun(){
				$data=array(
					'NamaMember'=>$_POST['nama'],
					'username'=>$_POST['username'],
					'password'=>$_POST['password'],
					'email'=>$_POST['email'],
				);
				$this->load->model('Membermodel'); 
				$res=$this->Membermodel->insertMember($data);
				redirect(site_url('Awalcontroller/'));
			}
		}
?>