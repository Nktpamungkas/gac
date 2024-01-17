<script src="path/to/autoNumeric.min.js"></script>
<script language="javascript">
    function tambahNama() {
        var idf  = document.getElementById("idf").value;
        var stre = `<div class='col-lg-4' class='form-group'>
                        <p id='srow` + idf + `'>
                            <label>Nama Barang ` + idf + `</label>
                            <select class="form-control" name="nama_barang[]">
                                <option value="" disabled selected>Pilih</option>
                                <?php
                                    $q_namahj   = $this->db->query("SELECT
                                                                        DISTINCT id,nama_muatan, pic, satuan
                                                                    FROM
                                                                        tbl_daftarlimbahpadat
                                                                    ORDER BY 
                                                                        pic
                                                                    ASC")->result_array();
                                ?>
                                <?php foreach($q_namahj AS $row_namahj) : ?>
                                    <option value="<?= $row_namahj['id']; ?>"><?= $row_namahj['pic']; ?> - <?= $row_namahj['nama_muatan']; ?> - <?= $row_namahj['satuan']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                            <label>Qty</label>
                            <input type="text" class="form-control" name="qty[]" required>
                            <a href='#' class="btn btn-danger btn-xs" onclick='hapusElemen(\`#srow` + idf + `\`); return false;'>Hapus</a>
                        </p>
                    </div>`;
        $("#divSite").append(stre);
        idf = (idf - 1) + 2;
        
        document.getElementById("idf").value = idf;

        $('.select2').select2()
    }

    function hapusElemen(idf) {
        $(idf).remove();
    }
</script>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Tambah data transaksi
                </h1>
                <?= $this->session->flashdata('message'); ?>
            </section>
            <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <form action="<?= base_url(); ?>tugas/tambahtransaksi" method="POST">
                            <div class="box-body">
                                <div class="form-group col-sm-4">
                                    <label>No Surat Jalan</label>
                                    <input type="text" class="form-control" name="no_sj" required>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>Tanggal</label>
                                    <input type="date" class="form-control" name="tgl" required>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>Nama Hj.</label>
                                    <select class="form-control" name="nama_hj">
                                        <option value="" disabled selected>Pilih</option>
                                        <?php
                                            $q_namahj   = $this->db->query("SELECT
                                                                                DISTINCT pic 
                                                                            FROM
                                                                                tbl_daftarlimbahpadat")->result_array();
                                        ?>
                                        <?php foreach($q_namahj AS $row_namahj) : ?>
                                            <option value="<?= $row_namahj['pic']; ?>"><?= $row_namahj['pic']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <button type="button" class="btn btn-success btn-sm" onclick="tambahNama(); return false;">
                                            Tambah Barang 
                                        </button>
                                    </label>
                                    <div class="col-lg-12" id="divSite" class="form-group">
                                        <input id="idf" value="1" type="hidden">
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                <a href="<?= base_url(); ?>tugas/transaksi_limbahpadat" class="btn btn-defult"><i class="fa fa-plus-circle"></i> Kembali</a>
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