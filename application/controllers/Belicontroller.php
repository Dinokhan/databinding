<?php
	if(!defined('BASEPATH'))exit('No direct script access allowed');
		class Belicontroller extends CI_Controller{
			function __construct(){
				parent::__construct();
			}
			function index(){
				if($this->session->userdata('logged_in')){
					// $this->load->view('viewDashboard');
					$data['page'] = 'viewdashboard2';

					$data['login'] = $this->session->userdata('logged_in');
					$this->load->view('template2', $data);
				}else
					redirect(site_url());
			}
			function jadwal(){
				if($this->session->userdata('logged_in')){
					// $this->load->view('viewDashboard');
					$data['page'] = 'jadwalpertandingan';

					$data['login'] = $this->session->userdata('logged_in');
					$this->load->view('template2', $data);
				}else
					redirect(site_url());
			}
			function promo(){
				if($this->session->userdata('logged_in')){
					// $this->load->view('viewDashboard');
					$data['page'] = 'promomember';

					$data['login'] = $this->session->userdata('logged_in');
					$this->load->view('template2', $data);
				}else
					redirect(site_url());
			}
			function editprofile(){
				if($this->session->userdata('logged_in')){
					// $this->load->view('viewDashboard');
					$data['page'] = 'editprofile';

					$data['login'] = $this->session->userdata('logged_in');
					$this->load->model('Kelasmodel');
					$data['kelas'] = $this->Kelasmodel->getKelasAll();
					$this->load->view('template2', $data);
				}else
					redirect(site_url());
			}
			function pembelian(){
				if($this->session->userdata('logged_in')){
					// $this->load->view('viewDashboard');
					$data['page'] = 'pembeliantiket2';

					$data['login'] = $this->session->userdata('logged_in');
					$this->load->model('Kelasmodel');
					$data['kelas'] = $this->Kelasmodel->getKelasAll();
					$this->load->view('template2', $data);
				}else
					redirect(site_url());
			}
		}
?>