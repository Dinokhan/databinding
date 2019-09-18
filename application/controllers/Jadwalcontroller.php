<?php
	if(!defined('BASEPATH'))exit('No direct script access allowed');
		class Jadwalcontroller extends CI_Controller{
			function __construct(){
				parent::__construct();
			}
			function index(){
				if($this->session->userdata('logged_in')){
					$data['page'] = 'viewjadwal';

					$data['login'] = $this->session->userdata('logged_in');
					$this->load->model('Jadwalmodel');
					$data['tim'] = $this->Jadwalmodel->getTimAll();
					$data['stadion'] = $this->Jadwalmodel->getStadionAll();
					$this->load->view('template', $data);
				}else
					redirect(site_url());
			}

			function getData(){
    			$this->load->model('Jadwalmodel');
				$data=array(
					'start'=>$_POST['start'],
					'length'=>$_POST['length'],
					'filtervalue'=>$_POST['filtervalue'],
					'filtertext'=>$_POST['filtertext'],
				);
				$res=$this->Jadwalmodel->getDataJadwal($data);
				echo json_encode($res);
			}

			function getData2(){
    			$this->load->model('Jadwalmodel');
				$data=array(
					'start'=>$_POST['start'],
					'length'=>$_POST['length'],
					'filtervalue'=>$_POST['filtervalue'],
					'filtertext'=>$_POST['filtertext'],
				);
				$res=$this->Jadwalmodel->getDataJadwal2($data);
				$res2 = array();
				// echo json_encode($res['Data']);
				foreach ($res['Data'] as $row) {
					$jadwal = $this->Jadwalmodel->getCountBeli($row->IdJadwal);
					$stadion = $this->Jadwalmodel->getStadion1($row->IdStadion);
					$row->Sisa = $stadion[0]->Kapasitas - $jadwal[0]->sumjadwal;
					array_push($res2, $row);
				}
				$res['Data'] = $res2;
				echo json_encode($res);
			}

			function getDataSelect(){
				$this->load->model('Jadwalmodel');
				$res=$this->Jadwalmodel->getJadwal($_POST['id']);
				echo json_encode($res);
			}

			function save(){
				$data=array(
					'Jadwal'=>$_POST['Jadwal'],
					'Tim1'=>$_POST['Tim1'],
					'Tim2'=>$_POST['Tim2'],
					'Jam'=>$_POST['Jam'],
					'IdStadion'=>$_POST['IdStadion'],
					'Status'=>$_POST['Status'],
					'HargaTiket'=>$_POST['HargaTiket'],
				);
				$this->load->model('Jadwalmodel'); 
				$res=$this->Jadwalmodel->insertJadwal($data);
				echo $res;
			}

			function update(){
				$data=array(
					'IdJadwal'=>$_POST['IdJadwal'],
					'Jadwal'=>$_POST['Jadwal'],
					'Tim1'=>$_POST['Tim1'],
					'Tim2'=>$_POST['Tim2'],
					'Jam'=>$_POST['Jam'],
					'IdStadion'=>$_POST['IdStadion'],
					'Status'=>$_POST['Status'],
					'HargaTiket'=>$_POST['HargaTiket'],
				);
				$this->load->model('Jadwalmodel'); 
				$res=$this->Jadwalmodel->updateJadwal($data);
				echo $res;
			}

			function delete(){
				$data=array(
					'IdJadwal'=>$_POST['id'],
				);
				$this->load->model('Jadwalmodel'); 
				$res=$this->Jadwalmodel->deleteJadwal($data);
				echo $res;
			}

		}
?>