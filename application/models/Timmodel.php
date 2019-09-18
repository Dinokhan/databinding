<?php
class Timmodel extends CI_Model{
	public function getDataTim($data){
		$queryall = $this->db->get('tim');
		$sql = "SELECT * FROM tim where " .$data['filtervalue']. " like '%" .$data['filtertext']. "%' limit ".$data["start"].",".$data['length'];
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
	public function getTim($IdTim){
		$sql = "SELECT * FROM tim WHERE IdTim=$IdTim";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function insertTim($data){
		$query = $this->db->insert('tim', $data); 
		return $query;
	}
	public function updateTim($data){
		$this->db->where('IdTim',$data['IdTim']); 
		$query=$this->db->update('tim',$data); 
		return $query;
	}
	public function deleteTim($data){
		$query=$this->db->delete('tim',$data); 
		return $query;
	}
}
?>