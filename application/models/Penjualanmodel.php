<?php
class Penjualanmodel extends CI_Model{
	public function getDataPenjualan($data){
		$queryall = $this->db->get('penjualan');
		$sql = "SELECT * FROM penjualannew where Status<>'' and " .$data['filtervalue']. " like '%" .$data['filtertext']. "%' limit ".$data["start"].",".$data['length'];
		$query = $this->db->query($sql);
    	$data = $query->result();
    	$total = $queryall->num_rows();
    	$dataRecord = array(
    		"RecordsTotal" => $total,
    		"RecordsFiltered" => $total,
    		"Data" => $data,
		);
		return $dataRecord;
	}
	public function getDataPenjualan2($data, $IdMember){
		$queryall = $this->db->get('penjualan');
		$sql = "SELECT * FROM penjualannew where Status<>'' and IdMember=".$IdMember. " and " .$data['filtervalue']. " like '%" .$data['filtertext']. "%' limit ".$data["start"].",".$data['length'];
		$query = $this->db->query($sql);
    	$data = $query->result();
    	$total = $queryall->num_rows();
    	$dataRecord = array(
    		"RecordsTotal" => $total,
    		"RecordsFiltered" => $total,
    		"Data" => $data,
		);
		return $dataRecord;
	}
	public function getDataPenjualanAkun($data, $IdMember){
		$queryall = $this->db->get('penjualan');
		$sql = "SELECT * FROM penjualannew where Status<>'' and IdMember=".$IdMember. " and " .$data['filtervalue']. " like '%" .$data['filtertext']. "%' limit ".$data["start"].",".$data['length'];
		$query = $this->db->query($sql);
    	$data = $query->result();
    	$total = $queryall->num_rows();
    	$dataRecord = array(
    		"RecordsTotal" => $total,
    		"RecordsFiltered" => $total,
    		"Data" => $data,
		);
		return $dataRecord;
	}
	public function getPenjualanTiket($IdPenjualan){
		$queryall = $this->db->get('penjualan');
		$sql = "SELECT *, tim2.NamaTim as Tim2, tim.NamaTim as Tim1 FROM penjualannew left join detilpenjualan on penjualannew.NoPenjualan=detilpenjualan.IdPenjualan left join jadwal on detilpenjualan.IdJadwal=jadwal.IdJadwal left join tim on jadwal.Tim1=tim.IdTim left join tim as tim2 on jadwal.Tim2=tim2.IdTim left join stadion on jadwal.IdStadion=stadion.IdStadion where penjualannew.IdPenjualan=$IdPenjualan and penjualannew.Status<>''";
		$query = $this->db->query($sql);
    	$data = $query->result();
    	$total = $queryall->num_rows();
    	$dataRecord = array(
    		"RecordsTotal" => $total,
    		"RecordsFiltered" => $total,
    		"Data" => $data,
		);
		return $dataRecord;
	}
	public function getPenjualan($IdPenjualan){
		$sql = "SELECT * FROM penjualannew WHERE IdPenjualan=$IdPenjualan";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function insertPenjualan($data){
		$query = $this->db->insert('penjualannew', $data); 
		return $query;
	}
	public function insertDetilPenjualan($data){
		$query = $this->db->insert('detilpenjualan', $data); 
		return $query;
	}
	public function updatePenjualan($data){
		$this->db->where('IdPenjualan',$data['IdPenjualan']); 
		$query=$this->db->update('penjualannew',$data); 
		return $query;
	}
	public function updatePenjualan2($data){
		$this->db->where('NoTransDuitku',$data['NoTransDuitku']); 
		$query=$this->db->update('penjualannew',$data); 
		return $query;
	}
	public function deletePenjualan($data){
		$query=$this->db->delete('penjualannew',$data); 
		return $query;
	}
}
?>