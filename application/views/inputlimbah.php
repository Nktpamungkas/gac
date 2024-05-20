<div class="container">
    <div class="login-logo">
        <a href="<?= base_url(); ?>"><b>Input</b> Limbah</a>
    </div>

    <div class="login-box-body">
        <?= $this->session->flashdata('message'); ?>
        <!-- START MODAL TUGAS BARU -->
        <div class="box">
            <div class="box box-primary">
                <form action="<?= base_url('tugas/submitForm'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="box-header with-border col-sm-12">
                        <h3 class="box-title">Input Data Limbah</h3>
                    </div>
                    <div class="box-body">
                        <?php if ($_SERVER['REMOTE_ADDR'] == '10.0.5.132' or $_SERVER['REMOTE_ADDR'] == '10.0.5.168') : ?>
                            <div class="form-group col-sm-12">
                                <input type="datetime-local" class="form-control input-sm" name="tgl_openticket">
                            </div>
                        <?php endif; ?>

                        <div class="form-group col-sm-12" id="select_box">
                            <label for="tanggal">Tanggal:</label>
                            <input type="date" class="form-control input-sm" name="tanggal" id="tanggal" required>
                        </div>
                        <div class="form-group col-sm-12" id="select_box">
                            <select class="form-control" style="width: 100%;" name="jenislimbah" id="jenislimbah" required>
                                <?php $return = $this->db->query('SELECT * FROM tbl_daftarlimbahpadat')->result_array(); ?>
                                <option value="" disabled selected>JENIS LIMBAH:</option>
                                <?php foreach ($return as $data) : ?>
                                    <option value="<?= $data['nama_muatan']; ?>"><?= $data['nama_muatan']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-12">
                            <select class="form-control select2" style="width: 100%;" name="dept_pelapor" required>
                                <?php $return = $this->db->query('SELECT * FROM dept')->result_array(); ?>
                                <option value="" disabled selected>Departemen Pelapor:</option>
                                <?php foreach ($return as $data) : ?>
                                    <option value="<?= $data['code']; ?>"><?= $data['dept_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <input type="text" class="form-control input-sm" name="nama_pelapor" placeholder="Nama pelapor:" required>
                        </div>

                        <div class="form-group col-sm-2">
                            <input type="text" class="form-control input-sm" name="timbangan_awal" placeholder="TIMBANG AWAL:" required>
                        </div>
                        <div class="form-group col-sm-2">
                            <input type="text" class="form-control input-sm" name="timbangan_akhir" placeholder="TIMBANG AKHIR:" required>
                        </div>
                        <div class="form-group col-sm-2">
                            <input type="text" class="form-control input-sm" name="quantity_mutasi" placeholder="QUANTITY MUTASI:" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <input type="text" class="form-control input-sm" name="email" placeholder="Email pelapor:">
                        </div>
                        <div class="form-group col-sm-2">
                            <input type="text" class="form-control input-sm" name="lokasi" placeholder="Lokasi:" required>
                        </div>
                        <div class="form-group col-sm-2">
                            <input type="text" class="form-control input-sm" name="platnomer" placeholder="Platnomer:" required>
                        </div>

                        <div class="form-group col-sm-12">
                            <textarea id="editor1" name="permasalahan" rows="5" style="width: 100%;" placeholder="Permasalahan:" required></textarea>
                        </div>

                        <div class="form-group">
                            <div class="btn btn-default">
                                <input type="file" name="lampiran1" class="form-control">
                            </div>

                            <div class=" btn btn-default">
                                <input type="file" name="lampiran2" class="form-control">
                            </div>

                            <!-- <input type="button" value="Upload File" class="btn btn-success" onclick="uploadFile()"> -->
                            <i style="font-size: 12px;">Max. 8MB (*.jpeg)</i>

                            <progress id="progressBar" value="0" max="100" style="width:100px;" hidden></progress>
                            <span id="status" style="font-size: 12px; color: red; font-weight: bold;"></span>
                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="pull-left">
                            <button type="submit" name="submit" class="btn bg-green btn-flat" style="font-size: 12px;">TAMBAHKAN TIKET</button>
                            <a href="<?= base_url(); ?>tugas/tiket" class="btn btn-link btn-flat" style="font-size: 12px;">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END MODAL TUGAS BARU -->
        </section>
    </div>
</div>