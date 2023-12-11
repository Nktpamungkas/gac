<script language="javascript">
    function tambahNama() {
        var idf = document.getElementById("idf").value;
        var stre = "<div class='form-group'><p id='srow" + idf + "'><input class='form-control input-sm' placeholder='Hal yang harus dilakukan:'><a href='#' style=\"color:#3399FD;\" onclick='hapusElemen(\"#srow" + idf + "\"); return false;'><i class='fa fa-close red'></i> Hapus</a></p></div>";
        $("#divSite").append(stre);
        idf = (idf - 1) + 2;
        
        document.getElementById("idf").value = idf;
    }

    function hapusElemen(idf) {
        $(idf).remove();
    }
</script>
<style> 
    .div1 {
    width: 300px;
    height: 100px;
    border: 0px solid blue;
    background: #F0F8FF;
    }
</style>
    <section class="content">
        <!-- START TUGAS BARU -->
            <button type="button" class="btn bg-blue btn-app" data-toggle="collapse" data-target="#Tugas-Baru">
                    <i class="fa fa-inbox"></i>Tugas Baru
            </button>
        <!-- END TUGAS BARU -->

        <!-- START TUGAS BARU CEPAT-->
            <button type="button" class="btn bg-orange btn-app" data-toggle="collapse" data-target="#Tugas-Baru-Cepat">
                <i class="fa fa-bolt" title="Buat tugas cepat"></i>Tugas Baru
            </button>
        <!-- END TUGAS BARU CEPAT-->

        <!-- START MODAL TUGAS BARU -->
            <div id="Tugas-Baru" class="collapse">
                <div class="box">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tugas baru</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Hal yang harus dilakukan:">
                            </div>
                            <div class="form-group">
                                <textarea id="compose-textarea" class="form-control" style="height: 200px"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="btn btn-default btn-file">
                                    <i class="fa fa-paperclip"></i> Lampiran
                                    <input type="file" name="attachment">
                                </div>
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    Daftar Cheklist
                                </button>
                            </div>
                            <div class="form-group" style="background-color:#F0F8FF;">
                                <div class="collapse" id="collapseExample">
                                    <div class="box">
                                        <div class="card card-body">
                                            <p><u><h5>Daftar Periksa</h5></u></p>
                                            
                                            <div class="col-lg-12" id="divSite" class="form-group">
                                                <input id="idf" value="1" type="hidden">
                                            </div>
                                            
                                            <a href="#" class="fa fa-plus" onclick="tambahNama(); return false;"> Tambah Daftar Periksa</a> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Penanggung Jawab</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail3" placeholder="Penanggung Jawab">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Dibuat Oleh</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail3" placeholder="Dibuat Oleh">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Tenggat Waktu</label>
                                    <div class="col-sm-10">
                                        <input type="datetime-local" name="tenggat_waktu" class="form-control" size="5">
                                    </div>
                                </div>
                                
                                <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#Perencanaan-Waktu">Perencanaan Waktu</button>

                                <div id="Perencanaan-Waktu" class="collapse">
                                    <div class="form-group">
                                        <div class="box">
                                            <label for="inputEmail3" class="col-sm-2 control-label"> </label>
                                            <div class="col-sm-10">
                                                <label for="inputEmail3" class="col-sm-2 control-label">Mulai Tugas Pada</label>
                                                <label><input type="datetime-local" class="form-control"></label>
                                            </div>
                                            <label for="inputEmail3" class="col-sm-2 control-label"> </label>
                                            <div class="col-sm-10">
                                                <label for="inputEmail3" class="col-sm-2 control-label">Durasi</label>
                                                <label><input type="text" class="form-control" size="5"></label> / Hari
                                            </div>
                                            <label for="inputEmail3" class="col-sm-2 control-label"> </label>
                                            <div class="col-sm-10">
                                                <label for="inputEmail3" class="col-sm-2 control-label">Selesaikan</label>
                                                <label><input type="datetime-local" class="form-control"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <div class="pull-left">
                                <button type="button" class="btn bg-green btn-flat">Tambahkan Tugas</button>
                                <button type="submit" class="btn btn-link btn-flat" data-toggle="collapse" data-target="#Tugas-Baru">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- END MODAL TUGAS BARU -->
        
        <!-- START MODAL TUGAS BARU CEPAT-->
            <div id="Tugas-Baru-Cepat" class="collapse">
                <div class="box">
                    <div class="box box-warning">
                        <div class="box-body">
                            <div class="form-group col-sm-8">
                                <input type="text" class="form-control" placeholder="Hal yang harus dilakukan:">
                            </div>
                            <div class="form-group col-sm-2">
                                <input type="datetime-local" class="form-control">
                            </div>
                            <div class="form-group col-sm-2">
                                <input type="text" class="form-control" placeholder="Dibuat Oleh:">
                            </div>
                            <div class="form-group col-sm-12">
                                <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#Deskripsi-Tugas-Baru-Cepat">
                                    <u>Deskripsi</u>
                                </button>
                                <div id="Deskripsi-Tugas-Baru-Cepat" class="collapse">
                                    <textarea id="compose-textarea" class="form-control" placeholder="Deskripsi Tugas" style="height: 150px"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="pull-left">
                                <button type="button" class="btn bg-green btn-flat">Simpan</button>
                                <button type="submit" class="btn btn-link btn-flat" data-toggle="collapse" data-target="#Tugas-Baru-Cepat">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- END MODAL TUGAS BARU CEPAT-->
        
        <!-- START HALAMAN INDEX -->
            <div class="box">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                        <li><a href="#perencana" data-toggle="tab">Perencana</a></li>
                        <li class="active"><a href="#daftar" data-toggle="tab">Daftar</a></li>
                        <li class="pull-left header"><i class="fa fa-th"></i> Projects</li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="daftar">
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="10"><i class="fa fa-gear"></i></th>
                                            <th width="400">Nama</th>
                                            <th width="200">Tenggat Waktu</th>
                                            <th width="50">Dept</th>
                                            <th width="200">Dibuat Oleh</th>
                                            <th width="200">Penanggung Jawab</th>
                                            <th width="200">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $result = $this->db->query("SELECT * FROM tbl_permintaan")->result_array(); 
                                        ?>
                                        <?php foreach($result AS $dt) : ?>
                                        <tr>
                                            <td>
                                                <li class="dropdown" style="list-style-type:none;">
                                                    <a href="#" class="fa fa-bars dropdown-toggle" data-toggle="dropdown"></a>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="<?= base_url(); ?>tasks/view">Tampilkan</a></li>
                                                        <li><a href="#">Edit</a></li>
                                                        <li><a href="#">Buat subtugas</a></li>
                                                        <li><a href="#">Mulai</a></li>
                                                        <li><a href="#">Undur</a></li>
                                                        <li><a href="#">Tambah Keperencana Harian</a></li>
                                                        <li><a href="#">Hapus</a></li>
                                                        <li><a href="#">Applications</a></li>
                                                    </ul>
                                                </li>
                                            </td>
                                            <td><a href="<?= base_url(); ?>tasks/view" style="color: grey; text-decoration: line-through;">Nilokusumo Tri Pamungkas (Diselesaikan)</a></td>
                                            <td>05 September 2019, 07:00 WIB</td>
                                            <td>HRD</td>
                                            <td>user</td>
                                            <td>Penanggung Jawab</td>
                                            <td>Diteruskan ke programmer</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <li class="dropdown" style="list-style-type:none;">
                                                    <a href="#" class="fa fa-bars dropdown-toggle" data-toggle="dropdown"></a>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="<?= base_url(); ?>tasks/view">Tampilkan</a></li>
                                                        <li><a href="#">Edit</a></li>
                                                        <li><a href="#">Buat subtugas</a></li>
                                                        <li><a href="#">Mulai</a></li>
                                                        <li><a href="#">Undur</a></li>
                                                        <li><a href="#">Tambah Keperencana Harian</a></li>
                                                        <li><a href="#">Hapus</a></li>
                                                        <li><a href="#">Applications</a></li>
                                                    </ul>
                                                </li>
                                            </td>
                                            <td><a href="<?= base_url(); ?>tasks/view" style="color: grey;">Nilokusumo Tri Pamungkas (Diundur)</a></td>
                                            <td>05 September 2019, 07:00 WIB</td>
                                            <td>HRD</td>
                                            <td>user</td>
                                            <td>Penanggung Jawab</td>
                                            <td>Diteruskan ke programmer</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <li class="dropdown" style="list-style-type:none;">
                                                    <a href="#" class="fa fa-bars dropdown-toggle" data-toggle="dropdown"></a>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="<?= base_url(); ?>tasks/view">Tampilkan</a></li>
                                                        <li><a href="#">Edit</a></li>
                                                        <li><a href="#">Buat subtugas</a></li>
                                                        <li><a href="#">Mulai</a></li>
                                                        <li><a href="#">Undur</a></li>
                                                        <li><a href="#">Tambah Keperencana Harian</a></li>
                                                        <li><a href="#">Hapus</a></li>
                                                        <li><a href="#">Applications</a></li>
                                                    </ul>
                                                </li>
                                            </td>
                                            <td><a href="<?= base_url(); ?>tasks/view" style="color: black;">Nilokusumo Tri Pamungkas (Belum/Sedang dikerjakan)</a></td>
                                            <td>05 September 2019, 07:00 WIB</td>
                                            <td>HRD</td>
                                            <td>user</td>
                                            <td>Penanggung Jawab</td>
                                            <td>Diteruskan ke programmer</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <li class="dropdown" style="list-style-type:none;">
                                                    <a href="#" class="fa fa-bars dropdown-toggle" data-toggle="dropdown"></a>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="<?= base_url(); ?>tasks/view">Tampilkan</a></li>
                                                        <li><a href="#">Edit</a></li>
                                                        <li><a href="#">Buat subtugas</a></li>
                                                        <li><a href="#">Mulai</a></li>
                                                        <li><a href="#">Undur</a></li>
                                                        <li><a href="#">Tambah Keperencana Harian</a></li>
                                                        <li><a href="#">Hapus</a></li>
                                                        <li><a href="#">Applications</a></li>
                                                    </ul>
                                                </li>
                                            </td>
                                            <td><a href="<?= base_url(); ?>tasks/view" style="color: black;">Nilokusumo Tri Pamungkas </a> <a href="#"><i class="fa fa-commenting" style="color: grey; font-size:13px;"> 3</i></a></td>
                                            <td>05 September 2019, 07:00 WIB</td>
                                            <td>HRD</td>
                                            <td>user</td>
                                            <td>Penanggung Jawab</td>
                                            <td>Diteruskan ke programmer</td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="perencana">
                            
                        </div>
                    </div>
                </div>
            </div>
        <!-- END HALAMAN INDEX -->
    </section>
</div>