<script src="<?= base_url(); ?>bower_components/jquery/dist/jquery.min.js"></script>

<script>
function uploadFile() {
	// membaca data file yg akan diupload, dari komponen 'fileku'
	var file1 = document.getElementById("fileku1").files[0];
	var file2 = document.getElementById("fileku2").files[0];
	var formdata = new FormData();
	formdata.append("datafile", file1);
	formdata.append("datafile", file2);

	// proses upload via AJAX disubmit ke 'upload.php'
	// selama proses upload, akan menjalankan progressHandler()
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.open("POST", "upload.php", true);
	ajax.send(formdata);
}

function progressHandler(event) {
	// hitung prosentase
	var percent = (event.loaded / event.total) * 100;
	// menampilkan prosentase ke komponen id 'progressBar'
	document.getElementById("progressBar").value = Math.round(percent);
	// menampilkan prosentase ke komponen id 'status'
	document.getElementById("status").innerHTML = Math.round(percent) + "% telah terupload";
	// menampilkan file size yg tlh terupload dan totalnya ke komponen id 'total'
	document.getElementById("total").innerHTML = "Telah terupload " + event.loaded + " bytes dari " + event.total;
}
</script>
<style>
.blinking {
	animation: blinkingText 0.8s infinite;
}

@keyframes blinkingText {
	0% {
		color: #00000;
	}

	100% {
		color: transparent;
	}

	100% {
		color: #00000;
	}
}
</style>
<!-- <div class="container"> -->
<div class="">
	<div class="login-logo">
		<a href="<?= base_url(); ?>"><b>Tiket</b> GAC</a><br>
	</div>
	<?= $this->session->flashdata('message'); ?>
	<div class="login-box-body">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs pull-left">
				<li class="active"><a href="#open" data-toggle="tab">OPEN & PROGRESS &nbsp;<span
							class="label label-default pull-right">
						</span></a></li>
				<li><a href="#delay" data-toggle="tab">DELAY &nbsp;<span class="label label-default pull-right">
						</span></a></li>
				<li><a href="#close" data-toggle="tab">CLOSE &nbsp;<span class="label label-default pull-right">
						</span></a></li>
				<li><a href="#master" data-toggle="tab">MASTER DATA &nbsp;<span class="label label-default pull-right">
						</span></a></li>
				<li><a href="#limbah" data-toggle="tab">DATA LIMBAH &nbsp;<span class="label label-default pull-right">
						</span></a></li>
			</ul>
			<div class="tab-content">
				<?php ini_set("error_reporting", 0); ?>
				<div class="tab-pane active" id="open">
					<br><br>
					<section class="content">
						<table id="example1" class="table table-bordered ">
							<thead>
								<tr>
									<th width="10"><i class="fa fa-gear"></i></th>
									<th width="100">Nama Pemohon</th>
									<th width="100">Nomor Mesin</th>
									<th width="100">Merk</th>
									<th width="100">Tanggal</th>
									<th width="50">Dept</th>
									<th width="400">Permasalahan</th>
									<th width="200">Lokasi</th>
									<th width="200">Status</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$return = $this->db->query("SELECT * FROM tbl_tugas WHERE (`status` = 'Open' OR `status` = 'Progress') ORDER BY tgl_mulai DESC")->result_array();
								?>
								<?php foreach ($return as $data): ?>
								<tr <?php if ($data['prioritas'] == 1) {
										echo "bgcolor='#FFE4B5'";
									} ?>>
									<td>
										<li class="dropdown" style="list-style-type:none;">
											<a href="#" class="fa fa-bars dropdown-toggle" data-toggle="dropdown"></a>
											<ul class="dropdown-menu" role="menu">
												<li><a
														href="<?= base_url(); ?>auth/viewtiket/<?= $data['id']; ?>">Tampilkan</a>
												</li>
												<!-- <li><a href="<?= base_url(); ?>auth/view_edit/<?= $data['id']; ?>">Edit</a></li> -->
												<li><a href="<?= base_url(); ?>auth/hapus/<?= $data['id']; ?>">Hapus</a>
												</li>
											</ul>
										</li>
									</td>
									<td>
										<a href="<?= base_url(); ?>auth/viewtiket/<?= $data['id']; ?>"
											title="view: <?= $data['nama_pelapor']; ?>">
											<?= $data['nama_pelapor']; ?>
										</a>
									</td>
									<td>
										<?php
											$return_detailmesin = $this->db->query("SELECT * FROM mesin WHERE id = '$data[id_mesin]'")->row();
											echo $return_detailmesin->no_mesin;
											?>
									</td>
									<td>
										<?= $return_detailmesin->merk; ?>
									</td>
									<td>
										<?= date_format(date_create($data['tgl_mulai']), 'd M Y H:i:s'); ?>
									</td>
									<td>
										<?= $data['dept']; ?>
									</td>
									<td>
										<?= $data['permasalahan']; ?>
									</td>
									<td>
										<?= $data['lokasi']; ?>
									</td>
									<td <?php if ($data['status'] == "Delay") {
											echo "bgcolor='#FCAFAF'";
										} ?> class="<?php if ($data['status'] == "Progress") {
											  echo "blinking";
										  } ?>" style="
													<?php if ($data['status'] == 'Open') {
														echo 'font-weight: bold;';
													} ?>">
										<?= $data['status']; ?>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</section>
				</div>
				<div class="tab-pane" id="delay">
					<br><br>
					<section class="content">
						<table id="example2" class="table table-bordered ">
							<thead>
								<tr>
									<th width="10"><i class="fa fa-gear"></i></th>
									<th width="100">Nama</th>
									<th width="100">Tanggal</th>
									<th width="50">Dept</th>
									<th width="400">Permasalahan</th>
									<th width="200">Lokasi</th>
									<th width="200">Status</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$return = $this->db->query("SELECT * FROM tbl_tugas WHERE `status` = 'Delay' ORDER BY tgl_mulai DESC")->result_array();
								?>
								<?php foreach ($return as $data): ?>
								<tr <?php if ($data['prioritas'] == 1) {
										echo "bgcolor='#FFE4B5'";
									} ?>>
									<td>
										<li class="dropdown" style="list-style-type:none;">
											<a href="#" class="fa fa-bars dropdown-toggle" data-toggle="dropdown"></a>
											<ul class="dropdown-menu" role="menu">
												<li><a
														href="<?= base_url(); ?>auth/viewtiket/<?= $data['id']; ?>">Tampilkan</a>
												</li>
												<!-- <li><a href="<?= base_url(); ?>auth/view_edit/<?= $data['id']; ?>">Edit</a></li> -->
												<li><a href="<?= base_url(); ?>auth/hapus/<?= $data['id']; ?>">Hapus</a>
												</li>
											</ul>
										</li>
									</td>
									<td>
										<a href="<?= base_url(); ?>auth/viewtiket/<?= $data['id']; ?>"
											title="view: <?= $data['nama_pelapor']; ?>">
											<?= $data['nama_pelapor']; ?>
										</a>
									</td>
									<td>
										<?= date_format(date_create($data['tgl_mulai']), 'd M Y H:i:s'); ?>
									</td>
									<td>
										<?= $data['dept']; ?>
									</td>
									<td>
										<?= $data['permasalahan']; ?>
									</td>
									<td>
										<?= $data['lokasi']; ?>
									</td>
									<td <?php if ($data['status'] == "Delay") {
											echo "bgcolor='#FCAFAF'";
										} ?> class="<?php if ($data['status'] == "Progress") {
											  echo "blinking";
										  } ?>" style="
													<?php if ($data['status'] == 'Open') {
														echo 'font-weight: bold;';
													} ?>">
										<?= $data['status']; ?>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</section>
				</div>
				<div class="tab-pane" id="close">
					<br><br>
					<section class="content">
						<table id="example3" class="table table-bordered ">
							<thead>
								<tr>
									<th width="10"><i class="fa fa-gear"></i></th>
									<th width="100">Nama</th>
									<th width="100">Tanggal</th>
									<th width="50">Dept</th>
									<th width="400">Permasalahan</th>
									<th width="200">Lokasi</th>
									<th width="200">Status</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$return = $this->db->query("SELECT * FROM tbl_tugas WHERE `status` = 'Close' ORDER BY tgl_mulai DESC")->result_array();
								?>
								<?php foreach ($return as $data): ?>
								<tr <?php if ($data['prioritas'] == 1) {
										echo "bgcolor='#FFE4B5'";
									} ?>>
									<td>
										<li class="dropdown" style="list-style-type:none;">
											<a href="#" class="fa fa-bars dropdown-toggle" data-toggle="dropdown"></a>
											<ul class="dropdown-menu" role="menu">
												<li><a
														href="<?= base_url(); ?>auth/viewtiket/<?= $data['id']; ?>">Tampilkan</a>
												</li>
												<!-- <li><a href="<?= base_url(); ?>auth/view_edit/<?= $data['id']; ?>">Edit</a></li> -->
												<li><a href="<?= base_url(); ?>auth/hapus/<?= $data['id']; ?>">Hapus</a>
												</li>
											</ul>
										</li>
									</td>
									<td>
										<a href="<?= base_url(); ?>auth/viewtiket/<?= $data['id']; ?>"
											title="view: <?= $data['nama_pelapor']; ?>">
											<?= $data['nama_pelapor']; ?>
										</a>
									</td>
									<td>
										<?= date_format(date_create($data['tgl_mulai']), 'd M Y H:i:s'); ?>
									</td>
									<td>
										<?= $data['dept']; ?>
									</td>
									<td>
										<?= $data['permasalahan']; ?>
									</td>
									<td>
										<?= $data['lokasi']; ?>
									</td>
									<td <?php if ($data['status'] == "Delay") {
											echo "bgcolor='#FCAFAF'";
										} ?> class="<?php if ($data['status'] == "Progress") {
											  echo "blinking";
										  } ?>" style="
													<?php if ($data['status'] == 'Open') {
														echo 'font-weight: bold;';
													} ?>">
										<?= $data['status']; ?>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</section>
				</div>

				<div class="tab-pane" id="master">
					<br><br>
					<section class="content">
						<button type="button" class="btn bg-red" title="Tambah data master" data-toggle="collapse"
							data-target="#tambah-data">
							<b>Tambah Data Baru</b>
						</button>
						<br><br>
						<div id="tambah-data" class="collapse">
							<div class="box">
								<form action="<?= base_url(); ?>tugas/tambahMaster" method="POST">
									<div class="box box-warning">
										<div class="box-body">
											<div class="form-group col-sm-2">
												<label>Dept</label>
											</div>
											<div class="form-group col-sm-10">
												<input type="text" class="form-control input-sm" name="dept"
													placeholder="Department" required>
											</div>

											<div class="form-group col-sm-2">
												<label>No Mesin</label>
											</div>
											<div class="form-group col-sm-10">
												<input type="text" class="form-control input-sm" name="no_mesin"
													placeholder="Nomor Mesin" required>
											</div>

											<div class="form-group col-sm-2">
												<label>Jenis</label>
											</div>
											<div class="form-group col-sm-10">
												<input type="text" class="form-control input-sm" name="jenis"
													placeholder="Jenis" required>
											</div>

											<div class="form-group col-sm-2">
												<label>Merk</label>
											</div>
											<div class="form-group col-sm-10">
												<input type="text" class="form-control input-sm" name="merk"
													placeholder="Merk" required>
											</div>

											<div class="form-group col-sm-2">
												<label>Capacity</label>
											</div>
											<div class="form-group col-sm-10">
												<input type="text" class="form-control input-sm" name="capacity"
													placeholder="Capacity" required>
											</div>

											<div class="form-group col-sm-2">
												<label>Freon</label>
											</div>
											<div class="form-group col-sm-10">
												<input type="text" class="form-control input-sm" name="freon"
													placeholder="Freon" required>
											</div>

											<div class="form-group col-sm-2">
												<label>Lokasi</label>
											</div>
											<div class="form-group col-sm-10">
												<input type="text" class="form-control input-sm" name="lokasi"
													placeholder="Lokasi" required>
											</div>

											<div class="form-group col-sm-2">
												<label>Kategori</label>
											</div>
											<div class="form-group col-sm-10">
												<input type="text" class="form-control input-sm" name="kategori"
													placeholder="Kategori" required>
											</div>

											<div class="form-group col-sm-2">
												<label>Pemasangan</label>
											</div>
											<div class="form-group col-sm-10">
												<input type="date" class="form-control input-sm" name="pemasangan"
													required>
											</div>

											<div class="form-group col-sm-2">
												<label>Note</label>
											</div>
											<div class="form-group col-sm-10">
												<input type="text" class="form-control input-sm" name="note" required>
											</div>

											<div class="form-group col-sm-2">
												<label>Keterangan</label>
											</div>
											<div class="form-group col-sm-10">
												<textarea class="form-control input-sm" name="keterangan"
													rows="5"></textarea>
											</div>
										</div>
										<div class="box-footer">
											<div class="pull-left">
												<button type="submit" name="submit" class="btn bg-green btn-flat"
													style="font-size: 12px;">SIMPAN</button>
											</div>
										</div>
								</form>
							</div>
						</div>
				</div>
				<table id="example4" class="table table-bordered">
					<thead>
						<tr>
							<th width="10"><i class="fa fa-gear"></i></th>
							<th width="100">Dept</th>
							<th width="100">No Mesin</th>
							<th width="50">Jenis</th>
							<th width="400">Merk</th>
							<th width="200">Capacity</th>
							<th width="200">Freon</th>
							<th width="200">Lokasi</th>
							<th width="200">Kategori</th>
							<th width="200">Pemasangan</th>
							<th width="200">Status</th>
							<th width="200">Note</th>
							<th width="200">Keterangan</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$return = $this->db->query("SELECT * FROM mesin")->result_array();
						?>
						<?php foreach ($return as $data): ?>
						<tr>
							<td>
								<li class="dropdown" style="list-style-type:none;">
									<a href="#" class="fa fa-bars dropdown-toggle" data-toggle="dropdown"></a>
									<ul class="dropdown-menu" role="menu">
										<!-- <li><a href="<?= base_url(); ?>auth/viewtiket/<?= $data['id']; ?>">Tampilkan</a></li> -->
										<!-- <li><a href="<?= base_url(); ?>auth/view_edit/<?= $data['id']; ?>">Edit</a></li> -->
										<li><a
												href="<?= base_url(); ?>tugas/HapusDataMaster/<?= $data['id']; ?>">Hapus</a>
										</li>
									</ul>
								</li>
							</td>
							<td align="center"><a data-pk="<?php echo $data['id'] ?>"
									data-value="<?php echo $data['dept'] ?>" class="dept"
									href="javascipt:void(0)"><?php echo $data['dept'] ?></a></td>
							<td align="center"><a data-pk="<?php echo $data['id'] ?>"
									data-value="<?php echo $data['no_mesin'] ?>" class="no_mesin"
									href="javascipt:void(0)"><?php echo $data['no_mesin'] ?></a></td>
							<td align="center"><a data-pk="<?php echo $data['id'] ?>"
									data-value="<?php echo $data['jenis'] ?>" class="jenis"
									href="javascipt:void(0)"><?php echo $data['jenis'] ?></a></td>
							<td align="center"><a data-pk="<?php echo $data['id'] ?>"
									data-value="<?php echo $data['merk'] ?>" class="merk"
									href="javascipt:void(0)"><?php echo $data['merk'] ?></a></td>
							<td align="center"><a data-pk="<?php echo $data['id'] ?>"
									data-value="<?php echo $data['capacity'] ?>" class="capacity"
									href="javascipt:void(0)"><?php echo $data['capacity'] ?></a></td>
							<td align="center"><a data-pk="<?php echo $data['id'] ?>"
									data-value="<?php echo $data['freon'] ?>" class="freon"
									href="javascipt:void(0)"><?php echo $data['freon'] ?></a></td>
							<td align="center"><a data-pk="<?php echo $data['id'] ?>"
									data-value="<?php echo $data['lokasi'] ?>" class="lokasi"
									href="javascipt:void(0)"><?php echo $data['lokasi'] ?></a></td>
							<td align="center"><a data-pk="<?php echo $data['id'] ?>"
									data-value="<?php echo $data['kategori'] ?>" class="kategori"
									href="javascipt:void(0)"><?php echo $data['kategori'] ?></a></td>
							<td align="center"><a data-pk="<?php echo $data['id'] ?>"
									data-value="<?php echo $data['pemasangan'] ?>" class="pemasangan"
									href="javascipt:void(0)"><?php echo $data['pemasangan'] ?></a></td>
							<td align="center"><a data-pk="<?php echo $data['id'] ?>"
									data-value="<?php echo $data['status'] ?>" class="status"
									href="javascipt:void(0)"><?php echo $data['status'] ?></a></td>
							<td align="center"><a data-type="textarea" data-pk="<?php echo $data['id'] ?>"
									data-value="<?php echo $data['note'] ?>" class="note"
									href="javascipt:void(0)"><?php echo $data['note'] ?></a></td>
							<td align="center"><a data-type="textarea" data-pk="<?php echo $data['id'] ?>"
									data-value="<?php echo $data['keterangan'] ?>" class="keterangan"
									href="javascipt:void(0)"><?php echo $data['keterangan'] ?></a></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				</section>
			</div>
			<div class="tab-pane" id="limbah">
				<br><br>
				<section class="content">
					<button type="button" class="btn bg-red" title="Tambah data master" data-toggle="collapse"
						data-target="#tambah-data"
						onclick="window.location.href='<?= base_url('InputLimbah/inputlimbah'); ?>'">
						<b>Tambah Data Baru</b>
					</button>
					<button type="button" class="btn bg-green" title="Export to Excel"
						onclick="exportTableToExcel('example5', 'limbah-data')">
						<b>Export ke Excel</b>
					</button>
					<br><br>
					<table id="example5" class="table table-bordered ">
						<thead>
							<tr>
								<th width="10"><i class="fa fa-gear"></i></th>
								<th width="100">Nama Pemohon</th>
								<th width="100">Departemen</th>
								<th width="300">Jenis limbah</th>
								<th width="50">Timbangan awal</th>
								<th width="50">Timbangan akhir</th>
								<th width="50">Quantity mutasi</th>
								<th width="30">Satuan</th>
								<th width="100">Lokasi</th>
								<th width="300">permasalahan</th>
								<th width="100">Tanggal</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$return = $this->db->query("SELECT * FROM input_limbah WHERE id ")->result_array();
							?>
							<?php foreach ($return as $data): ?>
							<td>
								<li class="dropdown" style="list-style-type:none;">
									<a href="#" class="fa fa-bars dropdown-toggle" data-toggle="dropdown"></a>
									<ul class="dropdown-menu" role="menu">
										<li><a
												href="<?= base_url(); ?>auth/viewlimbah/<?= $data['id']; ?>">Tampilkan</a>
										</li>
										<!-- <li><a href="<?= base_url(); ?>auth/view_edit/<?= $data['id']; ?>">Edit</a></li> -->
										<li><a
												href="<?= base_url(); ?>auth/hapustiketlimbah/<?= $data['id']; ?>">Hapus</a>
										</li>
									</ul>
								</li>
							</td>
							<td>
								<a href="<?= base_url(); ?>auth/viewlimbah/<?= $data['id']; ?>"
									title="view: <?= $data['nama_pelapor']; ?>">
									<?= $data['nama_pelapor']; ?>
								</a>
							</td>
							<td>
								<?= $data['dept_pelapor']; ?>
							</td>
							<td>
								<?= $data['jenislimbah']; ?>
							</td>
							<td>
								<?= $data['timbangan_awal']; ?>
							</td>
							<td>
								<?= $data['timbangan_akhir']; ?>
							</td>
							<td>
								<?= $data['quantity_mutasi']; ?>
							</td>
							<td>
								<?= $data['satuan']; ?>
							</td>
							<td>
								<?= $data['lokasi']; ?>
							</td>
							<td>
								<?= $data['permasalahan']; ?>
							</td>
							<td>
								<?= $data['tanggal']; ?>
							</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</section>
			</div>
		</div>
	</div>
