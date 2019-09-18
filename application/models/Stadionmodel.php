<?php
class Stadionmodel extends CI_Model{
	public function getDataStadion($data){
		$queryall = $this->db->get('stadion');
		$sql = "SELECT * FROM stadion where " .$data['filtervalue']. " like '%" .$data['filtertext']. "%' limit ".$data["start"].",".$data['length'];
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
	public function getStadion($IdStadion){
		$sql = "SELECT * FROM stadion WHERE IdStadion=$IdStadion";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function insertStadion($data){
		$query = $this->db->insert('stadion', $data); 
		return $query;
	}
	public function updateStadion($data){
		$this->db->where('IdStadion',$data['IdStadion']); 
		$query=$this->db->update('stadion',$data); 
		return $query;
	}
	public function deleteStadion($data){
		$query=$this->db->delete('stadion',$data); 
		return $query;
	}
}
?>