<?php
	if(!defined('BASEPATH'))exit('No direct script access allowed');
		class Promocontroller extends CI_Controller{
			function __construct(){
				parent::__construct();
			}
			function index(){
				if($this->session->userdata('logged_in')){
					$data['page'] = 'viewpromo';

					$data['login'] = $this->session->userdata('logged_in');
					$this->load->view('template', $data);
				}else
					redirect(site_url());
			}

			function getData(){
    			$this->load->model('Promomodel');
				$data=array(
					'start'=>$_POST['start'],
					'length'=>$_POST['length'],
					'filtervalue'=>$_POST['filtervalue'],
					'filtertext'=>$_POST['filtertext'],
				);
				$res=$this->Promomodel->getDataPromo($data);
				echo json_encode($res);
			}

			function getDataSelect(){
				$this->load->model('Promomodel');
				$res=$this->Promomodel->getPromo($_POST['id']);
				echo json_encode($res);
			}

			function save(){
				$data=array(
					'MinTiket'=>$_POST['MinTiket'],
					'DiskonPromo'=>$_POST['DiskonPromo'],
				);
				$this->load->model('Promomodel'); 
				$res=$this->Promomodel->insertPromo($data);
				echo $res;
			}

			function update(){
				$data=array(
					'IdPromo'=>$_POST['IdPromo'],
					'MinTiket'=>$_POST['MinTiket'],
					'DiskonPromo'=>$_POST['DiskonPromo'],
				);
				$this->load->model('Promomodel'); 
				$res=$this->Promomodel->updatePromo($data);
				echo $res;
			}

			function delete(){
				$data=array(
					'IdPromo'=>$_POST['id'],
				);
				$this->load->model('Promomodel'); 
				$res=$this->Promomodel->deletePromo($data);
				echo $res;
			}

		}
?>