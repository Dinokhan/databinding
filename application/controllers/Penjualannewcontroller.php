<?php
	if(!defined('BASEPATH'))exit('No direct script access allowed');
		class Penjualannewcontroller extends CI_Controller{
			function __construct(){
				parent::__construct();
			}
			function index(){
				if($this->session->userdata('logged_in')){
					$data['page'] = 'viewpenjualan2';

					$data['login'] = $this->session->userdata('logged_in');
					$this->load->model('Kelasmodel');
					$data['kelas'] = $this->Kelasmodel->getKelasAll();
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

			function getData2(){
    			$this->load->model('Penjualanmodel');
				$data=array(
					'start'=>$_POST['start'],
					'length'=>$_POST['length'],
					'filtervalue'=>$_POST['filtervalue'],
					'filtertext'=>$_POST['filtertext'],
				);
				$res=$this->Penjualanmodel->getDataPenjualan2($data, $_POST['IdMember']);
				echo json_encode($res);
			}

			function getDataAkun(){
    			$this->load->model('Penjualanmodel');
				$data=array(
					'start'=>$_POST['start'],
					'length'=>$_POST['length'],
					'filtervalue'=>$_POST['filtervalue'],
					'filtertext'=>$_POST['filtertext'],
				);
				$res=$this->Penjualanmodel->getDataPenjualanAkun($data, $this->session->userdata('logged_in')['IdMember']);
				echo json_encode($res);
			}

			function getDataSelect(){
				$this->load->model('Penjualanmodel');
				$res=$this->Penjualanmodel->getPenjualan($_POST['id']);
				echo json_encode($res);
			}

			function getDataSelectTiket(){
				$this->load->model('Penjualanmodel');
				$res=$this->Penjualanmodel->getPenjualanTiket($_POST['id']);
				echo json_encode($res);
			}

			function save(){
				$data=array(
					'NoPenjualan'=>$_POST['NoPenjualan'],
					'Tanggal'=>$_POST['Tanggal'],
					'IdMember'=>$_POST['IdMember'],
					'NoMember'=>$_POST['NoMember'],
					'Nama'=>$_POST['Nama'],
					'Ktp'=>$_POST['Ktp'],
					'Status'=>$_POST['Status'],
					'TotalHarga'=>$_POST['TotalHarga'],
					'IdPromo'=>$_POST['IdPromo'],
					'DiskonPromo'=>$_POST['DiskonPromo'],
					'TipePenjualan'=>$_POST['TipePenjualan'],
				);
				$this->load->model('Penjualanmodel'); 
				$res=$this->Penjualanmodel->insertPenjualan($data);
				echo $res;
			}

			function savedetil(){
				$data=array(
					'NoTiket'=>$_POST['NoTiket'],
					'IdJadwal'=>$_POST['IdJadwal'],
					'Harga'=>$_POST['Harga'],
					'Jadwal'=>$_POST['Jadwal'],
					'IdPenjualan'=>$_POST['IdPenjualan'],
				);
				$this->load->model('Penjualanmodel'); 
				$res=$this->Penjualanmodel->insertDetilPenjualan($data);
				echo $res;
			}

			function duitkubayar(){
                $merchantCode = 'D4148'; // from duitku
                $merchantKey = 'bf1c0cb009ad8fe0d2280d7bda7a8155'; // from duitku
                $paymentAmount = $_POST['TotalHarga'];
                $paymentMethod = $_POST['PaymentDuitku']; // WW = duitku wallet, VC = Credit Card, MY = Mandiri Clickpay, BK = BCA KlikPay
                $merchantOrderId = time(); // from merchant, unique
                $productDetails = 'Tiket Bonek';
                $email = $_POST['Email']; // your customer email
                $phoneNumber = $_POST['Phone']; // your customer phone number (optional)
                $additionalParam = ''; // optional
                $merchantUserInfo = ''; // optional
                // $callbackUrl = 'http://tiketbonek.com/etiket/index.php/Callback'; // url for callback
                $callbackUrl = 'http://localhost/etiket/index.php/Callback'; // url for callback
                if ($_POST['TipePenjualan'] == "offline") {
                	// $returnUrl = 'http://tiketbonek.com/etiket/index.php/Callback/FinishPayment';
                	$returnUrl = 'http://localhost/etiket/index.php/Callback/FinishPayment';
            	} else {
                	// $returnUrl = 'http://tiketbonek.com/etiket/index.php/Callback/FinishPayment2';
                	$returnUrl = 'http://localhost/etiket/index.php/Callback/FinishPayment2';

            	} // url for redirect

                $signature = md5($merchantCode . $merchantOrderId . $paymentAmount . $merchantKey);

                $itemDetails = json_decode($_POST['detil']);
                $itemDetails2 = json_decode($_POST['detil2']);

                $params = array(
                    'merchantCode' => $merchantCode,
                    'paymentAmount' => $paymentAmount,
                    'paymentMethod' => $paymentMethod,
                    'merchantOrderId' => $merchantOrderId,
                    'productDetails' => $productDetails,
                    'additionalParam' => $additionalParam,
                    'merchantUserInfo' => $merchantUserInfo,
                    'email' => $email,
                    'phoneNumber' => $phoneNumber,
                    'itemDetails' => $itemDetails,
                    'callbackUrl' => $callbackUrl,
                    'returnUrl' => $returnUrl,
                    'signature' => $signature
                );

                $data=array(
					'NoPenjualan'=>$_POST['NoPenjualan'],
					'Tanggal'=>$_POST['Tanggal'],
					'IdMember'=>$_POST['IdMember'],
					'NoMember'=>$_POST['NoMember'],
					'Nama'=>$_POST['Nama'],
					'Ktp'=>$_POST['Ktp'],
					'Status'=>$_POST['Status'],
					'TotalHarga'=>$_POST['TotalHarga'],
					'IdPromo'=>$_POST['IdPromo'],
					'DiskonPromo'=>$_POST['DiskonPromo'],
					'TipePenjualan'=>$_POST['TipePenjualan'],
					'NoTransDuitku'=>$merchantOrderId,
					'PaymentDuitku'=> $_POST['PaymentDuitku'],
				);
				$this->load->model('Penjualanmodel'); 
				$res=$this->Penjualanmodel->insertPenjualan($data);

				foreach ($itemDetails2 as $row) {
					$data=array(
						'NoTiket'=>$row->NoTiket,
						'IdJadwal'=>$row->IdJadwal,
						'Harga'=>$row->Harga,
						'Jadwal'=>$row->Jadwal,
						'IdPenjualan'=>$row->IdPenjualan,
					);
					$this->load->model('Penjualanmodel'); 
					$res=$this->Penjualanmodel->insertDetilPenjualan($data);
				}

                $params_string = json_encode($params);
                // echo $params_string;
                $url = 'http://sandbox.duitku.com/webapi/api/merchant/inquiry'; // Sandbox
                // $url = 'https://passport.duitku.com/webapi/api/merchant/inquiry'; // Production
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, $url); 
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);                                                                  
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                    'Content-Type: application/json',                                                                                
                    'Content-Length: ' . strlen($params_string))                                                                       
                );   
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

                //execute post
                $request = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                if($httpCode == 200)
                {
                    $result = json_decode($request, true);
                    header('location: '. $result['paymentUrl']);
                    echo "paymentUrl :". $result['paymentUrl'] . "<br />";
                    echo "merchantCode :". $result['merchantCode'] . "<br />";
                    echo "reference :". $result['reference'] . "<br />";
                }
                else
                    echo $httpCode;
            }

			function update(){
				$data=array(
					'IdPenjualan'=>$_POST['IdPenjualan'],
					'NoPenjualan'=>$_POST['NoPenjualan'],
					'Tanggal'=>$_POST['Tanggal'],
					'NoMember'=>$_POST['NoMember'],
					'Nama'=>$_POST['Nama'],
					'Ktp'=>$_POST['Ktp'],
					'Status'=>$_POST['Status'],
					'TotalHarga'=>$_POST['TotalHarga'],
					'IdPromo'=>$_POST['IdPromo'],
					'DiskonPromo'=>$_POST['DiskonPromo'],
					'TipePenjualan'=>$_POST['TipePenjualan'],
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