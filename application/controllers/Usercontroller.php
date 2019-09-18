<?php
	if(!defined('BASEPATH'))exit('No direct script access allowed');
		class Usercontroller extends CI_Controller{
			function __construct(){
				parent::__construct();
			}
			function index(){
				if($this->session->userdata('logged_in')){
					$data['page'] = 'viewuser';

					$data['login'] = $this->session->userdata('logged_in');
					$this->load->view('template', $data);
				}else
					redirect(site_url());
			}

			function getDataUser(){
    			$this->load->model('Usermodel');
				$data=array(
					'start'=>$_POST['start'],
					'length'=>$_POST['length'],
					'filtervalue'=>$_POST['filtervalue'],
					'filtertext'=>$_POST['filtertext'],
				);
				$res=$this->Usermodel->getDataUser($data);
				echo json_encode($res);
			}

			function getUser(){
				$this->load->model('Usermodel');
				$res=$this->Usermodel->getUser($_POST['id']);
				echo json_encode($res);
			}

			function saveUser(){
				$data=array(
					'Username'=>$_POST['Username'], 
					'Password'=>$_POST['Password'], 
					'NamaKaryawan'=>$_POST['NamaKaryawan'],
					'Role'=>$_POST['Role'],
				);
				$this->load->model('Usermodel'); 
				$res=$this->Usermodel->insertUser($data);
				echo $res;
			}

			function updateUser(){
				$data=array(
					'IdLogin'=>$_POST['IdLogin'],
					'Username'=>$_POST['Username'], 
					'Password'=>$_POST['Password'], 
					'NamaKaryawan'=>$_POST['NamaKaryawan'],
					'Role'=>$_POST['Role'],
				);
				$this->load->model('Usermodel'); 
				$res=$this->Usermodel->updateUser($data);
				echo $res;
			}

			function deleteUser(){
				$data=array(
					'IdLogin'=>$_POST['id'],
				);
				$this->load->model('Usermodel'); 
				$res=$this->Usermodel->deleteUser($data);
				echo $res;
			}

			function filterUser(){
				$data=array(
					'filterValue'=>$_POST['filterValue'],
					'filterText'=>$_POST['filterText'],
				);
				$this->load->model('Usermodel'); 
				$res=$this->Usermodel->filterUser($data);
				echo json_encode($res);
			}
		}
?>