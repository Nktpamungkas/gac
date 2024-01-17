<script src="path/to/autoNumeric.min.js"></script>

        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Tambah data Daftar Limbah Padat
                </h1>
                <?= $this->session->flashdata('message'); ?>
            </section>
            <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <form action="<?= base_url(); ?>tugas/tambahDaftarLimbahPadat" method="POST">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Muatan</label>
                                    <input type="text" class="form-control" name="nama_muatan" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kategori</label>
                                    <input type="text" class="form-control" name="kategori" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Satuan</label>
                                    <input type="text" class="form-control" name="satuan" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Satuan Timbang</label>
                                    <input type="text" class="form-control" name="satuan_timbang" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kontraktor</label>
                                    <input type="text" class="form-control" name="kontraktor" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">PIC</label>
                                    <input type="text" class="form-control" name="pic" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Harga</label>
                                    <input type="number" class="form-control" name="harga" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Keterangan</label>
                                    <input type="text" class="form-control" name="keterangan" required>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                <a href="<?= base_url(); ?>tugas/index_limbahpadat" class="btn btn-defult"><i class="fa fa-plus-circle"></i> Kembali</a>
                            </div>
                        </form>
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