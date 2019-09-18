<?php
	if(!defined('BASEPATH'))exit('No direct script access allowed');
		class Kelascontroller extends CI_Controller{
			function __construct(){
				parent::__construct();
			}
			function index(){
				if($this->session->userdata('logged_in')){
					$data['page'] = 'viewkelas';

					$data['login'] = $this->session->userdata('logged_in');
					$this->load->view('template', $data);
				}else
					redirect(site_url());
			}

			function getData(){
    			$this->load->model('Kelasmodel');
				$data=array(
					'start'=>$_POST['start'],
					'length'=>$_POST['length'],
					'filtervalue'=>$_POST['filtervalue'],
					'filtertext'=>$_POST['filtertext'],
				);
				$res=$this->Kelasmodel->getDataKelas($data);
				echo json_encode($res);
			}

			function getDataSelect(){
				$this->load->model('Kelasmodel');
				$res=$this->Kelasmodel->getKelas($_POST['id']);
				echo json_encode($res);
			}

			function save(){
				$data=array(
					'Kelas'=>$_POST['Kelas'],
					'Harga'=>$_POST['Harga'],
				);
				$this->load->model('Kelasmodel'); 
				$res=$this->Kelasmodel->insertKelas($data);
				echo $res;
			}

			function update(){
				$data=array(
					'IdKelas'=>$_POST['IdKelas'],
					'Kelas'=>$_POST['Kelas'],
					'Harga'=>$_POST['Harga'],
				);
				$this->load->model('Kelasmodel'); 
				$res=$this->Kelasmodel->updateKelas($data);
				echo $res;
			}

			function delete(){
				$data=array(
					'IdKelas'=>$_POST['id'],
				);
				$this->load->model('Kelasmodel'); 
				$res=$this->Kelasmodel->deleteKelas($data);
				echo $res;
			}

		}
?>