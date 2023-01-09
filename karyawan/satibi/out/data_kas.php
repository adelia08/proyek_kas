<div class="alert alert-danger alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<h5>
		<i class="icon fas fa-info"></i> Total Pengeluaran
	</h5>
	<?php
	$sql = $koneksi->query("SELECT SUM(keluar) as tot_keluar, SUM(cost) as tot_cost from kas_satibi where jenis='Keluar'");
	while ($data = $sql->fetch_assoc()) {
		$total_keluar = $data['tot_keluar'] + $data['tot_cost'];
	}
	$sql = $koneksi->query("UPDATE kas_satibi SET total_keluar = keluar + cost ");
	?>
	<h2>
		<?php echo rupiah($total_keluar); ?>
	</h2>

</div>

<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Kas Satibi
		</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<a href="?page=o_add_km" class="btn btn-primary">
					<i class="fa fa-edit"></i> Tambah Data</a>
			</div>
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal</th>
						<th>Produk</th>
						<th>Jumlah Pengeluaran</th>
						<th>Biaya Lainnya</th>
						<th>Total Pengeluaran</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php
					$no = 1;
					$sql = $koneksi->query("select * from kas_satibi where jenis='Keluar' order by tgl desc");
					while ($data = $sql->fetch_assoc()) {
					?>

						<tr>
							<td>
								<?php echo $no++; ?>
							</td>
							<td>
								<?php $tgl = $data['tgl'];
								echo date("d/M/Y", strtotime($tgl)) ?>
							</td>
							<td>
								<?php echo $data['produk']; ?>
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
								<a href="?page=o_edit_km&kode=<?php echo $data['id_ks']; ?>" title="Ubah" class="btn btn-success btn-sm">
									<i class="fa fa-edit"></i>
								</a>

								</>
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
	<!-- /.card-body -->