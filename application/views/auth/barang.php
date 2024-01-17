        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Daftar Limbah Padat
                </h1>
                <br>
                <a href="<?= base_url(); ?>tugas/tambah_limbahpadat" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah data</a>
                <?= $this->session->flashdata('message'); ?>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Muatan</th>
                                            <th>Kategori</th>
                                            <th>Satuan</th>
                                            <th>Satuan Timbang</th>
                                            <th>Kontraktor</th>
                                            <th>PIC</th>
                                            <th>Harga</th>
                                            <th>Keterangan</th>
                                            <th>Periode</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $return = $this->db->query("SELECT * FROM tbl_daftarlimbahpadat ORDER BY id ASC")->result_array(); 
                                        ?>
                                        <?php foreach($return AS $data) : ?>
                                        <tr>
                                            <td><?= $data['nama_muatan']; ?></td>
                                            <td><?= $data['kategori']; ?></td>
                                            <td><?= $data['satuan']; ?></td>
                                            <td><?= $data['satuan_timbang']; ?></td>
                                            <td><?= $data['kontraktor']; ?></td>
                                            <td><?= $data['pic']; ?></td>
                                            <td><?= $data['harga']; ?></td>
                                            <td><?= $data['keterangan']; ?></td>
                                            <td><?= $data['tgl']; ?></td>
                                            <td>
                                                <a href="<?= base_url(); ?>tugas/edit_limbahpadat/<?= $data['id']; ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                                <a href="<?= base_url(); ?>tugas/hapus_limbahpadat/<?= $data['id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nama Muatan</th>
                                            <th>Kategori</th>
                                            <th>Satuan</th>
                                            <th>Satuan Timbang</th>
                                            <th>Kontraktor</th>
                                            <th>PIC</th>
                                            <th>Harga</th>
                                            <th>Keterangan</th>
                                            <th>Periode</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.4.0
            </div>
            <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
            reserved.
        </footer>

        <div class="control-sidebar-bg"></div>
    </div>

    <script src="<?= base_url(); ?>bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url(); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>bower_components/fastclick/lib/fastclick.js"></script>
    <script src="<?= base_url(); ?>dist/js/adminlte.min.js"></script>
    <script src="<?= base_url(); ?>dist/js/demo.js"></script>

    <script src="<?= base_url(); ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

    <script>
        $(function() {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
        })
    </script>
</body>

</html>