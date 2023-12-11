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
    
    function progressHandler(event){
        // hitung prosentase
        var percent = (event.loaded / event.total) * 100;
        // menampilkan prosentase ke komponen id 'progressBar'
        document.getElementById("progressBar").value = Math.round(percent);
        // menampilkan prosentase ke komponen id 'status'
        document.getElementById("status").innerHTML = Math.round(percent)+"% telah terupload";
        // menampilkan file size yg tlh terupload dan totalnya ke komponen id 'total'
        document.getElementById("total").innerHTML = "Telah terupload "+event.loaded+" bytes dari "+event.total;
    }
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#kategori').on('change', function() {
            var kat  = document.getElementById("kategori").value;
            if (kat == "AC"){
                $.ajax({
                    dataType: "JSON",
                    type: 'POST',
                    url: '<?= base_url("auth/pilihandept") ?>',
                    data: {
                        'kategori' : kat
                    },
                    success: function(response) {
                        $("#dept").empty(), 
                        $("#dept").append(`<option selected disabled>-Area-</option>`)
                        $.each(response, function(i, item) {
                            $("#dept").append(`<option value="${item.dept}">${item.dept}</option>`)
                        });
                    }
                });
            } else if (kat == 'Kebersihan'){
                document.getElementById("fileku1").setAttribute("required", "required"); //jika pilihannya kebersihan maka diwajibkan melampirkan minimal 1 foto
                $.ajax({
                    dataType: "JSON",
                    type: 'POST',
                    url: '<?= base_url("auth/pilihandept") ?>',
                    data: {
                        'kategori' : kat
                    },
                    success: function(response) {
                        $("#dept").empty(), 
                        $("#dept").append(`<option selected disabled>-Area-</option>`)
                        $.each(response, function(i, item) {
                            $("#dept").append(`<option value="${item.dept}">${item.dept}</option>`)
                        });
                    }
                });
            }else if (kat == 'Building'){
                $.ajax({
                    dataType: "JSON",
                    type: 'POST',
                    url: '<?= base_url("auth/pilihandept") ?>',
                    data: {
                        'kategori' : kat
                    },
                    success: function(response) {
                        $("#dept").empty(), 
                        $("#dept").append(`<option selected disabled>-Building-</option>`)
                        $.each(response, function(i, item) {
                            $("#dept").append(`<option value="${item.dept}">${item.dept}</option>`)
                        });
                    }
                });
            }
        });

        $('#dept').on('change', function() {
            var kat  = document.getElementById("kategori").value;
            if (kat){ //kategori harus dipilih terlebih dahulu
                // let kat = $(this).find('option:selected').attr('id');
                var kat  = document.getElementById("kategori").value;
                var dept  = document.getElementById("dept").value;

                if (kat == "AC"){
                    $.ajax({
                        dataType: "JSON",
                        type: 'POST',
                        url: '<?= base_url("auth/data_mesin") ?>',
                        data: {
                            'kategori': kat,
                            'dept' : dept
                        },
                        success: function(response) {
                            $("#no_mesin").empty(), 
                            $("#no_mesin").append(`<option selected disabled>-Nomor AC-</option>`)
                            $.each(response, function(i, item) {
                                $("#no_mesin").append(`<option value="${item.id}">${item.no_mesin} ${item.merk} ${item.jenis}</option>`)
                            });
                        }
                    });
                }else if (kat == 'Kebersihan'){
                    $.ajax({
                        dataType: "JSON",
                        type: 'POST',
                        url: '<?= base_url("auth/data_mesin") ?>',
                        data: {
                            'kategori': kat,
                            'dept' : dept
                        },
                        success: function(response) {
                            $("#no_mesin").empty(), 
                            $("#no_mesin").append(`<option selected disabled>-Kebersihan-</option>`)
                            $.each(response, function(i, item) {
                                $("#no_mesin").append(`<option value="${item.id}" >${item.jenis} ${item.capacity} ${item.lokasi}</option>`)
                            });
                        }
                    });
                }else if (kat == 'Building'){
                    $.ajax({
                        dataType: "JSON",
                        type: 'POST',
                        url: '<?= base_url("auth/data_mesin") ?>',
                        data: {
                            'kategori': kat,
                            'dept' : dept
                        },
                        success: function(response) {
                            $("#no_mesin").empty(), 
                            $("#no_mesin").append(`<option selected disabled>-Building-</option>`)
                            $.each(response, function(i, item) {
                                $("#no_mesin").append(`<option value="${item.id}" >${item.jenis} ${item.lokasi}</option>`)
                            });
                        }
                    });
                }
            } else {
                alert("Silahkan pilih kategori terlebih dahulu.");
                $("#dept").append(`<option selected disabled>Departement:</option>`)
            }
        });
    });
