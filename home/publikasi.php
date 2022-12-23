<?php
$sql = $koneksi->query("SELECT SUM(masuk) as tot_masuk  from kas_satibi where jenis='Masuk'");
while ($data = $sql->fetch_assoc()) {
  $masuk = $data['tot_masuk'];
}

$sql = $koneksi->query("SELECT SUM(keluar) as tot_keluar, SUM(cost) as tot_cost from kas_satibi where jenis='Keluar'");
while ($data = $sql->fetch_assoc()) {
  $total_keluar = $data['tot_keluar'] + $data['tot_cost'];
}
$sql = $koneksi->query("UPDATE kas_satibi SET total_keluar = keluar + cost ");

$total_akhir = $masuk - $total_keluar;
?>

<div class="row">
  <div class="col-lg-6 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3><?php echo rupiah($total_akhir); ?></h3>

        <p>Saldo Keuangan</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="?page=publikasi/kas/satibi" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-6 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3><?php echo rupiah($total_akhir); ?></h3>


      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="?page=publikasi/kas/sosial" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>