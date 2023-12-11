<script src="<?= base_url(); ?>bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#durasi').change(function(){
            var duration = document.getElementById('durasi').value;
            var hariKedepan = new Date(new Date(document.getElementById('datepicker2').value).getTime()+(duration*24*60*60*1000));
            let formatted_date = (hariKedepan.getMonth() + 1) + "/" + hariKedepan.getDate() + "/" + hariKedepan.getFullYear()

            document.getElementById('tgl_selesai').value = formatted_date;
        });
        
        $('#datepicker2').change(function(){
            var duration = document.getElementById('durasi').value;
            var hariKedepan = new Date(new Date(document.getElementById('datepicker2').value).getTime()+(duration*24*60*60*1000));
            let formatted_date = (hariKedepan.getMonth() + 1) + "/" + hariKedepan.getDate() + "/" + hariKedepan.getFullYear()

            document.getElementById('tgl_selesai').value = formatted_date;
        });
    });

    function tambahNama() {
        var idf = document.getElementById("idf").value;
        var stre = "<div class='form-group'><p id='srow" + idf + "'><input class='form-control input-sm' name='daftar_checklist[]' placeholder='Hal yang harus dilakukan:'><a href='#' style=\"color:#3399FD;\" onclick='hapusElemen(\"#srow" + idf + "\"); return false;'><i class='fa fa-close red'></i> Hapus</a></p></div>";
        $("#divSite").append(stre);
        idf = (idf - 1) + 2;
        
        document.getElementById("idf").value = idf;
    }

    function hapusElemen(idf) {
        $(idf).remove();
    }

    function uploadFile() {
        // membaca data file yg akan diupload, dari komponen 'fileku'
        var file = document.getElementById("fileku").files[0];
        var formdata = new FormData();
        formdata.append("datafile", file);
        
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
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Edit Tugas #<?= $tugas->id; ?>
        </h1>
        
    </section>
    <section class="content">
        <div class="box">
            <div class="box box-primary">
                <form action="<?= base_url(); ?>tugas/edit/<?= $tugas->id; ?>/<?= $user['dept']; ?>" method="POST" enctype="multipart/form-data">
                    <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                        <div class="pull-right box-tools">
                            <label>
                                <input type="checkbox" name="prioritas" value="prioritas" class="minimal-red" <?php if($tugas->prioritas == 1) { echo "checked"; } ?>>
                                Prioritas tinggi <i class="fa fa-fire" style="color: red;"></i>
                            </label>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="judul" placeholder="Hal yang harus dilakukan:" value="<?= $tugas->judul; ?>">
                            <input type="hidden" name="tugas_cepat" value="0">
                        </div>
                        <div class="form-group">
                            <textarea id="editor1" name="deskripsi" rows="10" cols="80"><?= $tugas->deskripsi; ?></textarea>
                        </div>
                        <script>
                            $(function () {
                                CKEDITOR.replace('editor1')
                                $('.textarea').wysihtml5()
                            })
                        </script>
                        <div class="form-group">
                            <?php if($tugas->lampiran == "") : ?> 
                            <div class="btn btn-default">
                                <input type="file" name="lampiran" id="fileku" value="null">
                            </div>
                            
                            <input type="button" value="Upload File" class="btn btn-success" onclick="uploadFile()">
                            <i style="font-size: 12px;">Max. 10MB (*.pdf, *.xlsx, *.xls, *.doc, *.docs, *.jpeg, *.png)</i><br>

                            <progress id="progressBar" value="0" max="100" style="width:100px;" hidden></progress>
                            <span id="status" style="font-size: 12px; color: red; font-weight: bold;"></span>
                            <?php else : ?>
                            Lampiran : 
                            <label>
                                <a href="<?= base_url(); ?>tugas/download_hapus/<?= $tugas->id; ?>" style="color: red;" title="Hapus Lampiran"><span class="fa fa-close"></span></a>
                                    <?= $tugas->lampiran; ?> 
                                <a href="<?= base_url(); ?>tugas/download/<?= $tugas->id; ?>" style="font-size: 12px; font-family: microsoft sans serif;">Download</a>
                            </label>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <button class="btn bg-navy btn-flat margin" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Daftar Cheklist
                            </button>
                            <br>
                            <?php $result_daftarperiksa = $this->db->get_where('daftar_checklist', array('id_tugas' => $tugas->id))->result_array(); $no = 1; ?>
                                <?php foreach($result_daftarperiksa AS $data) : ?>
                                    <span class="hover<?= $data['id']; ?>"><?= $no++; ?>. <?= $data['daftar_checklist']; ?></span><br>
                                    <script>
                                        $( "span.hover<?= $data['id']; ?>" ).hover(
                                            function() {
                                                $( this ).append( $( ' <a href="<?= base_url(); ?>tugas/daftarchecklist_hapus/<?= $tugas->dibuat_oleh; ?>/<?= $tugas->id; ?>/<?= $data['id']; ?>/<?= $data['daftar_checklist']; ?>" style="color: red;" title="hapus daftar checklist"><span class="fa fa-close"></span></a>' ) );
                                            }, function() {
                                                $( this ).find( "a" ).last().remove();
                                            }
                                        );
                                    </script>
                                <?php endforeach; ?>
                            <div class="box-body">
                                <div class="collapse" id="collapseExample">
                                    <p><u><h5>Daftar Periksa</h5></u></p>
                                    
                                    <div class="col-lg-12" id="divSite" class="form-group">
                                        <input id="idf" value="1" type="hidden">
                                    </div>
                                    
                                    <a href="#" class="fa fa-plus" onclick="tambahNama(); return false;"> Tambah Daftar Periksa</a> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box">
                        <div class="box-body">
                            <div class="form-group col-sm-12">
                                <label class="col-sm-2 control-label">Penanggung Jawab</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" style="width: 100%;" name="penanggung_jawab" required>
                                    <?php $return = $this->db->get('user')->result_array(); ?>
                                        <option value="" disabled selected>Penanggung Jawab</option>
                                    <?php foreach($return AS $data) : ?>
                                        <option value="<?= $data['id']; ?>" <?php if($tugas->penanggung_jawab == $data['id']){ echo "SELECTED"; } ?>><?= $data['email']; ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <label class="col-sm-2 control-label">Dibuat Oleh</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control input-sm" name="dibuat_oleh" placeholder="Dibuat Oleh" value="<?= $tugas->dibuat_oleh; ?>" required>
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <label class="col-sm-2 control-label">Tenggat Waktu</label>
                                <div class="col-sm-4">
                                    <input type="text" id="datepicker" name="tenggat_waktu" class="form-control input-sm" size="5" value="<?php echo date("m/d/Y",strtotime($tugas->tenggat_waktu)); ?>">
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#Perencanaan-Waktu">Perencanaan Waktu</button>
                                <div class="col-sm-12">
                                    <div id="Perencanaan-Waktu" class="<?php if($tugas->mulai_tugas_pada == "1970-01-01"){ echo "collapse"; } ?>">
                                        <div class="box-body">
                                                <label class="col-sm-2 control-label"></label>
                                                <div class="col-sm-9">
                                                    <label class="col-sm-3 control-label">Mulai Tugas Pada</label>
                                                    <label><input type="text" id="datepicker2" name="tgl_mulai" class="form-control input-sm" value="<?php echo date("m/d/Y",strtotime($tugas->mulai_tugas_pada)); ?>"></label>
                                                </div>
                                                <label class="col-sm-2 control-label"> </label>
                                                <div class="col-sm-9">
                                                    <label class="col-sm-3 control-label">Durasi</label>
                                                    <label><input type="text" onkeypress="myFunction()" id="durasi" name="durasi" class="form-control input-sm" size="5" value="<?= $tugas->durasi; ?>"></label> / Hari <i style="font-size: 10px">(To change, please press "Tab")</i>
                                                </div>
                                                <label class="col-sm-2 control-label"> </label>
                                                <div class="col-sm-9">
                                                    <label class="col-sm-3 control-label">Selesaikan</label>
                                                    <label><input type="text" id="tgl_selesai" name="tgl_selesai" class="form-control input-sm" value="<?php echo date("m/d/Y",strtotime($tugas->selesaikan)); ?>" readonly></label>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="pull-left">
                            <button type="submit" name="submit" class="btn bg-green btn-flat" style="font-size: 12px;">SIMPAN PERUBAHAN</button>
                            <a href="<?= base_url(); ?>tugas" class="btn btn-link btn-flat" style="font-size: 12px;">BATAL</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>