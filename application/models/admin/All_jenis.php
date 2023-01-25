<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class All_jenis extends CI_Model{
	public $hasil="";
	function __construct(){
		parent::__construct();
	}

	function get_jenis(){
		$query=$this->db->query("SELECT * FROM jenis ORDER BY id_jenis DESC");
		if($query->num_rows()>0){
			$data=$query->result_array();
			$no=1;
			foreach($data as $val){
				$this->hasil.="<tr id_jenis='$val[id_jenis]'>";

				$this->hasil.="<th class='no'>";
				$this->hasil.=$no;
				$this->hasil.="</th>";

				$this->hasil.="<td class='nama_jenis'>";
				$this->hasil.="<span>".$val["nama_jenis"]."</span><form><input type='text' ></form>";
				$this->hasil.="</td>";

				$this->hasil.="<td class='hapus_jenis'>";
				$this->hasil.="<button class='btn btn-danger btn-sm'><i class='fa fa-trash-o'></i></button>";
				$this->hasil.="</td>";

				$this->hasil.="</tr>";
				$no++;
			}
		}
	}


}



?>