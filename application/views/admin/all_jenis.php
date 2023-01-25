<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

<div class='content-wrapper'>

	<div class="content-header">
	<h1>Jenis Pasien <small>Tambahkan dan kelola Jenis Pasien</small></h1>
	<ol class="breadcrumb">
            <li><a href="<?php echo $burl; ?>/"><i class="fa fa-dashboard"></i> Halaman Utama</a></li><li class="active">Jenis Pasien </li>
          </ol>
	</div>
	<div class="content">

	<div class="row">
		<div class="col-sm-6">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Tambahkan Data Jenis Pasien</h4>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label for="nama_Jenis Pasien">Nama Jenis Pasien</label>
						<input type="text" class="form-control" id="nama_Jenis Pasien">
					</div>
					<button class="btn btn-primary tambah-Jenis Pasien-btn">Simpan</button>
					</div>

				</div>

			</div>
		<div class="col-sm-6">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Semua Data Jenis Pasien</h4>
				</div>
				<div class="box-body">
					<table class="slug-table table table-bordered table-striped">
						<thead>
							<tr>
								<th width="50">No</th>
								<th>Nama Jenis Pasien</th>
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