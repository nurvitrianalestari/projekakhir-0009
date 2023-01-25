<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class All_pasien extends CI_Model {

	public $hasil;

	function __construct(){
		parent::__construct();
	}
	
	
	function Semua_pasien(){
		$query=$this->db->query("SELECT * FROM pasien ORDER BY id_pasien DESC");
		$_status=$this->db->query("SELECT * FROM status");
		$status=array();
		$status[0]="";
		if($_status->num_rows()>0){
			foreach ($_status->result_array() as  $value) {
				$status[$value['id_status']]=$value['nama_status'];
			}			
		}
		
		
		$hasil="";
		if($query->num_rows()>0){
			$no=1;
			foreach($query->result_array() as $value){
				$id_oreng=$value['id_pasien'];
				$this->hasil.="<tr id='$id_oreng'>";
				$this->hasil.="<td>$value[id_pasien]</td>";
				$this->hasil.="<td>$value[ktp]</td>";
				$this->hasil.="<td><span class='nama_lengkap'>".$value['nama_lengkap']."</span></td>";
				$this->hasil.="<td>$value[tanggal_daftar]</td>";
				$fotbut="<a class='btn btn-sm btn-primary foto' data-toggle='modal' data-target='#modal-foto'><i class='fa fa-photo'></i></a>";
				$this->hasil.="<td>$fotbut <a href='".base_url()."saya-disembunyikan/edit_pasien/$value[id_pasien]' class='btn btn-primary btn-sm' id='$value[id_pasien]'><i class='fa fa-pencil-square-o'></i></a>
				<a class='btn btn-danger btn-sm hapus-pasien' id='$value[id_pasien]'><i class='fa fa-trash-o'></i></a></td>";
				$this->hasil.="</tr>";

			}
		}
		return $hasil;
	}

}