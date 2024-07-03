<style>
    .blinking {
        animation: blinkingText 0.8s infinite;
    }

    @keyframes blinkingText {
        0% {
            color: #000000;
        }

        50% {
            color: transparent;
        }

        100% {
            color: #000000;
        }
    }

    .wrapper {
        width: 100%;
        margin: 0 auto;
    }

    .zoom-effect {
        position: relative;
        width: 100%;
        height: 360px;
        margin: 0 auto;
        overflow: hidden;
    }

    .kotak {
        position: absolute;
        top: 0;
        left: 0;
    }

    .kotak img {
        -webkit-transition: 0.4s ease;
        transition: 0.4s ease;
        width: 100%;
    }

    .zoom-effect:hover .kotak img {
        -webkit-transform: scale(1.08);
        transform: scale(1.08);
    }
</style>
<<div class="container">
    <div class="login-logo">
        <a href="<?= base_url(); ?>"><b>Tiket</b> GAC</a>
    </div>
    <div class="login-box-body">
        <section class="content">
            <button type="button" class="btn btn-link btn-flat" title="Cek status tiket" data-toggle="collapse"
                data-target="#cek-status">
                <b>RIWAYAT</b>
            </button>
            <div id="cek-status" class="collapse">
                <div class="box">
                    <form action="<?= base_url(); ?>" method="POST">
                        <div class="box box-warning">
                            <div class="box-body">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="400">Tanggal</th>
                                            <th width="200">Dibuat oleh</th>
                                            <th width="400">Departemen</th>
                                            <th width="200">lokasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $return = $this->db->query("SELECT * FROM input_limbah WHERE id  = '$tugas->id'")->result_array();
                                        ?>
                                        <?php foreach ($return as $data): ?>
                                            <tr>
                                                <td><?= $data['tanggal']; ?></td>
                                                <td><?= $data['nama_pelapor']; ?></td>
                                                <td><?= $data['dept_pelapor']; ?></td>
                                                <td><?= $data['lokasi']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                    </form>
                </div>
            </div>
    </div>
    <?= $this->session->flashdata('message'); ?>
    <div class="box">
        <form action="<?= base_url('tugas/ubah/' . $tugas->id); ?>" method="POST" enctype="multipart/form-data">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="form-group col-sm-6">
                        <table class="table table-striped">
                            <tr>
                                <th style="width: 25px"></th>
                                <th style="width: 25px"></th>
                            </tr>
                            <tr>
                                <td><b>Nomor Tiket limbah</td>
                                <td><?= $tugas->id; ?></td>
                            </tr>
                            <tr>
                                <td><b>Departemen</td>
                                <td><input type="text" class="form-control input-sm" name="dept_pelapor"
                                        value="<?= $tugas->dept_pelapor; ?>" placeholder="dept pelapor" required></td>

                            </tr>
                            <tr>
                                <td><b>Nama Pelapor</td>
                                <td><input type="text" class="form-control input-sm" name="nama_pelapor"
                                        value="<?= $tugas->nama_pelapor; ?>" placeholder="nama pelapor" required></td>

                            </tr>
                            <tr>
                                <td><b>Email</td>
                                <td><input type="text" class="form-control input-sm" name="email"
                                        value="<?= $tugas->email; ?>" placeholder="email" required></td>

                            </tr>
                            <tr>
                                <td><b>jenis limbah</td>
                                <td><input type="text" class="form-control input-sm" name="jenislimbah"
                                        value="<?= $tugas->jenislimbah; ?>" placeholder="jenislimbah" required></td>
                            </tr>
                            <tr>
                                <td><b>Lokasi</td>
                                <td><input type="text" class="form-control input-sm" name="lokasi"
                                        value="<?= $tugas->lokasi; ?>" placeholder="lokasi" required></td>
                            </tr>
                            <tr>
                                <td><b>Foto</td>
                                <td>
                                    <a href="" target="popup"
                                        onclick="window.open('<?= base_url(); ?>file/<?= $data['lampiran1']; ?>','popup','width=100%'); return false;">
                                        <img src="<?= base_url(); ?>file/<?= $data['lampiran1']; ?>" height="50px"
                                            weight="50px">
                                    </a>
                                    <a href="" target="popup"
                                        onclick="window.open('<?= base_url(); ?>file/<?= $data['lampiran2']; ?>','popup','width=600px, height=600px'); return false;">
                                        <img src="<?= base_url(); ?>file/<?= $data['lampiran2']; ?>" height="50px"
                                            weight="50px">
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="form-group col-sm-6">
                        <input type="hidden" name="id" value="<?= $data['id']; ?>">
                        <table class="table table-striped">
                            <tr>
                                <th style="width: 25px"></th>
                                <th style="width: 25px"></th>
                            </tr>
                            <tr>
                                <td><b>Timbangan awal</td>
                                <td><input type="text" class="form-control input-sm" name="timbangan_awal"
                                        value="<?= $tugas->timbangan_awal; ?>" placeholder="timbangan_awal" required>
                                </td>

                            </tr>
                            <tr>
                                <td><b>Timbangan akhir</td>
                                <td><input type="text" class="form-control input-sm" name="timbangan_akhir"
                                        value="<?= $tugas->timbangan_akhir; ?>" placeholder="timbangan_akhir" required>
                                </td>


                            </tr>
                            <tr>
                                <td><b>Quantity mutasi</b></td>
                                <td><input type="text" class="form-control input-sm" name="quantity_mutasi"
                                        value="<?= $tugas->quantity_mutasi; ?>" placeholder="quantity_mutasi" required>
                                </td>

                            </tr>
                            <tr>
                                <td><b>platnomer</b></td>
                                <td><input type="text" class="form-control input-sm" name="platnomer"
                                        value="<?= $tugas->platnomer; ?>" placeholder="platnomer" required></td>
                            </tr>
                            <tr>
                                <td><b>Catatan</b></td>
                                <td>
                                    <textarea name="permasalahan" rows="3" style="width: 100%;"
                                        required><?= $tugas->permasalahan; ?></textarea>

                                </td>
                            </tr>
                            <!--<tr>
                                <td><b>Foto</b><br></td>
                                <td>
                                    <?php if ($data['lampiran_selesai1'] && $data->ukuran_file_selesai1 && $data->tipe_file_selesai1 && $data->lampiran_selesai2 && $data->ukuran_file_selesai2 && $data->tipe_file_selesai2): ?>
                                        <a href="" target="popup"
                                            onclick="window.open('<?= base_url(); ?>file/<?= $data['lampiran_selesai1']; ?>','popup','width=100%'); return false;">
                                            <img src="<?= base_url(); ?>file/<?= $data['lampiran_selesai1']; ?>"
                                                height="50px" weight="50px">
                                        </a>
                                        <a href="" target="popup"
                                            onclick="window.open('<?= base_url(); ?>file/<?= $data['lampiran_selesai2']; ?>','popup','width=600px, height=600px'); return false;">
                                            <img src="<?= base_url(); ?>file/<?= $data['lampiran_selesai2']; ?>"
                                                height="50px" weight="50px">
                                        </a>
                                    <?php else: ?>
                                        <input type="file" name="lampiran1"><br>
                                        <input type="file" name="lampiran2">
                                    <?php endif; ?>
                                </td>
                            </tr>-->
                            <tr>
                                <td><b>Tanggal</b></td>
                                <td><?= $tugas->tanggal; ?></td>
                                <!-- <td><input type="date" class="form-control input-sm" name="tanggal" value="<?= $data['tanggal'] ?>" disabled></td> -->
                            </tr>

                        </table>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="pull-left">
                        <button type="submit" name="submit" class="btn bg-red btn-flat" style="font-size: 12px;">UPDATE
                            TIKET</button>
                        <a href="<?= base_url('tugas/tiket'); ?>" class="btn btn-link btn-flat"
                            style="font-size: 12px;">BATAL</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </section>
    </div>
    </div>