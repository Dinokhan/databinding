<?php
	if(!defined('BASEPATH'))exit('No direct script access allowed');
		class Dashboardcontroller extends CI_Controller{
			function __construct(){
				parent::__construct();
			}
			function index(){
				if($this->session->userdata('logged_in')){
					// $this->load->view('viewDashboard');
					$data['page'] = 'viewdashboard';

					$data['login'] = $this->session->userdata('logged_in');
					$this->load->view('template', $data);
				}else
					redirect(site_url());
			}
		}
?>