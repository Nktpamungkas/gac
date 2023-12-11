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
                } else if (kat == 'Kebersihan'){
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
        <a href="<?= base_url(); ?>auth/tiketbaru" class="btn btn-link btn-flat">
            Kembali
        </a>
        <form action="<?= base_url(); ?>tugas/cektiket" method="POST" enctype="multipart/form-data">
            masukan nomor tiket anda : <input type="text" name="nomortiket" required> &nbsp; <button type="submit" name="submit" class="btn bg-green btn-flat" style="font-size: 12px;">Cari tiket</button>
        </form>
        <div id="cek-status">
            <div class="box">
                <div class="box box-warning">
                    <div class="box-body">
                        <table id="example1" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="10"><i class="fa fa-gear"></i></th>
                                    <th width="100">Nomor Tiket</th>
                                    <th width="100">Nama</th>
                                    <th width="50">Dept</th>
                                    <th width="400">Permasalahan</th>
                                    <th width="200">Lokasi</th>
                                    <th width="200">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    // echo $get_nameComp   = gethostbyaddr($_SERVER['REMOTE_ADDR']); 
                                    // $return = $this->db->query("SELECT * FROM tbl_tugas WHERE NOT `status` = 'Close' AND dept_pelapor = '$get_nameComp' ORDER BY prioritas DESC")->result_array();
                                    $return = $this->db->query("SELECT * FROM tbl_tugas WHERE id = '$nomortiket'")->result_array(); 
                                ?>
                                <?php foreach($return AS $data) : ?>
                                    <tr <?php if($data['prioritas'] == 1){ echo "bgcolor='#FFE4B5'"; } ?> >
                                        <td>
                                            <li class="dropdown" style="list-style-type:none;">
                                                <a href="#" class="fa fa-bars dropdown-toggle" data-toggle="dropdown"></a>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="<?= base_url(); ?>auth/view/<?= $data['id']; ?>">Tampilkan</a></li>
                                                    <li><a href="<?= base_url(); ?>auth/view_edit/<?= $data['id']; ?>">Edit</a></li>
                                                    <!-- <li><a href="<?= base_url(); ?>auth/hapus/<?= $data['id']; ?>">Hapus</a></li> -->
                                                </ul>
                                            </li>
                                        </td>
                                        <td bgcolor="#89D6BA"><b><center><?= $data['id']; ?></center></b></td>
                                        <td>
                                            <a href="<?= base_url(); ?>auth/view/<?= $data['id']; ?>" title="view: <?= $data['nama_pelapor']; ?>">
                                                <?= $data['nama_pelapor']; ?>
                                            </a>
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
                                        <td <?php if($data['status'] == "Delay"){ echo "bgcolor='#FFE4B5'"; } ?> class="<?php if($data['status'] == "Progress") { echo "blinking"; } ?>" style="
                                                    <?php if($data['status'] == 'Open'){
                                                        echo 'font-weight: bold;';
                                                    } ?>">
                                            <?= $data['status']; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

