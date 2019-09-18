<?php
	if(!defined('BASEPATH'))exit('No direct script access allowed');
		class Rekappesancontroller extends CI_Controller{
			function __construct(){
				parent::__construct();
			}
			function index(){
				if($this->session->userdata('logged_in')){
					// $this->load->view('viewDashboard');
					$data['page'] = 'viewreportpenjualan';

					$data['login'] = $this->session->userdata('logged_in');
					$this->load->view('template', $data);
				}else
					redirect(site_url());
			}
			function member(){
				if($this->session->userdata('logged_in')){
					// $this->load->view('viewDashboard');
					$data['page'] = 'viewmemberreport';

					$data['login'] = $this->session->userdata('logged_in');
					$this->load->view('template', $data);
				}else
					redirect(site_url());
			}
		}
?>