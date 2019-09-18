<?php
	if(!defined('BASEPATH'))exit('No direct script access allowed');
		class Callback extends CI_Controller{
			function __construct(){
				parent::__construct();
			}
			function index($return){
				$apiKey = 'bf1c0cb009ad8fe0d2280d7bda7a8155'; // Your api key
				$merchantCode = isset($_POST['merchantCode']) ? $_POST['merchantCode'] : null; 
				$amount = isset($_POST['amount']) ? $_POST['amount'] : null; 
				$merchantOrderId = isset($_POST['merchantOrderId']) ? $_POST['merchantOrderId'] : null; 
				$productDetail = isset($_POST['productDetail']) ? $_POST['productDetail'] : null; 
				$additionalParam = isset($_POST['additionalParam']) ? $_POST['additionalParam'] : null; 
				$paymentMethod = isset($_POST['paymentCode']) ? $_POST['paymentCode'] : null; 
				$resultCode = isset($_POST['resultCode']) ? $_POST['resultCode'] : null; 
				$merchantUserId = isset($_POST['merchantUserId']) ? $_POST['merchantUserId'] : null; 
				$reference = isset($_POST['reference']) ? $_POST['reference'] : null; 
				$signature = isset($_POST['signature']) ? $_POST['signature'] : null; 

				$issuer_name = isset($_POST['issuer_name']) ? $_POST['issuer_name'] : null; // Hanya untuk ATM Bersama
				$issuer_bank = isset($_POST['issuer_bank']) ? $_POST['issuer_bank'] : null; // Hanya untuk ATM Bersama

				if(!empty($merchantCode) && !empty($amount) && !empty($merchantOrderId) && !empty($signature))
				{
				    $params = $merchantCode . $amount . $merchantOrderId . $apiKey;
				    $calcSignature = md5($params);

				    if($signature == $calcSignature) {
				        //Your code here
				        
						if($resultCode == "00") {
						   echo "SUCCESS"; // Save to database
					   	} else {
				            echo "FAILED"; // Please update the status to FAILED in database
				        }
				    }
				    else {
				        throw new Exception('Bad Signature');
				    }
				}
				else {
				    throw new Exception('Bad Parameter');
				}
			}

			function FinishPayment(){
				// $kode = $_GET['resultCode'];
				$code = $this->input->get('resultCode', TRUE);
				
				// echo $merchantOrderId;
				if ($code == 02 || $code == 01){
					redirect(site_url('Penjualannewcontroller/'));
				} else {
					$merchantOrderId = $this->input->get('merchantOrderId', TRUE);
					$reference = $this->input->get('reference', TRUE);
					$this->load->model('Penjualanmodel'); 
					$data = array(
						'NoTransDuitku'=>$merchantOrderId,
						'Status'=>'Lunas',
					);
					$res=$this->Penjualanmodel->updatePenjualan2($data);
					redirect(site_url('Penjualannewcontroller/'));
				}
			}
			function FinishPayment2(){
				// $kode = $_GET['resultCode'];
				$code = $this->input->get('resultCode', TRUE);
				
				// echo $merchantOrderId;
				if ($code == 02 || $code == 01){
					redirect(site_url('Belicontroller/'));
				} else {
					$merchantOrderId = $this->input->get('merchantOrderId', TRUE);
					$reference = $this->input->get('reference', TRUE);
					$this->load->model('Penjualanmodel'); 
					$data = array(
						'NoTransDuitku'=>$merchantOrderId,
						'Status'=>'Lunas',
					);
					$res=$this->Penjualanmodel->updatePenjualan2($data);
					redirect(site_url('Belicontroller/pembelian'));
				}
			}
		}
?>