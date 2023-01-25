<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class AN_admin extends CI_Controller {
	protected $login=false;
	//user data
	protected $id_user;
	protected $name_user;
	protected $nama_lengkap;
	protected $password_user;
	protected $level_user;
	protected $avatar_user;

	protected $c;

	function __construct(){
		parent::__construct();

		//Panggil database
		$this->load->database();

		//session
		$this->load->library(array(''));
		$this->login=$this->session->userdata('login');	


		//panggil helper	
		$this->load->helper(array('filter','url','text'));

		$this->load->model("admin/Myuser","user");

		$this->login= $this->user->set($this->session->userdata('id_user'),$this->session->userdata('name_user'),$this->session->userdata('password_user'));
		
			$this->id_user=$this->user->id;
			$this->name_user=$this->user->name;
			$this->nama_lengkap=$this->user->nama;
			$this->password_user=$this->user->password;
			$this->level_user=$this->user->level;
			$this->avatar_user=$this->user->avatar;	
	}

	private function home(){ //Halaman Home
		
		if(!$this->login){
			redirect("admin/login");
		}
		else {

		$this->load->model("admin/main");

		$data=array(
				'avatar'=>$this->avatar_user,
				'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
				'title'=>'Sistem Pendukung Keputusan Analisa Kepuasan Pengunjung Laboratorium Komputer UNIKAMA - Halaman Utama',
				'user'=>"$this->name_user",
				'nama'=>$this->nama_lengkap,
				'user_level'=>$this->level_user,
				'npage'=>1,
				'burl'=>base_url()."admin",
				'data'=>$this->main->get()
				);
		$this->load->view('admin/header',$data);
		$this->load->view('admin/main',$data);
		$this->load->view('admin/footer',$data);
		}
		
	}

	public function index(){
		$this->home();
	}

	
	function login($x=''){
		if($this->login){
			redirect('admin');
		}
		$data['status']=$x;
		$this->load->view("admin/login",$data);
	}

	function proseslogin(){
	 	if($this->input->post()){
	 		$user=filterquote($this->input->post("username",TRUE),"all");
	 		$pass=md5($this->input->post("password"));

	 		$cari=$this->db->get_where("user",array("name_user"=>$user,"password_user"=>$pass,"level_user"=>"1","status_user"=>"Y"));

	 		if($cari->num_rows()<1){
	 			redirect("admin/login/1");
	 		}
	 		else{
	 			$row=$cari->row();
	 			$data_sessi=array('login'=>true,
	 						'id_user'=>$row->id_user,
	 						'name_user'=>$row->name_user,
	 						'password_user'=>$row->password_user,
	 						'level_user'=>$row->level_user);
	 			$this->session->set_userdata($data_sessi);
	 			redirect("admin");
	 		}

	 	}
	 	else{
	 		show_404();
	 	}
	}

	function logout(){
		$data= array("login","id_user","name_user","password_user","level_user","random_filemanager_key");
		$this->session->unset_userdata($data);
		redirect("admin");
	}
	
	function all_kuisioner(){
		if(!$this->login){
			redirect("admin/login");
		} else {
			if($this->level_user==1){
			$this->load->model("admin/all_kuisioner","all_halaman");
			$this->all_halaman->semua_kuisioner();
			$data=array(
				'avatar'=>$this->avatar_user,
				'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
				'title'=>"Semua Data Kuisioner",
				'user'=>$this->name_user,
				'nama'=>$this->nama_lengkap,
				'user_level'=>$this->level_user,
				'npage'=>2,
				'burl'=>base_url()."admin",
				'id_user'=>$this->id_user,
				'hasil'=>$this->all_halaman->hasil,
				);			

			$this->load->view('admin/header',$data);
			$this->load->view('admin/all_kuisioner',$data);
			$this->load->view('admin/footer',$data);				

			} else {
				show_404();
			}
		}		
	}

	function kuisioner($id=0){
		if(!$this->login){
			redirect("admin/login");
		}

		else { 
			$this->load->model("admin/kuisioner","modul");
			$this->modul->get_kriteria();

			if($id!==0){
				$hasil=$this->modul->get_kuisioner($id);
				if($hasil==false){
					show_404();
				} else {
					$data=array(
					'avatar'=>$this->avatar_user,
					'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
					"title"=>"Edit Kuisioner",
					"user"=>$this->name_user,
					'nama'=>$this->nama_lengkap,
					'user_level'=>$this->level_user,
					'npage'=>3,
					'burl'=>base_url()."admin",
					'id_user'=>$this->id_user,
					'data'=>$hasil,
					'modul'=>"edit"
					);
					$data=array_merge($data,$hasil);
				}

			} else {

			$data=array(
					'avatar'=>$this->avatar_user,
					'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
					"title"=>"Tambah Kuisioner",
					"user"=>$this->name_user,
					'user_level'=>$this->level_user,
					'nama'=>$this->nama_lengkap,
					'npage'=>3,
					'burl'=>base_url()."admin",
					'id_user'=>$this->id_user,
					'modul'=>"new",
					"id_kuisioner"=>0,
					"periode"=>'',
					"tahun"=>'',
					"deskripsi"=>''
					);
			}
				$this->load->view('admin/header',$data);
				$this->load->view('admin/kuisioner',$data);
				$this->load->view('admin/footer',$data);
		}
	}

	function all_kriteria(){
		if(!$this->login){
			redirect("admin/login");
		} else {
			if($this->level_user==1){
			$this->load->model("admin/all_kriteria","all_halaman");
			$this->all_halaman->semua_kriteria();
			$data=array(
				'avatar'=>$this->avatar_user,
				'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
				'title'=>"Semua Data Kriteria",
				'user'=>$this->name_user,
				'nama'=>$this->nama_lengkap,
				'user_level'=>$this->level_user,
				'npage'=>4,
				'burl'=>base_url()."admin",
				'id_user'=>$this->id_user,
				'hasil'=>$this->all_halaman->hasil,
				);			

			$this->load->view('admin/header',$data);
			$this->load->view('admin/all_kriteria',$data);
			$this->load->view('admin/footer',$data);				

			} else {
				show_404();
			}
		}		
	}

	function kriteria($id=0){
		$id=abs($id);
		if(!$this->login){
			redirect("admin/login");
		}
		else {
			if($this->level_user==1){
			$this->load->model("admin/kriteria","halaman");
			$this->halaman->get_dimensi();
			if(!$this->halaman->get_kriteria($id)){
				show_404();
			} else {
				if ($id>0) {
			$data=array(
				'avatar'=>$this->avatar_user,
				'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
				'title'=>($id==0)?"Kriteria Baru":"Edit Kriteria",
				'user'=>$this->name_user,
				'nama'=>$this->nama_lengkap,
				'user_level'=>$this->level_user,
				'npage'=>5,
				'burl'=>base_url()."admin",
				'id_user'=>$this->id_user,
				'list_dimensi'=>$this->halaman->get_list_dimensi($id),
				'data'=>$this->halaman->hasil
				);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/kriteria',$data);
			$this->load->view('admin/footer',$data);

				}else{
			$data=array(
				'avatar'=>$this->avatar_user,
				'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
				'title'=>($id==0)?"Kriteria Baru":"Edit Kriteria",
				'user'=>$this->name_user,
				'nama'=>$this->nama_lengkap,
				'user_level'=>$this->level_user,
				'npage'=>5,
				'burl'=>base_url()."admin",
				'id_user'=>$this->id_user,
				'list_dimensi'=>$this->halaman->list_dimensi,
				'data'=>$this->halaman->hasil
				);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/kriteria',$data);
			$this->load->view('admin/footer',$data);

			}
			}

			} else {
				show_404();
			}
		}		
	}

	function all_dimensi(){
		if(!$this->login){
			redirect("admin/login");
		} else {
			if($this->level_user==1){
			$this->load->model("admin/all_dimensi","all_halaman");
			$this->all_halaman->semua_dimensi();
			$data=array(
				'avatar'=>$this->avatar_user,
				'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
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

			} else {
				show_404();
			}
		}		
	}

	function dimensi($id=0){
		$id=abs($id);
		if(!$this->login){
			redirect("admin/login");
		}
		else {
			if($this->level_user==1){
			$this->load->model("admin/dimensi","halaman");

			if(!$this->halaman->get_dimensi($id)){
				show_404();
			} else {

			$data=array(
				'avatar'=>$this->avatar_user,
				'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
				'title'=>($id==0)?"Dimensi Baru":"Edit Dimensi",
				'user'=>$this->name_user,
				'nama'=>$this->nama_lengkap,
				'user_level'=>$this->level_user,
				'npage'=>7,
				'burl'=>base_url()."admin",
				'id_user'=>$this->id_user,
				'data'=>$this->halaman->hasil
				);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/dimensi',$data);
			$this->load->view('admin/footer',$data);


			}

			} else {
				show_404();
			}
		}		
	}

	function all_pasien(){
		if(!$this->login){
			redirect("admin/login");
		} else {
			if($this->level_user==1){
			$this->load->model("admin/all_pasien","all_halaman");
			$this->all_halaman->semua_pasien();
			$data=array(
				'avatar'=>$this->avatar_user,
				'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
				'title'=>"Semua Data Pasien",
				'user'=>$this->name_user,
				'nama'=>$this->nama_lengkap,
				'user_level'=>$this->level_user,
				'npage'=>8,
				'burl'=>base_url()."admin",
				'id_user'=>$this->id_user,
				'hasil'=>$this->all_halaman->hasil,
				);			

			$this->load->view('admin/header',$data);
			$this->load->view('admin/all_pasien',$data);
			$this->load->view('admin/footer',$data);				

			} else {
				show_404();
			}
		}		
	}


	function pasien($id=0){
		$id=abs($id);
		if(!$this->login){
			redirect("admin/login");
		}
		else {

			if($this->level_user==1){
			$this->load->model("admin/pasien","halaman");
			$this->halaman->get_status();

			if(!$this->halaman->get_pasien($id)){
				show_404();
			} else {

			$data=array(
				'avatar'=>$this->avatar_user,
				'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
				'title'=>($id==0)?"Pasien Baru" : "Pasien Baru",
				'user'=>$this->name_user,
				'nama'=>$this->nama_lengkap,
				'user_level'=>$this->level_user,
				'npage'=>9,
				'burl'=>base_url()."admin",
				'list_status'=>$this->halaman->list_status,
				'id_user'=>$this->id_user,
				'data'=>$this->halaman->hasil
				);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/pasien',$data);
			$this->load->view('admin/footer',$data);


			}

			} else {
				show_404();
			}
		}		
	}

	function edit_pasien($id=0){
		$id=abs($id);
		if(!$this->login){
			redirect("admin/login");
		}
		else {

			if($this->level_user==1){
			$this->load->model("admin/edit_pasien","halaman");
			if(!$this->halaman->get_pasien($id)){
				show_404();
			} else {

			$data=array(
				'avatar'=>$this->avatar_user,
				'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
				'title'=>($id==0)?"Tambah Data pasien": "Edit Data pasien",
				'user'=>$this->name_user,
				'nama'=>$this->nama_lengkap,
				'user_level'=>$this->level_user,
				'npage'=>35,
				'burl'=>base_url()."admin",
				'list_status'=>$this->halaman->get_list_status($id),
				'list_unit'=>$this->halaman->get_list_unit($id),
				'list_ruang'=>$this->halaman->get_list_ruang($id),
				'id_user'=>$this->id_user,
				'data'=>$this->halaman->hasil
				);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/edit_pasien',$data);
			$this->load->view('admin/footer',$data);
			}

			} else {
				show_404();
			}
		}		
	}

	function kotak_saran(){

		if(!$this->login){
			redirect("admin/login");
		} else {

			$this->load->model('admin/kotak_saran','inbox');

			$data=array(
				'avatar'=>$this->avatar_user,
				'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
				'title'=>"Kotak Saran",
				'user'=>$this->name_user,
				'nama'=>$this->nama_lengkap,
				'user_level'=>$this->level_user,
				'npage'=>10,
				'burl'=>base_url()."admin",
				'id_user'=>$this->id_user,
				'kotaksaran'=>$this->inbox->get_data()
				);	

			$this->load->view("admin/header",$data);
			$this->load->view("admin/kotak_saran",$data);
			$this->load->view("admin/footer",$data);						
		}		
	}

	function layout_widget(){

		if(!$this->login){
			redirect("admin/login");
		} else {
			
		}		

	}

	function all_status(){
		if(!$this->login){
			redirect("admin/login");
		}

		else {
			$this->load->model("admin/all_status");
			$hasil=$this->all_status->get_status();
			$hasil=$this->all_status->hasil;

			$data=array(
					'avatar'=>$this->avatar_user,
					'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
					"title"=>"Status",
					"user"=>$this->name_user,
					'nama'=>$this->nama_lengkap,
					'user_level'=>$this->level_user,
					'npage'=>11,
					'burl'=>base_url()."admin",
					'id_user'=>$this->id_user,
					'hasil'=>$hasil
					);
				$this->load->view('admin/header',$data);
				$this->load->view('admin/all_status',$data);
				$this->load->view('admin/footer',$data);
		}
	}

	function all_jenis(){
		if(!$this->login){
			redirect("admin/login");
		}

		else {
			$this->load->model("admin/all_jenis");
			$hasil=$this->all_jenis->get_jenis();
			$hasil=$this->all_jenis->hasil;

			$data=array(
					'avatar'=>$this->avatar_user,
					'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
					"title"=>"jenis",
					"user"=>$this->name_user,
					'nama'=>$this->nama_lengkap,
					'user_level'=>$this->level_user,
					'npage'=>12,
					'burl'=>base_url()."admin",
					'id_user'=>$this->id_user,
					'hasil'=>$hasil
					);
				$this->load->view('admin/header',$data);
				$this->load->view('admin/all_jenis',$data);
				$this->load->view('admin/footer',$data);
		}
	}

	function all_ruang(){
		if(!$this->login){
			redirect("admin/login");
		}

		else {
			$this->load->model("admin/all_ruang");
			$hasil=$this->all_ruang->get_ruang();
			$hasil=$this->all_ruang->get_jenis();
			$hasil=$this->all_ruang->hasil;

			$data=array(
					'avatar'=>$this->avatar_user,
					'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
					"title"=>"ruang",
					"user"=>$this->name_user,
					'nama'=>$this->nama_lengkap,
					'user_level'=>$this->level_user,
					'npage'=>13,
					'burl'=>base_url()."admin",
					'list_jenis'=>$this->all_ruang->list_jenis,
					'id_user'=>$this->id_user,
					'hasil'=>$hasil
					);
				$this->load->view('admin/header',$data);
				$this->load->view('admin/all_ruang',$data);
				$this->load->view('admin/footer',$data);
		}
	}

	function input_ekspektasi(){
		$id_hasil_kuisioner=$this->input->post('id_hasil_kuisioner');
		$kode_kuisioner= $this->input->post('kode_kuisioner');
		$kode_pasien = $this->input->post('kode_pasien');
		$id_kriteria = $this->input->post('id_kriteria');
		$id_kuisioner= $this->input->post('id_kuisioner');
		$jawaban = $this->input->post('jawaban');
		$id_pasien = $this->input->post('id_pasien');
    	$result = array();
    	if (!empty($id_kriteria) && (!empty($jawaban))) {
    		foreach($id_kriteria AS $key => $val){
	     	$result[] = array(
	      	"id_kriteria"  => $_POST['id_kriteria'][$key],
	      	"id_kuisioner"  => $_POST['id_kuisioner'][$key],
	      	"jawaban"  => $_POST['jawaban'][$key],
	      	"id_pasien"  => $_POST['id_pasien'][$key]);
		    }       
	    $test= $this->db->insert_batch('detail_jawaban', $result);
	    if($test){
	    	if ($id_hasil_kuisioner==0) {
			$query=$this->db->query("INSERT INTO hasil_kuisioner (id_kuisioner,id_pasien) VALUES ('$kode_kuisioner','$kode_pasien')");
				echo "ok";
			}else{
				echo "Database Error...!!!";
			}     
	     redirect('AN_admin/ekspektasi_lab');    
	 	}else{
	     echo "Database Error";
	    }
		}else{
			echo "Belum ada Jawaban";

		}
   
	}

	function ekspektasi_lab(){
		if(!$this->login){
			redirect("admin/login");
		} else {
			if($this->level_user==1){
			$this->load->model("admin/ekspektasi_lab","halaman");
			$this->halaman->get_kuisioner();
			$data=array(
				'avatar'=>$this->avatar_user,
				'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
				'title'=>"Input Ekspektasi",
				'user'=>$this->name_user,
				'nama'=>$this->nama_lengkap,
				'user_level'=>$this->level_user,
				'npage'=>14,
				'burl'=>base_url()."admin",
				'id_user'=>$this->id_user,
				'hasil'=>$this->halaman->hasil,
				);			

			$this->load->view('admin/header',$data);
			$this->load->view('admin/ekspektasi_lab',$data);
			$this->load->view('admin/footer',$data);				

			} else {
				show_404();
			}
		}		
	}

	function hasil_kuisioner(){
		if(!$this->login){
			redirect("admin/login");
		} else {
			if($this->level_user==1){
			$this->load->model("admin/hasil_kuisioner","all_halaman");
			$this->all_halaman->ambil_hasil();
			$data=array(
				'avatar'=>$this->avatar_user,
				'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
				'title'=>"Halaman Hasil Kuisioner",
				'user'=>$this->name_user,
				'nama'=>$this->nama_lengkap,
				'user_level'=>$this->level_user,
				'npage'=>15,
				'burl'=>base_url()."admin",
				'id_user'=>$this->id_user,
				'hasil'=>$this->all_halaman->hasil,
				);			

			$this->load->view('admin/header',$data);
			$this->load->view('admin/hasil_kuisioner',$data);
			$this->load->view('admin/footer',$data);				

			} else {
				show_404();
			}
		}		
	}

	function hasil_servqual(){
		if(!$this->login){
			redirect("admin/login");
		} else {
			if($this->level_user==1){
			$this->load->model("admin/hasil_servqual","all_halaman");
			$this->all_halaman->jumlah();
			$this->all_halaman->servqual_total();
			$this->all_halaman->servqual_kriteria();
			$data=array(
				'suara1' => $this->all_halaman->get_row1(),
            	'suara2' => $this->all_halaman->get_row2(),
            	'suara3' => $this->all_halaman->get_row3(),
            	'suara4' => $this->all_halaman->get_row4(),
				'i_kuisioner'=>$this->all_halaman->no_kuisioner(),
				'i_kriteria'=>$this->all_halaman->no_kriteria(),
				'i_hasil'=>$this->all_halaman->hasilnya(),
				'avatar'=>$this->avatar_user,
				'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
				'title'=>"Halaman Hasil Servqual",
				'user'=>$this->name_user,
				'nama'=>$this->nama_lengkap,
				'user_level'=>$this->level_user,
				'npage'=>16,
				'burl'=>base_url()."admin",
				'id_user'=>$this->id_user,
				'hasil'=>$this->all_halaman->hasil,
				'jumlah'=>$this->all_halaman->jumlah,
				'kriteria'=>$this->all_halaman->kriteria,
				'dimensi'=>$this->all_halaman->dimensi

			);			

			$this->load->view('admin/header',$data);
			$this->load->view('admin/hasil_servqual',$data);
			$this->load->view('admin/footer',$data);			

			} else {
				show_404();
			}
		}		
	}

	function input_servqual_kriteria(){
		$id= $this->input->post('id');
		$id_kriteria = $this->input->post('id_kriteria');
		$id_kuisioner= $this->input->post('id_kuisioner');
		$hasil = $this->input->post('hasil');
		$kuisioner_id=$this->db->query("SELECT id_kuisioner FROM servqual_kriteria WHERE id_kuisioner='$id'");
		if ($kuisioner_id->num_rows()>0) {
			$result = array();
    		foreach($id_kuisioner AS $key => $val){

	     	$result[] = array(
	      	"id_kuisioner"  => $_POST['id_kuisioner'][$key],
	      	"id_kriteria"  => $_POST['id_kriteria'][$key],
	      	"hasil"  => $_POST['hasil'][$key]);
		    } 
	    $this->db->update_batch('servqual_kriteria', $result);
	    redirect('AN_admin/hasil_servqual');
		}else{
    	$result = array();
    		foreach($id_kuisioner AS $key => $val){
	     	$result[] = array(
	      	"id_kuisioner"  => $_POST['id_kuisioner'][$key],
	      	"id_kriteria"  => $_POST['id_kriteria'][$key],
	      	"hasil"  => $_POST['hasil'][$key]);
		    } 
	    $this->db->insert_batch('servqual_kriteria', $result);
	    redirect('AN_admin/hasil_servqual');

		}
	}

	function user_baru(){
		if(!$this->login){
			redirect("admin/login");
		}
		
		else{
			if($this->level_user==1){
				$data=array(
					'avatar'=>$this->avatar_user,
					'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
					'title'=>'User Baru',
					'user'=>$this->name_user,
					'nama'=>$this->nama_lengkap,
					'user_level'=>$this->level_user,
					'npage'=>22,
					'burl'=>base_url()."admin",
					);

			$this->load->view('admin/header',$data);
			$this->load->view('admin/user',$data);
			$this->load->view('admin/footer',$data);

			} else {
				show_404();
			}
		}
	}

	function all_user(){
		if(!$this->login){
			redirect("admin/login");
		}

		else {
			if($this->level_user==1){
				$this->load->model("admin/daftar_user");
				$this->daftar_user->show();
				$data=array(
					'avatar'=>$this->avatar_user,
					'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
					"title"=>"Managemen User",
					"user"=>$this->name_user,
					'nama'=>$this->nama_lengkap,
					'user_level'=>$this->level_user,
					'npage'=>21,
					'burl'=>base_url()."admin",
					'table'=>$this->daftar_user->hasil
					);
				$this->load->view('admin/header',$data);
				$this->load->view('admin/all_user',$data);
				$this->load->view('admin/footer',$data);
			} else {
				show_404();
			}
		}
	}

	function log(){
		if(!$this->login){
			redirect("admin/login");
		} else {
			if($this->level_user==1){
			$this->load->model("admin/log","all_halaman");
			$this->all_halaman->jumlah();
			$this->all_halaman->servqual_total();
			$data=array(
				'suara1' => $this->all_halaman->get_row1(),
            	'suara2' => $this->all_halaman->get_row2(),
            	'suara3' => $this->all_halaman->get_row3(),
            	'suara4' => $this->all_halaman->get_row4(),
				'i_kuisioner'=>$this->all_halaman->no_kuisioner(),
				'i_kriteria'=>$this->all_halaman->no_kriteria(),
				'i_hasil'=>$this->all_halaman->hasilnya(),
				'avatar'=>$this->avatar_user,
				'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
				'title'=>"Halaman Log",
				'user'=>$this->name_user,
				'nama'=>$this->nama_lengkap,
				'user_level'=>$this->level_user,
				'npage'=>16,
				'burl'=>base_url()."admin",
				'id_user'=>$this->id_user,
				'hasil'=>$this->all_halaman->hasil,
				'jumlah'=>$this->all_halaman->jumlah

			);			

			$this->load->view('admin/header',$data);
			$this->load->view('admin/log',$data);
			$this->load->view('admin/footer',$data);			

			} else {
				show_404();
			}
		}		
	}

 }

?>