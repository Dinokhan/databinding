<?php
	if(!defined('BASEPATH'))exit('No direct script access allowed');
		class Timcontroller extends CI_Controller{
			function __construct(){
				parent::__construct();
			}
			function index(){
				if($this->session->userdata('logged_in')){
					$data['page'] = 'viewtim';

					$data['login'] = $this->session->userdata('logged_in');
					$this->load->view('template', $data);
				}else
					redirect(site_url());
			}

			function getData(){
    			$this->load->model('Timmodel');
				$data=array(
					'start'=>$_POST['start'],
					'length'=>$_POST['length'],
					'filtervalue'=>$_POST['filtervalue'],
					'filtertext'=>$_POST['filtertext'],
				);
				$res=$this->Timmodel->getDataTim($data);
				echo json_encode($res);
			}

			function getDataSelect(){
				$this->load->model('Timmodel');
				$res=$this->Timmodel->getTim($_POST['id']);
				echo json_encode($res);
			}

			function save(){
				$data=array(
					'NamaTim'=>$_POST['NamaTim'],
				);
				$this->load->model('Timmodel'); 
				$res=$this->Timmodel->insertTim($data);
				echo $res;
			}

			function update(){
				$data=array(
					'IdTim'=>$_POST['IdTim'],
					'NamaTim'=>$_POST['NamaTim'],
				);
				$this->load->model('Timmodel'); 
				$res=$this->Timmodel->updateTim($data);
				echo $res;
			}

			function delete(){
				$data=array(
					'IdTim'=>$_POST['id'],
				);
				$this->load->model('Timmodel'); 
				$res=$this->Timmodel->deleteTim($data);
				echo $res;
			}

		}
?>