</script>
<style>
    .blinking{
        animation:blinkingText 0.8s infinite;
    }
    @keyframes blinkingText{
        0%{     color: ser5ty6#00000;    }
        6q  
        5+++++100%{    color: transparent; }
        100%{   color: #00000;    }
    }
</style>
<div class="container">
    <div class="login-logo">
        <a href="<?= base_url(); ?>"><b>Tiket</b> Baru</a>
    </div>
    
    <div class="login-box-body">
        <button type="button" class="btn btn-link btn-flat" title="Cek status tiket" data-toggle="collapse" data-target="#cek-status">
            Cek status tiket anda disini 
        </button>
        <div id="cek-status" class="collapse">
            <div class="box">
                <div class="box box-warning">
                    <div class="box-body">
                        <form action="<?= base_url(); ?>tugas/cektiket" method="POST" enctype="multipart/form-data">
                        masukan nomor tiket anda : <input type="text" name="nomortiket" required> &nbsp; <button type="submit" name="submit" class="btn bg-green btn-flat" style="font-size: 12px;">Cari tiket</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <h6 class="login-box-msg">Buat tiket baru anda disini.</h6>
        <?= $this->session->flashdata('message'); ?>
            <!-- START MODAL TUGAS BARU -->
                <div class="box">
                    <div class="box box-primary">
                        <form action="<?= base_url(); ?>tugas/addNew" method="POST" enctype="multipart/form-data">
                            <div class="box-header with-border col-sm-12">
                                <h3 class="box-title">Tiket baru</h3>
                                <!-- <div class="pull-right box-tools">
                                    <label>
                                        <input type="checkbox" name="prioritas" value="prioritas" class="minimal-red">
                                        Prioritas tinggi <i class="fa fa-fire" style="color: red;"></i>
                                    </label>
                                </div> -->
                            </div>
                            <div class="box-body">
                                <div class="form-group col-sm-12" id="select_box">
                                    <select class="form-control" style="width: 100%;" name="kategori" id="kategori" required>
                                        <?php $return = $this->db->query('SELECT * FROM kategori')->result_array(); ?>
                                            <option value="" disabled selected>Kategori:</option>
                                        <?php foreach($return AS $data) : ?>
                                            <option value="<?= $data['kategori']; ?>"><?= $data['kategori']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-12" id="select_box">
                                    <select class="form-control select2 input-sm" style="width: 100%;" name="dept" id="dept" required>
                                        <option value="" disabled selected></option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-12">
                                    <select class="form-control select2" style="width: 100%;" name="dept_pelapor" required>
                                        <?php $return = $this->db->query('SELECT * FROM dept')->result_array(); ?>
                                            <option value="" disabled selected>Departemen Pelapor:</option>
                                        <?php foreach($return AS $data) : ?>
                                            <option value="<?= $data['code']; ?>"><?= $data['dept_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="text" class="form-control input-sm" name="nama_pelapor" placeholder="Nama pelapor:" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="text" class="form-control input-sm" name="email" placeholder="Email pelapor:">
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="text" class="form-control input-sm" name="lokasi" placeholder="Lokasi:" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <select class="form-control select2 input-sm" style="width: 100%;" name="id_mesin" id="no_mesin">
                                        <option value="" disabled selected></option>
                                    </select>
                                    *Klik<button type="button" class="btn btn-link" data-toggle="collapse" data-target="#lainnya">Disini</button>
                                    jika ingin menginput secara manual
                                    <div id="lainnya" class="collapse">
                                        <label class="col-sm-12"><input type="text" name="id_mesinmanual" placeholder="Masukan teks disini" class="form-control input-sm"></label>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12">
                                    <textarea id="editor1" name="permasalahan" rows="5" style="width: 100%;" placeholder="Permasalahan:" required></textarea>
                                </div>
                                <script>
                                    $(function () {
                                        CKEDITOR.replace('editor1')
                                        $('.textarea').wysihtml5()
                                    })
                                </script>
                                <div class="form-group">
                                    <div class="btn btn-default">
                                        <input type="file" name="lampiran1" id="fileku1" >
                                    </div>

                                    <div class="btn btn-default">
                                        <input type="file" name="lampiran2" id="fileku2" >
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
                                    <a href="<?= base_url(); ?>Auth" class="btn btn-link btn-flat" style="font-size: 12px;">Kembali ke login</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <!-- END MODAL TUGAS BARU -->
        </section>
    </div>
</div>

