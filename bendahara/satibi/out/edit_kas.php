<?php

if (isset($_GET['kode'])) {
  $sql_cek = "SELECT * FROM kas_satibi WHERE id_km='" . $_GET['kode'] . "'";
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

      <input type='hidden' class="form-control" name="id_km" value="<?php echo $data_cek['id_km']; ?>" readonly />

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Tanggal</label>
        <div class="col-sm-4">
          <input type="date" class="form-control" id="tgl_km" name="tgl_km" value="<?php echo $data_cek['tgl_km']; ?>" />
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
          <input type="text" class="form-control" id="keluar" name="keluar" value="<?php echo $data_cek['keluar']; ?>" />
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

  $cost = $_POST['cost'];
  $cost_hasil = preg_replace("/[^0-9]/", "", $cost);

  $sql_ubah = "UPDATE kas_satibi SET
        produk='" . $_POST['produk'] . "',
        keluar='" . $_POST['keluar'] . "',
        cost='" . $cost_hasil . "',
        tgl_km='" . $_POST['tgl_km'] . "'
        WHERE id_km='" . $_POST['id_km'] . "'";
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
  var Cost = document.getElementById('Cost');
  Cost.addEventListener('keyup', function(e) {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatmasuk() untuk mengubah angka yang di ketik menjadi format angka
    Cost.value = formatCost(this.value, 'Rp ');
  });
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