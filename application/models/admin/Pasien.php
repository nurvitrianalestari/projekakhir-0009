<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pasien extends CI_Model {

	public $hasil;
	public $list_status;
	function __construct(){
		parent::__construct();
	}

	function get_pasien($id){
		if($id>0){
		$query=$this->db->query("SELECT * FROM pasien WHERE id_pasien='$id'");
		if($query->num_rows()>0){
			$row=$query->row();
			$this->hasil= array(
				"id_pasien"=>$row->id_pasien,
				"npm"=>$row->npm,
				"password"=>$row->password,
				"nama_lengkap"=>$row->nama_lengkap,
				"email"=>$row->email,
				"avatar_pasien"=>$row->avatar_pasien,
				"tanggal_daftar"=>$row->tanggal_daftar
				);
			return true;
		} else {
			return false;
		}
	 } else {
	 	$this->hasil= array(
				"id_pasien"=>0,
				"npm"=>"",
				"password"=>"",
				"nama_lengkap"=>"",
				"email"=>"",
				"avatar_pasien"=>"",
				"tanggal_daftar"=>""
				);
	 		return true;
	 }
	}

	function get_status(){
		$query=$this->db->query("SELECT * FROM status ORDER BY id_status");
		if($query->num_rows()>0){
			foreach($query->result_array() as $data){
				$this->list_status.="<option value='$data[id_status]'>";
				$this->list_status.="$data[nama_status]";
				$this->list_status.="</option>";
			}
		} else {
			$this->list_status=false;
		}
	}

	function get_list_status($id){
		$status_pasien='';
		$pasien=$this->db->query("SELECT status FROM pasien WHERE id_pasien='$id'");
		$_status=$pasien->row()>0;
		$id_status=$_status->status;

		$query=$this->db->query("SELECT * FROM status ORDER BY id_status");
		if($query->num_rows()>0){
			foreach($query->result_array() as $data){
				$selected=($id_status==$data['id_status'])?'selected':'';
				$status_pasien.="<option value='$data[id_status]' $selected>";
				$status_pasien.="$data[nama_status]";
				$status_pasien.="</option>";
			}

			return $status_pasien;
		} else {
			$this->list_status=false;
		}
	}

}