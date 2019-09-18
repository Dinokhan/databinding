<?php
class Diskonmodel extends CI_Model{
	public function getDataDiskon($data){
		$queryall = $this->db->get('diskon');
		$sql = "SELECT * FROM diskon where " .$data['filtervalue']. " like '%" .$data['filtertext']. "%' limit ".$data["start"].",".$data['length'];
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
	public function getDiskon($IdDiskon){
		$sql = "SELECT * FROM diskon WHERE IdDiskon=$IdDiskon";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function insertDiskon($data){
		$query = $this->db->insert('diskon', $data); 
		return $query;
	}
	public function updateDiskon($data){
		$this->db->where('IdDiskon',$data['IdDiskon']); 
		$query=$this->db->update('diskon',$data); 
		return $query;
	}
	public function deleteDiskon($data){
		$query=$this->db->delete('diskon',$data); 
		return $query;
	}
}
?>