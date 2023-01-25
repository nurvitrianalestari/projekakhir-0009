<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

     <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Selamat datang
            <small>Di Halaman administrator</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $burl; ?>/"><i class="fa fa-dashboard"></i> Halaman Utama</a></li>
           
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

         <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php
    $kuisioner = $this->db->query("select * from kuisioner"); 
    echo $kuisioner->num_rows();
?></h3>

              <p>Kuisioner</p>
            </div>
            <div class="icon">
              <i class="fa fa-edit"></i>
            </div>
            <a href="<?php echo $burl; ?>/all_kuisioner" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php
    $kriteria = $this->db->query("select * from kriteria"); 
    echo $kriteria->num_rows();
?></h3>

              <p>Kriteria</p>
            </div>
            <div class="icon">
             <i class="fa fa-file"></i>
            </div>
            <a href="<?php echo $burl; ?>/all_kriteria" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


                <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php
    $dimensi = $this->db->query("select * from dimensi"); 
    echo $dimensi->num_rows();
?></h3>

              <p>Dimensi</p>
            </div>
            <div class="icon">
             <i class="fa fa-cube"></i>
            </div>
            <a href="<?php echo $burl; ?>/all_dimensi" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php
    $pasien = $this->db->query("select * from pasien"); 
    echo $pasien->num_rows();
?></h3>

              <p>Pasien</p>
            </div>
            <div class="icon">
             <i class="fa fa-users"></i>
            </div>
            <a href="<?php echo $burl; ?>/all_pasien" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
              <h3><?php
    $ruangan = $this->db->query("select * from ruang"); 
    echo $ruangan->num_rows();
?></h3>

              <p>Ruang Rawat Inap</p>
            </div>
            <div class="icon">
             <i class="fa fa-home"></i>
            </div>
            <a href="<?php echo $burl; ?>/all_ruang" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
              <h3><?php
    $user = $this->db->query("select * from user"); 
    echo $user->num_rows();
?></h3>

              <p>Pengguna</p>
            </div>
            <div class="icon">
             <i class="fa fa-user"></i>
            </div>
            <a href="<?php echo $burl; ?>/all_user" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>


        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

   