</div>

<div class="box-footer">
	<div class="pull-left">
		<a href="<?= base_url(); ?>Auth" class="btn btn-link btn-flat" style="font-size: 12px;">Kembali ke login</a>
	</div>
</div>
</div>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.15.6/xlsx.full.min.js"></script>
<script>
$(document).ready(function() {
	$('#example5').DataTable();
});

function exportTableToExcel() {
	// Fetch all data from DataTable
	var table = $('#example5').DataTable();
	var data = table.rows().data().toArray();

	var ws_data = [
		["Nama Pemohon", "Departemen", "Jenis limbah", "Timbangan awal", "Timbangan akhir",
			"Quantity mutasi", "Satuan", "Lokasi", "Permasalahan", "Tanggal"
		]
	];

	data.forEach(function(row) {
		// Remove HTML tags and unnecessary spaces from 'Nama Pemohon' column (index 1)
		var namaPemohon = row[1].replace(/<[^>]+>/g, '').trim(); // trim() removes leading and trailing spaces
		var jenisLimbah = row[3].replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&amp;/g, '&');

		ws_data.push([
			namaPemohon, // Nama Pemohon
			row[2], // Departemen
			jenisLimbah, // Jenis limbah
			row[4], // Timbangan awal
			row[5], // Timbangan akhir
			row[6], // Quantity mutasi
			row[7], // Satuan
			row[8], // Lokasi
			row[9], // Permasalahan
			row[10] // Tanggal
		]);
	});

	var ws = XLSX.utils.aoa_to_sheet(ws_data);
	var wb = XLSX.utils.book_new();
	XLSX.utils.book_append_sheet(wb, ws, "Sheet1");

	var wbout = XLSX.write(wb, {
		bookType: 'xlsx',
		type: 'binary'
	});

	function s2ab(s) {
		var buf = new ArrayBuffer(s.length);
		var view = new Uint8Array(buf);
		for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
		return buf;
	}

	var blob = new Blob([s2ab(wbout)], {
		type: 'application/octet-stream'
	});

	var downloadLink = document.createElement("a");
	downloadLink.href = URL.createObjectURL(blob);
	downloadLink.download = 'limbah-data.xlsx';
	document.body.appendChild(downloadLink);
	downloadLink.click();
	document.body.removeChild(downloadLink);
}
</script>