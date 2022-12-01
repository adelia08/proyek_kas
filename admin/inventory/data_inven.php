<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Pendataan Produksi
		</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<a href="?page=Inven/data_inventory" class="btn btn-primary">
					<i class="fa fa-edit"></i> Tambah Data</a>
			</div>
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal Input</th>
						<th>No. Produksi</th>
						<th>Nama Produk</th>
						<th>Jumlah Produk</th>
						<th>Tanggal Expired</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php
					$no = 1;
					$sql = $koneksi->query("select * from inventory order by tgl_input desc");
					while ($data = $sql->fetch_assoc()) {
					?>

						<tr>
							<td>
								<?php echo $no++; ?>
							</td>
							<td>
								<?php $tgl = $data['tgl_input'];
								echo date("d/M/Y", strtotime($tgl)) ?>
							</td>
							<td>
								<?php echo $data['no_produksi']; ?>
							</td>
							<td>
								<?php echo $data['nama_produk']; ?>
							</td>
							<td>
								<?php echo $data['jumlah_produk']; ?>
							</td>
							<td>
								<?php $tgl_expired = $data['expired'];
								echo date("d/M/Y", strtotime($tgl_expired)) ?>
							</td>


							<td>
								<a href="?page=Inven/edit_inventory&kode=<?php echo $data['no_produksi']; ?>" title="Ubah" class="btn btn-success btn-sm">
									<i class="fa fa-edit"></i>
								</a>
								<a href="?page=Inven/del_inventory&kode=<?php echo $data['no_produksi']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')" title="Hapus" class="btn btn-danger btn-sm">
									<i class="fa fa-trash"></i>
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