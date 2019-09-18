<?php
class Kelasmodel extends CI_Model{
	public function getDataKelas($data){
		$queryall = $this->db->get('kelas');
		$sql = "SELECT * FROM kelas where " .$data['filtervalue']. " like '%" .$data['filtertext']. "%' limit ".$data["start"].",".$data['length'];
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
	public function getKelas($IdKelas){
		$sql = "SELECT * FROM kelas WHERE IdKelas=$IdKelas";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function getKelasAll(){
		$sql = "SELECT * FROM kelas";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function insertKelas($data){
		$query = $this->db->insert('kelas', $data); 
		return $query;
	}
	public function updateKelas($data){
		$this->db->where('IdKelas',$data['IdKelas']); 
		$query=$this->db->update('kelas',$data); 
		return $query;
	}
	public function deleteKelas($data){
		$query=$this->db->delete('kelas',$data); 
		return $query;
	}
}
?>