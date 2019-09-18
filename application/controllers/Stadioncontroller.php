<?php
	if(!defined('BASEPATH'))exit('No direct script access allowed');
		class Stadioncontroller extends CI_Controller{
			function __construct(){
				parent::__construct();
			}
			function index(){
				if($this->session->userdata('logged_in')){
					$data['page'] = 'viewstadion';

					$data['login'] = $this->session->userdata('logged_in');
					$this->load->view('template', $data);
				}else
					redirect(site_url());
			}

			function getData(){
    			$this->load->model('Stadionmodel');
				$data=array(
					'start'=>$_POST['start'],
					'length'=>$_POST['length'],
					'filtervalue'=>$_POST['filtervalue'],
					'filtertext'=>$_POST['filtertext'],
				);
				$res=$this->Stadionmodel->getDataStadion($data);
				echo json_encode($res);
			}

			function getDataSelect(){
				$this->load->model('Stadionmodel');
				$res=$this->Stadionmodel->getStadion($_POST['id']);
				echo json_encode($res);
			}

			function save(){
				$data=array(
					'NamaStadion'=>$_POST['NamaStadion'],
					'Kapasitas'=>$_POST['Kapasitas'],
				);
				$this->load->model('Stadionmodel'); 
				$res=$this->Stadionmodel->insertStadion($data);
				echo $res;
			}

			function update(){
				$data=array(
					'IdStadion'=>$_POST['IdStadion'],
					'NamaStadion'=>$_POST['NamaStadion'],
					'Kapasitas'=>$_POST['Kapasitas'],
				);
				$this->load->model('Stadionmodel'); 
				$res=$this->Stadionmodel->updateStadion($data);
				echo $res;
			}

			function delete(){
				$data=array(
					'IdStadion'=>$_POST['id'],
				);
				$this->load->model('Stadionmodel'); 
				$res=$this->Stadionmodel->deleteStadion($data);
				echo $res;
			}

		}
?>