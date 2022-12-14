<div class="alert alert-success alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<h5>
		<i class="icon fas fa-info"></i> Total Pendapatan
	</h5>
	<?php
	$sql = $koneksi->query("SELECT SUM(masuk) as tot_masuk  from kas_satibi where jenis='Masuk'");
	while ($data = $sql->fetch_assoc()) {
	?>
		<h2>
		<?php echo rupiah($data['tot_masuk']);
	} ?>
		</h2>

</div>

<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Pendapatan
		</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<a href="?page=i_add_km" class="btn btn-primary">
					<i class="fa fa-edit"></i> Tambah Data</a>
			</div>
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal</th>
						<th>Cabang</th>
						<th>User</th>
						<th>Jumlah Pendapatan</th>
						<th>Catatan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php
					$no = 1;
					$sql = $koneksi->query("select * from kas_satibi where jenis='Masuk' order by tgl desc");
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
								<?php echo $data['cabang']; ?>
							</td>
							<td>
								<?php echo $data['user']; ?>
							</td>
							<td>
								<?php echo rupiah($data['masuk']); ?>
							</td>

							<td>
								<?php echo $data['catatan']; ?>
							</td>
							<td>
								<a href="?page=i_edit_km&kode=<?php echo $data['id_ks']; ?>" title="Ubah" class="btn btn-success btn-sm">
									<i class="fa fa-edit"></i>
								</a>

								</>
							</td>


						<tr>
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