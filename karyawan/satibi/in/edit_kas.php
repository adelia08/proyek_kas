<?php

if (isset($_GET['kode'])) {
	$sql_cek = "SELECT * FROM kas_satibi WHERE id_ks='" . $_GET['kode'] . "'";
	$query_cek = mysqli_query($koneksi, $sql_cek);
	$data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
}
?>

<div class="card card-success">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Ubah Pendapatan
		</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<input type='hidden' class="form-control" name="id_ks" value="<?php echo $data_cek['id_ks']; ?>" readonly />

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Cabang</label>
				<div class="col-sm-4">
					<select name="cabang" id="cabang" class="form-control" required>
						<option>- Pilih -</option>
						<option>Bekasi</option>
						<option>Jakarta</option>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">User</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="user" name="user" value="<?php echo $data_cek['user']; ?>" />
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Pendapatan</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="masuk" name="masuk" value="Rp <?php echo number_format(($data_cek['masuk']), 0, '', '.') ?>" />
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Tanggal</label>
				<div class="col-sm-4">
					<input type="date" class="form-control" id="tgl" name="tgl" value="<?php echo $data_cek['tgl']; ?>" />
				</div>
			</div>


			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Catatan</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="catatan" name="catatan" value="<?php echo $data_cek['catatan']; ?>" />
				</div>
			</div>

		</div>
		<div class="card-footer">
			<input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
			<a href="?page=i_data_km" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>



<?php

if (isset($_POST['Ubah'])) {

	//menangkap post masuk
	$masuk = $_POST['masuk'];


	//membuang Rp dan Titik
	$masuk_hasil = preg_replace("/[^0-9]/", "", $masuk);


	$sql_ubah = "UPDATE kas_satibi SET
        cabang='" . $_POST['cabang'] . "',
		user='" . $_POST['user'] . "',
        masuk='" . $masuk_hasil . "',
        tgl='" . $_POST['tgl'] . "',
		catatan='" . $_POST['catatan'] . "'
        WHERE id_ks='" . $_POST['id_ks'] . "'";
	$query_ubah = mysqli_query($koneksi, $sql_ubah);
	mysqli_close($koneksi);

	if ($query_ubah) {
		echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=i_data_km';
        }
      })</script>";
	} else {
		echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=i_data_km';
        }
      })</script>";
	}
}

?>

<script type="text/javascript">
	var masuk = document.getElementById('masuk');
	masuk.addEventListener('keyup', function(e) {
		// tambahkan 'Rp.' pada saat form di ketik
		// gunakan fungsi formatmasuk() untuk mengubah angka yang di ketik menjadi format angka
		masuk.value = formatmasuk(this.value, 'Rp ');
	});


	/* Fungsi formatmasuk */
	function formatmasuk(angka, prefix) {
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split = number_string.split(','),
			sisa = split[0].length % 3,
			masuk = split[0].substr(0, sisa),
			ribuan = split[0].substr(sisa).match(/\d{3}/gi);

		// tambahkan titik jika yang di input sudah menjadi angka ribuan
		if (ribuan) {
			separator = sisa ? '.' : '';
			masuk += separator + ribuan.join('.');
		}

		masuk = split[1] != undefined ? masuk + ',' + split[1] : masuk;
		return prefix == undefined ? masuk : (masuk ? 'Rp ' + masuk : '');

	}
</script>