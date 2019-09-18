<?php
    if(!defined('BASEPATH'))exit('No direct script access allowed');
        class Penjualancontroller extends CI_Controller{
            function __construct(){
                parent::__construct();
            }
            function index(){
                if($this->session->userdata('logged_in')){
                    $data['page'] = 'viewpenjualan';

                    // $data['login'] = $this->session->userdata('logged_in');
                    // $this->load->model('Kelasmodel');
                    // $data['kelas'] = $this->Kelasmodel->getKelasAll();
                    $this->load->view('template', $data);
                }else
                    redirect(site_url());
            }

            function getData(){
                $this->load->model('Penjualanmodel');
                $data=array(
                    'start'=>$_POST['start'],
                    'length'=>$_POST['length'],
                    'filtervalue'=>$_POST['filtervalue'],
                    'filtertext'=>$_POST['filtertext'],
                );
                $res=$this->Penjualanmodel->getDataPenjualan($data);
                echo json_encode($res);
            }

            function getDataSelect(){
                $this->load->model('Penjualanmodel');
                $res=$this->Penjualanmodel->getPenjualan($_POST['id']);
                echo json_encode($res);
            }

            function save(){
                $data=array(
                    'Tanggal'=>$_POST['Tanggal'],
                    'IdJadwal'=>$_POST['IdJadwal'],
                    'JumlahTotal'=>$_POST['JumlahTotal'],
                    'NoMember'=>$_POST['NoMember'],
                    'IdDiskon'=>$_POST['IdDiskon'],
                    'Harga'=>$_POST['Harga'],
                    'TotalHarga'=>$_POST['TotalHarga'],
                    'Status'=>$_POST['Status'],
                );
                $this->load->model('Penjualanmodel'); 
                $res=$this->Penjualanmodel->insertPenjualan($data);
                echo $res;
            }

            function update(){
                $data=array(
                    'IdPenjualan'=>$_POST['IdPenjualan'],
                    'Tanggal'=>$_POST['Tanggal'],
                    'IdJadwal'=>$_POST['IdJadwal'],
                    'JumlahTotal'=>$_POST['JumlahTotal'],
                    'NoMember'=>$_POST['NoMember'],
                    'IdDiskon'=>$_POST['IdDiskon'],
                    'Harga'=>$_POST['Harga'],
                    'TotalHarga'=>$_POST['TotalHarga'],
                    'Status'=>$_POST['Status'],
                );
                $this->load->model('Penjualanmodel'); 
                $res=$this->Penjualanmodel->updatePenjualan($data);
                echo $res;
            }

            function delete(){
                $data=array(
                    'IdPenjualan'=>$_POST['id'],
                );
                $this->load->model('Penjualanmodel'); 
                $res=$this->Penjualanmodel->deletePenjualan($data);
                echo $res;
            }

        }
?>