<?php

if (isset($_GET['kode'])) {
  $sql_cek = "SELECT * FROM kas_satibi WHERE id_ks='" . $_GET['kode'] . "'";
  $query_cek = mysqli_query($koneksi, $sql_cek);
  $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
}
?>

<div class="card card-success">
  <div class="card-header">
    <h3 class="card-title"><i class="fa fa-edit"></i> Ubah Pengeluaran</h3>
  </div>
  <form action="" method="post" enctype="multipart/form-data">
    <div class="card-body">

      <input type='hidden' class="form-control" name="id_ks" value="<?php echo $data_cek['id_ks']; ?>" readonly />

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Tanggal</label>
        <div class="col-sm-4">
          <input type="date" class="form-control" id="tgl" name="tgl" value="<?php echo $data_cek['tgl']; ?>" />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Produk</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="produk" name="produk" value="<?php echo $data_cek['produk']; ?>" />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Pengeluaran</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="keluar" name="keluar" value="Rp <?php echo number_format(($data_cek['keluar']), 0, '', '.') ?>" />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Biaya Lainnya</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="cost" name="cost" value="Rp <?php echo number_format(($data_cek['cost']), 0, '', '.') ?>" />
        </div>
      </div>

    </div>
    <div class="card-footer">
      <input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
      <a href="?page=o_data_km" title="Kembali" class="btn btn-secondary">Batal</a>
    </div>
  </form>
</div>



<?php

if (isset($_POST['Ubah'])) {

  //menangkap post keluar
  $keluar = $_POST['keluar'];
  $cost = $_POST['cost'];

  //membuang Rp dan Titik
  $keluar_hasil = preg_replace("/[^0-9]/", "", $keluar);
  $cost_hasil = preg_replace("/[^0-9]/", "", $cost);

  $sql_ubah = "UPDATE kas_satibi SET
        produk='" . $_POST['produk'] . "',
        keluar='" . $keluar_hasil . "',
        cost='" . $cost_hasil . "',
        tgl='" . $_POST['tgl'] . "'
        WHERE id_ks='" . $_POST['id_ks'] . "'";
  $query_ubah = mysqli_query($koneksi, $sql_ubah);
  mysqli_close($koneksi);

  if ($query_ubah) {
    echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=o_data_km';
        }
      })</script>";
  } else {
    echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=o_data_km';
        }
      })</script>";
  }
}
?>

<script type="text/javascript">
  var Keluar = document.getElementById('Keluar');
  Keluar.addEventListener('keyup', function(e) {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatmasuk() untuk mengubah angka yang di ketik menjadi format angka
    Keluar.value = formatKeluar(this.value, 'Rp ');
  });

  var Cost = document.getElementById('Cost');
  Cost.addEventListener('keyup', function(e) {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatmasuk() untuk mengubah angka yang di ketik menjadi format angka
    Cost.value = formatCost(this.value, 'Rp ');
  });


  /* Fungsi format Keluar */
  function formatKeluar(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split = number_string.split(','),
      sisa = split[0].length % 3,
      $keluar_hasil = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
      separator = sisa ? '.' : '';
      $keluar_hasil += separator + ribuan.join('.');
    }

    $keluar_hasil = split[1] != undefined ? $keluar_hasil + ',' + split[1] : $keluar_hasil;
    return prefix == undefined ? $keluar_hasil : ($keluar_hasil ? 'Rp ' + $keluar_hasil : '');
  }



  /* Fungsi formatCost */
  function formatCost(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split = number_string.split(','),
      sisa = split[0].length % 3,
      $cost_hasil = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
      separator = sisa ? '.' : '';
      $cost_hasil += separator + ribuan.join('.');
    }

    $cost_hasil = split[1] != undefined ? $cost_hasil + ',' + split[1] : $cost_hasil;
    return prefix == undefined ? $cost_hasil : ($cost_hasil ? 'Rp ' + $cost_hasil : '');


  }
</script>