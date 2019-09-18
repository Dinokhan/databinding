<?php
	if(!defined('BASEPATH'))exit('No direct script access allowed');
		class Pemesanancontroller extends CI_Controller{
			function __construct(){
				parent::__construct();
			}
			function index(){
				if($this->session->userdata('logged_in')){
					$data['page'] = 'viewpemesanan';

					$data['login'] = $this->session->userdata('logged_in');
					$this->load->model('Kelasmodel');
					$data['kelas'] = $this->Kelasmodel->getKelasAll();
					$this->load->view('template', $data);
				}else
					redirect(site_url());
			}

			function getData(){
    			$this->load->model('Pemesananmodel');
				$data=array(
					'start'=>$_POST['start'],
					'length'=>$_POST['length'],
					'filtervalue'=>$_POST['filtervalue'],
					'filtertext'=>$_POST['filtertext'],
				);
				$res=$this->Pemesananmodel->getDataPemesanan($data);
				echo json_encode($res);
			}

			function getDataSelect(){
				$this->load->model('Pemesananmodel');
				$res=$this->Pemesananmodel->getPemesanan($_POST['id']);
				echo json_encode($res);
			}

		}
?>