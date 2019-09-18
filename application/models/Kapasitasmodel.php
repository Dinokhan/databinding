<?php
class Kapasitasmodel extends CI_Model{
	public function getDataKapasitas($data){
		$queryall = $this->db->get('kapasitas');
		$sql = "SELECT *,stadion.NamaStadion, kelas.Kelas FROM kapasitas left join stadion on kapasitas.IdStadion=stadion.IdStadion left join kelas on kapasitas.IdKelas=kelas.IdKelas where " .$data['filtervalue']. " like '%" .$data['filtertext']. "%' limit ".$data["start"].",".$data['length'];
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
	public function getKapasitas($IdKapasitas){
		$sql = "SELECT *,stadion.NamaStadion, kelas.Kelas FROM kapasitas left join stadion on kapasitas.IdStadion=stadion.IdStadion left join kelas on kapasitas.IdKelas=kelas.IdKelas WHERE IdKapasitas=$IdKapasitas";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function insertKapasitas($data){
		$query = $this->db->insert('kapasitas', $data); 
		return $query;
	}
	public function updateKapasitas($data){
		$this->db->where('IdKapasitas',$data['IdKapasitas']); 
		$query=$this->db->update('kapasitas',$data); 
		return $query;
	}
	public function deleteKapasitas($data){
		$query=$this->db->delete('kapasitas',$data); 
		return $query;
	}
}
?>