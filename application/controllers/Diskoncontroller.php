<?php
	if(!defined('BASEPATH'))exit('No direct script access allowed');
		class Diskoncontroller extends CI_Controller{
			function __construct(){
				parent::__construct();
			}
			function index(){
				if($this->session->userdata('logged_in')){
					$data['page'] = 'viewdiskon';

					$data['login'] = $this->session->userdata('logged_in');
					$this->load->view('template', $data);
				}else
					redirect(site_url());
			}

			function getData(){
    			$this->load->model('Diskonmodel');
				$data=array(
					'start'=>$_POST['start'],
					'length'=>$_POST['length'],
					'filtervalue'=>$_POST['filtervalue'],
					'filtertext'=>$_POST['filtertext'],
				);
				$res=$this->Diskonmodel->getDataDiskon($data);
				echo json_encode($res);
			}

			function getDataSelect(){
				$this->load->model('Diskonmodel');
				$res=$this->Diskonmodel->getDiskon($_POST['id']);
				echo json_encode($res);
			}

			function save(){
				$data=array(
					'Member'=>$_POST['Member'], 
					'MinPembelian'=>$_POST['MinPembelian'],
					'Diskon'=>$_POST['Diskon'],
					'Status'=>$_POST['Status'],
				);
				$this->load->model('Diskonmodel'); 
				$res=$this->Diskonmodel->insertDiskon($data);
				echo $res;
			}

			function update(){
				$data=array(
					'IdDiskon'=>$_POST['IdDiskon'],
					'Member'=>$_POST['Member'], 
					'MinPembelian'=>$_POST['MinPembelian'],
					'Diskon'=>$_POST['Diskon'],
					'Status'=>$_POST['Status'], 
				);
				$this->load->model('Diskonmodel'); 
				$res=$this->Diskonmodel->updateDiskon($data);
				echo $res;
			}

			function delete(){
				$data=array(
					'IdDiskon'=>$_POST['id'],
				);
				$this->load->model('Diskonmodel'); 
				$res=$this->Diskonmodel->deleteDiskon($data);
				echo $res;
			}

		}
?>