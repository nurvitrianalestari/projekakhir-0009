<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class All_ruang extends CI_Model{
	public $hasil="";
	public $list_jenis;
	function __construct(){
		parent::__construct();
	}
	function get_jenis(){
		$query=$this->db->query("SELECT * FROM jenis ORDER BY id_jenis");
		if($query->num_rows()>0){
			foreach($query->result_array() as $data){
				$this->list_jenis.="<option value='$data[id_jenis]'>";
				$this->list_jenis.="$data[nama_jenis]";
				$this->list_jenis.="</option>";
			}
		} else {
			$this->list_jenis=false;
		}
	}
	function get_ruang(){
		$query=$this->db->query("SELECT * FROM ruang ORDER BY id_ruang DESC");
		$jenis=$this->db->query("SELECT * FROM jenis");
		$arKat=array();
		$arKat[0]="";
		if($jenis->num_rows()>0){
			foreach ($jenis->result_array() as  $value) {
				$arKat[$value['id_jenis']]=$value['nama_jenis'];
			}			
		}
		if($query->num_rows()>0){
			$data=$query->result_array();
			$no=1;
			foreach($data as $val){
				$this->hasil.="<tr id_ruang='$val[id_ruang]'>";

				$this->hasil.="<th class='no'>";
				$this->hasil.=$no;
				$this->hasil.="</th>";

				$this->hasil.="<td class='id_jenis'>";
				$this->hasil.="<span>".@$arKat[$val['id_jenis']]."</span>";
				$this->hasil.="</td>";
				
				$this->hasil.="<td class='nama_ruang'>";
				$this->hasil.="<span>".$val["nama_ruang"]."</span>";
				$this->hasil.="</td>";

				$this->hasil.="<td class='hapus_ruang'>";
				$this->hasil.="<button class='btn btn-danger btn-sm'><i class='fa fa-trash-o'></i></button>";
				$this->hasil.="</td>";

				$this->hasil.="</tr>";
				$no++;
			}
		}
	}


}



?>