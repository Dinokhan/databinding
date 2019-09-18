<?php
class Membermodel extends CI_Model{
	public function getDataMember($data){
		$queryall = $this->db->get('member');
		$sql = "SELECT * FROM member where " .$data['filtervalue']. " like '%" .$data['filtertext']. "%' limit ".$data["start"].",".$data['length'];
		$query = $this->db->query($sql);
    	$data2 = $query->result();
    	$total = $queryall->num_rows();
    	$dataRecord = array(
    		"RecordsTotal" => $total,
    		"RecordsFiltered" => $total,
			"Data" => $data2,
			"Start"=> $data['start'],
		);
		return $dataRecord;
	}
	public function getMember($IdMember){
		$sql = "SELECT * FROM member WHERE IdMember=$IdMember";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function insertMember($data){
		$query = $this->db->insert('member', $data); 
		return $query;
	}
	public function updateMember($data){
		$this->db->where('IdMember',$data['IdMember']); 
		$query=$this->db->update('member',$data); 
		return $query;
	}
	public function deleteMember($data){
		$query=$this->db->delete('member',$data); 
		return $query;
	}
}
?>