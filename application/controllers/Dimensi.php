<?php
class Dimensi extends CI_Controller{
	function __construct(){
		parent::__construct();
		
	}
	function index(){
	//if($this->session->userdata('akses')=='1'){
		$this->load->model("admin/all_dimensi","all_halaman");
			$this->all_halaman->semua_dimensi();
			$data=array(
				
				'title'=>"Semua Data Dimensi",
				'user'=>$this->name_user,
				'nama'=>$this->nama_lengkap,
				'user_level'=>$this->level_user,
				'npage'=>6,
				'burl'=>base_url()."admin",
				'id_user'=>$this->id_user,
				'hasil'=>$this->all_halaman->hasil,
				);			

			$this->load->view('admin/header',$data);
			$this->load->view('admin/all_dimensi',$data);
			$this->load->view('admin/footer',$data);
	//}else{
    //    show_404();
    //}
	}
	function tambah_dimensi(){
	if($this->session->userdata('akses')=='1'){
		$kat=$this->input->post('dimensi');
		$this->m_dimensi->simpan_dimensi($kat);
		redirect('admin/dimensi');
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function edit_dimensi(){
	if($this->session->userdata('akses')=='1'){
		$kode=$this->input->post('kode');
		$kat=$this->input->post('dimensi');
		$this->m_dimensi->update_dimensi($kode,$kat);
		redirect('admin/dimensi');
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function hapus_dimensi(){
	if($this->session->userdata('akses')=='1'){
		$kode=$this->input->post('kode');
		$this->m_dimensi->hapus_dimensi($kode);
		redirect('admin/dimensi');
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
}