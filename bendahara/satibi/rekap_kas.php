<?php
$sql = $koneksi->query("SELECT SUM(masuk) as tot_masuk from kas_satibi where jenis='Masuk'");
while ($data = $sql->fetch_assoc()) {
	$masuk = $data['tot_masuk'];
}

$sql = $koneksi->query("SELECT SUM(keluar) as tot_keluar, SUM(cost) as tot_cost from kas_satibi where jenis='Keluar'");
while ($data = $sql->fetch_assoc()) {
	$total_keluar = $data['tot_keluar'] + $data['tot_cost'];
}
$sql = $koneksi->query("UPDATE kas_satibi SET total_keluar = keluar + cost ");


$sql = $koneksi->query("SELECT SUM(total_akhir) as tot_akhir, SUM(masuk) as tot_masuk from kas_satibi ");
while ($data = $sql->fetch_assoc()) {
	$total_akhir = $data['tot_akhir'] + $data['tot_masuk'];
}
$sql = $koneksi->query("UPDATE kas_satibi SET total_akhir = masuk - total_keluar");

// Menghitung saldo akhir
$total_akhir = $masuk - $total_keluar;
?>


<div class="alert alert-info alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<h5>
		<i class="icon fas fa-info"></i> Saldo Keuangan
	</h5>
	<h5>Pemasukan :
		<?php
		echo rupiah($masuk);
		?>
	</h5>

	<h5>Pengeluaran :
		<?php
		echo rupiah($total_keluar)
		?>
	</h5>
	<hr>

	<h3>Saldo Akhir :
		<?php
		echo rupiah($total_akhir);
		?>
	</h3>
</div>

<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Rekap Keuangan

		</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal</th>
						<th>Cabang</th>
						<th>Pemasukan</th>
						<th>Pengeluaran</th>
						<th>Biaya Lainnya</th>
						<th>Total Pengeluaran</th>
						<th>Total Akhir</th>
					</tr>
				</thead>
				<tbody>

					<?php
					$no = 1;
					$sql = $koneksi->query("select * from kas_satibi order by tgl_km asc");
					while ($data = $sql->fetch_assoc()) {
					?>

						<tr>
							<td>
								<?php echo $no++; ?>
							</td>
							<td>
								<?php $tgl = $data['tgl_km'];
								echo date("d/M/Y", strtotime($tgl)) ?>
							</td>
							<td>
								<?php echo $data['uraian_km']; ?>
							</td>
							<td>

								<?php echo rupiah($data['masuk']); ?>
							</td>
							<td>
								<?php echo rupiah($data['keluar']); ?>
							</td>
							<td>
								<?php echo rupiah($data['cost']); ?>
							</td>
							<td>
								<?php echo rupiah($data['total_keluar']); ?>
							</td>
							<td>
								<?php echo rupiah($data['total_akhir']); ?>
							</td>
						</tr>

					<?php
					}
					?>
				</tbody>
				</tfoot>
			</table>
		</div>
	</div>