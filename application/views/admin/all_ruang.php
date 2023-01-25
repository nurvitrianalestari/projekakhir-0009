<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

<div class='content-wrapper'>

	<div class="content-header">
	<h1>Ruang <small>Tambahkan dan kelola Data Ruang</small></h1>
	<ol class="breadcrumb">
            <li><a href="<?php echo $burl; ?>/"><i class="fa fa-dashboard"></i> Halaman Utama</a></li><li class="active">Ruang</li>
          </ol>
	</div>
	<div class="content">

	<div class="row">
		<div class="col-sm-5">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Tambahkan Data Ruang</h4>
				</div>
				<div class="box-body">
					<div class="form-group">
                      <label for="list_fakultas">Jenis Pasien</label>
                        <select name="list_fakultas" id="list_fakultas" class="form-control">
                        <option value="0" selected>Pilih Jenis Pasien</option>
                        <?php
                        if($list_fakultas!=false){
                          echo $list_fakultas;
                        }
                         ?>
                      </select>
                    </div>
					<div class="form-group">
						<label for="nama_prodi">Nama Ruang</label>
						<input type="text" class="form-control" id="nama_prodi">
					</div>
					<button class="btn btn-primary tambah-prodi-btn">Simpan</button>
					</div>

				</div>

			</div>
		<div class="col-sm-7">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Semua Data Ruang</h4>
				</div>
				<div class="box-body">
					<table class="prodi-table table table-bordered table-striped">
						<thead>
							<tr>
								<th width="30">No</th>
								<th>Nama Jenis Pasien</th>
								<th>Nama Ruang</th>
								<th width="50">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							echo $hasil; 
							?>
						</tbody>
					</table>
				</div>
			</div>
			
		</div>
	</div>
 </div>
</div>