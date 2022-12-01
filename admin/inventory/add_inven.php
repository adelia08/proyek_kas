<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data
		</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Tanggal Input</label>
				<div class="col-sm-4">
					<input type="date" class="form-control" id="tgl_input" name="tgl_input" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">No. Produksi</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="no_produksi" name="no_produksi" placeholder="Nomor Produksi" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Produk</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Nama Produk" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Jumlah Produk</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="jumlah_produk" name="jumlah_produk" placeholder="Jumlah Produk" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Tanggal Expired</label>
				<div class="col-sm-4">
					<input type="date" class="form-control" id="expired" name="expired" required>
				</div>
			</div>


		</div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=i_data_inven" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php

if (isset($_POST['Simpan'])) {


	//mulai proses simpan data
	$sql_simpan = "INSERT INTO inventory (no_produksi,tgl_input,nama_produk,jumlah_produk,expired) VALUES (
        '" . $_POST['no_produksi'] . "',
        '" . $_POST['tgl_input'] . "',
		'" . $_POST['nama_produk'] . "',
		'" . $_POST['jumlah_produk'] . "',
		'" . $_POST['expired'] . "',
	)";
	$query_simpan = mysqli_query($koneksi, $sql_simpan);
	mysqli_close($koneksi);

	if ($query_simpan) {
		echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=i_data_inven';
          }
      })</script>";
	} else {
		echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=i_add_inven';
          }
      })</script>";
	}
}
//selesai proses simpan data
?>