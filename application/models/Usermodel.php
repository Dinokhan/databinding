<?php
class Usermodel extends CI_Model{
	public function getDataUser($data){
		$queryall = $this->db->get('login');
		$sql = "SELECT * FROM login where " .$data['filtervalue']. " like '%" .$data['filtertext']. "%' limit ".$data["start"].",".$data['length'];
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
	public function getUser($idlogin){
		$sql = "SELECT * FROM login WHERE IdLogin=$idlogin";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function insertUser($data){
		$query = $this->db->insert('login', $data); 
		return $query;
	}
	public function updateUser($data){
		$this->db->where('IdLogin',$data['IdLogin']); 
		$query=$this->db->update('login',$data); 
		return $query;
	}
	public function deleteUser($data){
		$query=$this->db->delete('login',$data); 
		return $query;
	}
	public function filterUser($data) {
		$sql = "SELECT * FROM login where " .$data['filterValue']. " like '%" .$data['filterText']. "%'";
		$query = $this->db->query($sql);
		return $query->result(); 
	}
	public function login($data) {
		$this->db->select('IdLogin, Username, Password, NamaKaryawan, Role');
		$this->db->from('login');
		$this->db->where('Username', $data['username']);
		$this->db->where('Password', $data['password']);
		$this->db->limit(1);
		 
		$query = $this->db->get();
		if($query->num_rows() == 1) { 
			return $query->result();
		} else {
			return false;
		}
	}
	public function loginakun($data) {
		$this->db->select('IdMember, username, password, NamaMember, NoMember');
		$this->db->from('member');
		$this->db->where('username', $data['username']);
		$this->db->where('password', $data['password']);
		$this->db->limit(1);
		 
		$query = $this->db->get();
		if($query->num_rows() == 1) { 
			return $query->result();
		} else {
			return false;
		}
	}
}
?>