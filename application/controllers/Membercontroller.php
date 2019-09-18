<?php
	if(!defined('BASEPATH'))exit('No direct script access allowed');
		class Membercontroller extends CI_Controller{
			function __construct(){
				parent::__construct();
			}
			function index(){
				if($this->session->userdata('logged_in')){
					$data['page'] = 'viewmember';

					$data['login'] = $this->session->userdata('logged_in');
					$this->load->model('Kelasmodel');
					$data['kelas'] = $this->Kelasmodel->getKelasAll();
					$this->load->view('template', $data);
				}else
					redirect(site_url());
			}

			function getData(){
    			$this->load->model('Membermodel');
				$data=array(
					'start'=>$_POST['start'],
					'length'=>$_POST['length'],
					'filtervalue'=>$_POST['filtervalue'],
					'filtertext'=>$_POST['filtertext'],
				);
				$res=$this->Membermodel->getDataMember($data);
				echo json_encode($res);
			}

			function getDataSelect(){
				$this->load->model('Membermodel');
				$res=$this->Membermodel->getMember($_POST['id']);
				echo json_encode($res);
			}

			function save(){
				$config['upload_path'] = './imgmember/';
		        $config['allowed_types'] = 'gif|jpg|jpeg|png';
		        // $config['max_size'] = 1024 * 8;
		        $config['encrypt_name'] = TRUE;
		        $this->load->library('upload', $config);
		        $file_element_name = 'userfile';

				$data=array(
					'NoMember'=>$_POST['NoMember'], 
					'NamaMember'=>$_POST['NamaMember'],
					'NoKtp'=>$_POST['NoKtp'],
					'Status'=>$_POST['Status'],
					'username'=>$_POST['username'],
					'password'=>$_POST['password'],
					'email'=>$_POST['email'],
					'IdKelas'=>$_POST['IdKelas'],
				);
				if ($this->upload->do_upload($file_element_name)){
		        	$uploadData = $this->upload->data();
		        	$data['photo'] = $uploadData['file_name'];
		        }
				$this->load->model('Membermodel'); 
				$res=$this->Membermodel->insertMember($data);
				echo $res;
			}

			function update(){
				$config['upload_path'] = './imgmember/';
		        $config['allowed_types'] = 'gif|jpg|jpeg|png';
		        // $config['max_size'] = 1024 * 8;
		        $config['encrypt_name'] = TRUE;
		        $this->load->library('upload', $config);
		        $file_element_name = 'userfile';

				$data=array(
					'IdMember'=>$_POST['IdMember'], 
					'NoMember'=>$_POST['NoMember'], 
					'NamaMember'=>$_POST['NamaMember'],
					'NoKtp'=>$_POST['NoKtp'],
					'Status'=>$_POST['Status'],
					'username'=>$_POST['username'],
					'password'=>$_POST['password'],
					'email'=>$_POST['email'],
					'IdKelas'=>$_POST['IdKelas'],
				);
				if ($this->upload->do_upload($file_element_name)){
		        	$uploadData = $this->upload->data();
		        	$data['photo'] = $uploadData['file_name'];
		        }
				$this->load->model('Membermodel'); 
				$res=$this->Membermodel->updateMember($data);
				echo $res;
			}

			function delete(){
				$data=array(
					'IdMember'=>$_POST['id'],
				);
				$this->load->model('Membermodel'); 
				$res=$this->Membermodel->deleteMember($data);
				echo $res;
			}

		}
?>