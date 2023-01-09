<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Pendapatan
		</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Cabang</label>
				<div class="col-sm-4">
					<select name="cabang" id="cabang" class="form-control">
						<option>- Pilih -</option>
						<option>Bekasi</option>
						<option>Jakarta</option>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Pendapatan</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="masuk" name="masuk" placeholder="Jumlah Pendapatan" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Tanggal</label>
				<div class="col-sm-4">
					<input type="date" class="form-control" id="tgl" name="tgl" required>
				</div>
			</div>



			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Catatan</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="catatan" name="catatan" placeholder="Catatan" required>
				</div>
			</div>

		</div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=i_data_km" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php

if (isset($_POST['Simpan'])) {

	//menangkap post masuk
	$masuk = $_POST['masuk'];


	//membuang Rp dan Titik
	$masuk_hasil = preg_replace("/[^0-9]/", "", $masuk);


	//mulai proses simpan data
	$sql_simpan = "INSERT INTO kas_satibi (tgl,cabang,catatan,masuk,keluar,jenis) VALUES (
        '" . $_POST['tgl'] . "',
        '" . $_POST['cabang'] . "',
		'" . $_POST['catatan'] . "',
        '" . $masuk_hasil . "',

        '0',
        'Masuk')";
	$query_simpan = mysqli_query($koneksi, $sql_simpan);
	mysqli_close($koneksi);

	if ($query_simpan) {
		echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=i_data_km';
          }
      })</script>";
	} else {
		echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=i_add_km';
          }
      })</script>";
	}
}
//selesai proses simpan data
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