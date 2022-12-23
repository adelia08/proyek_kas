<?php

if (isset($_GET['kode'])) {
	$sql_cek = "SELECT * FROM inventory WHERE no_produksi='" . $_GET['kode'] . "'";
	$query_cek = mysqli_query($koneksi, $sql_cek);
	$data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
}
?>

<div class="card card-success">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Ubah Pendataan
		</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<input type='hidden' class="form-control" name="no_produksi" value="<?php echo $data_cek['no_produksi']; ?>" readonly />

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Tanggal Input</label>
				<div class="col-sm-4">
					<input type="date" class="form-control" id="tgl_input" name="tgl_input" value="<?php echo $data_cek['tgl_input']; ?>" />
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">No. Produksi</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="no_produksi" name="no_produksi" value="<?php echo $data_cek['no_produksi']; ?>" />
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Produk</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?php echo $data_cek['nama_produk']; ?>" />
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Jumlah Produk</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="jumlah_produk" name="jumlah_produk" value="<?php echo $data_cek['jumlah_produk']; ?>" />
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Expired</label>
				<div class="col-sm-8">
					<input type="date" class="form-control" id="expired" name="expired" value="<?php echo $data_cek['expired']; ?>" />
				</div>
			</div>


		</div>
		<div class="card-footer">
			<input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
			<a href="?page=Inven/data_inventory" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>



<?php

if (isset($_POST['Ubah'])) {

	$sql_ubah = "UPDATE inventory SET
	no_produksi='" . $_POST['no_produksi'] . "',
	tgl_input='" . $_POST['tgl_input'] . "',
	nama_produk='" . $_POST['nama_produk'] . "',
	jumlah_produk='" . $_POST['jumlah_produk'] . "',
	expired='" . $_POST['expired'] . "'
	WHERE no_produksi='" . $_POST['no_produksi'] . "'";
	$query_ubah = mysqli_query($koneksi, $sql_ubah);
	mysqli_close($koneksi);

	if ($query_ubah) {
		echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=Inven/data_inventory';
        }
      })</script>";
	} else {
		echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=Inven/data_inventory';
        }
      })</script>";
	}
}

?>