<?php
class Promomodel extends CI_Model{
	public function getDataPromo($data){
		$queryall = $this->db->get('promo');
		$sql = "SELECT * FROM promo where " .$data['filtervalue']. " like '%" .$data['filtertext']. "%' limit ".$data["start"].",".$data['length'];
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
	public function getPromo($IdPromo){
		$sql = "SELECT * FROM promo WHERE IdPromo=$IdPromo";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function insertPromo($data){
		$query = $this->db->insert('promo', $data); 
		return $query;
	}
	public function updatePromo($data){
		$this->db->where('IdPromo',$data['IdPromo']); 
		$query=$this->db->update('promo',$data); 
		return $query;
	}
	public function deletePromo($data){
		$query=$this->db->delete('promo',$data); 
		return $query;
	}
}
?>