<?php
include "../inc/koneksi.php";

//FUNGSI RUPIAH
include "../inc/rupiah.php";
?>

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

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Laporan Keuangan</title>
</head>

<body>
  <center>
    <h2>Laporan Rekapitulasi Keuangan</h2>
    <h3>Dapur Dodol Satibi</h3>
    <p>________________________________________________________________________</p>

    <table border="1" cellspacing="0">
      <thead>
        <tr>
          <th>No.</th>
          <th>Tanggal</th>
          <th>Cabang</th>
          <th>Pendapatan</th>
          <th>Pengeluaran</th>
        </tr>
      </thead>
      <tbody>
        <?php

        $no = 1;
        $sql_tampil = "select * from kas_satibi order by tgl asc";
        $query_tampil = mysqli_query($koneksi, $sql_tampil);
        while ($data = mysqli_fetch_array($query_tampil, MYSQLI_BOTH)) {
        ?>
          <tr>
            <td><?php echo $no; ?></td>
            <td><?php $tgl = $data['tgl'];
                echo date("d/M/Y", strtotime($tgl)) ?></td>
            <td><?php echo $data['cabang']; ?></td>
            <td align="right"><?php echo rupiah($data['masuk']); ?></td>
            <td align="right"><?php echo rupiah($data['total_keluar']); ?></td>
          </tr>
        <?php
          $no++;
        }
        ?>
      </tbody>
      <tr>
        <td colspan="3">Total Pendapatan</td>
        <td colspan="2"><?php echo rupiah($masuk); ?></td>
      </tr>
      <tr>
        <td colspan="4">Total Pengeluaran</td>
        <td><?php echo rupiah($total_keluar); ?></td>
      </tr>
      <tr>
        <td colspan="3">Saldo Keuangan</td>
        <td colspan="2"><?php echo rupiah($total_akhir); ?></td>
      </tr>
    </table>
  </center>

  <script>
    window.print();
  </script>
</body>

</html>