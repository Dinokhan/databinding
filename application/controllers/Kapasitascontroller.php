<?php
	if(!defined('BASEPATH'))exit('No direct script access allowed');
		class Kapasitascontroller extends CI_Controller{
			function __construct(){
				parent::__construct();
			}
			function index(){
				if($this->session->userdata('logged_in')){
					$data['page'] = 'viewkapasitas';

					$data['login'] = $this->session->userdata('logged_in');
    				$this->load->model('Kelasmodel');
					$data['kelas'] = $this->Kelasmodel->getKelasAll();
					$this->load->view('template', $data);
				}else
					redirect(site_url());
			}

			function getData(){
    			$this->load->model('Kapasitasmodel');
				$data=array(
					'start'=>$_POST['start'],
					'length'=>$_POST['length'],
					'filtervalue'=>$_POST['filtervalue'],
					'filtertext'=>$_POST['filtertext'],
				);
				$res=$this->Kapasitasmodel->getDataKapasitas($data);
				echo json_encode($res);
			}

			function getDataSelect(){
				$this->load->model('Kapasitasmodel');
				$res=$this->Kapasitasmodel->getKapasitas($_POST['id']);
				echo json_encode($res);
			}

			function save(){
				$data=array(
					'IdKelas'=>$_POST['IdKelas'],
					'IdStadion'=>$_POST['IdStadion'],
					'KapasitasTempat'=>$_POST['KapasitasTempat'],
				);
				$this->load->model('Kapasitasmodel'); 
				$res=$this->Kapasitasmodel->insertKapasitas($data);
				echo $res;
			}

			function update(){
				$data=array(
					'IdKapasitas'=>$_POST['IdKapasitas'],
					'IdKelas'=>$_POST['IdKelas'],
					'IdStadion'=>$_POST['IdStadion'],
					'KapasitasTempat'=>$_POST['KapasitasTempat'],
				);
				$this->load->model('Kapasitasmodel'); 
				$res=$this->Kapasitasmodel->updateKapasitas($data);
				echo $res;
			}

			function delete(){
				$data=array(
					'IdKapasitas'=>$_POST['id'],
				);
				$this->load->model('Kapasitasmodel'); 
				$res=$this->Kapasitasmodel->deleteKapasitas($data);
				echo $res;
			}

		}
?>