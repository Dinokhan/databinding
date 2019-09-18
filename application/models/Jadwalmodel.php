<?php
class Jadwalmodel extends CI_Model{
	public function getDataJadwal($data){
		$queryall = $this->db->get('jadwal');
		$sql = "SELECT *, tim2.NamaTim as Tim2, tim.NamaTim as Tim1 FROM jadwal left join tim on jadwal.Tim1=tim.IdTim left join tim as tim2 on jadwal.Tim2=tim2.IdTim left join stadion on jadwal.IdStadion=stadion.IdStadion where " .$data['filtervalue']. " like '%" .$data['filtertext']. "%' limit ".$data["start"].",".$data['length'];
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
	public function getDataJadwal2($data){
		$queryall = $this->db->get('jadwal');
		$sql = "SELECT *, tim2.NamaTim as Tim2, tim.NamaTim as Tim1 FROM jadwal left join tim on jadwal.Tim1=tim.IdTim left join tim as tim2 on jadwal.Tim2=tim2.IdTim left join stadion on jadwal.IdStadion=stadion.IdStadion where " .$data['filtervalue']. " like '%" .$data['filtertext']. "%' limit ".$data["start"].",".$data['length'];
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
	public function getCountBeli($IdJadwal){
		$queryall = $this->db->get('jadwal');
		$sql = "Select count(*) as sumjadwal from detilpenjualan where IdJadwal=".$IdJadwal;
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function getStadion1($IdStadion){
		$queryall = $this->db->get('jadwal');
		$sql = "Select * from stadion where IdStadion=".$IdStadion;
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function getJadwal($IdJadwal){
		$sql = "SELECT *, tim2.NamaTim as Tim2, tim.NamaTim as Tim1 FROM jadwal left join tim on jadwal.Tim1=tim.IdTim left join tim as tim2 on jadwal.Tim2=tim2.IdTim WHERE IdJadwal=$IdJadwal";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function getTimAll(){
		$sql = "SELECT * FROM tim";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function getStadionAll(){
		$sql = "SELECT * FROM stadion";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function insertJadwal($data){
		$query = $this->db->insert('jadwal', $data); 
		return $query;
	}
	public function updateJadwal($data){
		$this->db->where('IdJadwal',$data['IdJadwal']); 
		$query=$this->db->update('jadwal',$data); 
		return $query;
	}
	public function deleteJadwal($data){
		$query=$this->db->delete('jadwal',$data); 
		return $query;
	}
}
?>