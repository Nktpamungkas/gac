<footer class="main-footer">
    <div class="pull-right hidden-xs">
    <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2019-2020 <a href="#">Department Data & Informatika</a>.</strong> All rights reserved..
</footer>
<!-- jquery TAB-->
<script src="<?= base_url(); ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- select prioritas -->
<script src="<?= base_url(); ?>bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="<?= base_url(); ?>plugins/iCheck/icheck.min.js"></script>
<script src="<?= base_url(); ?>plugins/input-mask/jquery.inputmask.js"></script>
<!-- collapse -->
<script src="<?= base_url(); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- datetimepicker -->
<script src="<?= base_url(); ?>bower_components/moment/min/moment.min.js"></script>
<script src="<?= base_url(); ?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?= base_url(); ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- textarea editor -->
<script src="<?= base_url(); ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- minimize menu bar -->
<script src="<?= base_url(); ?>dist/js/adminlte.min.js"></script>
<!-- table -->
<script src="<?= base_url(); ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?= base_url(); ?>bower_components/raphael/raphael.min.js"></script>
<script src="<?= base_url(); ?>bower_components/morris.js/morris.min.js"></script>

<!-- FastClick -->
<script src="<?= base_url(); ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url(); ?>dist/js/demo.js"></script>
<script>
  $(function () {
     //Initialize Select2 Elements
     $('.select2').select2()
     $(".js-example-tags").select2({
        tags: true
      });

    //Add text editor
    $("#compose-textarea").wysihtml5();

    $.widget.bridge('uibutton', $.ui.button);
  });

    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable()
        $('#example3').DataTable()
        $('#example4').DataTable()
        $('#example5').DataTable()
        $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
        })
    })
    
    $(function () {
      //Date picker
      $('#datepicker').datepicker({
        autoclose: true,
        startDate: '-0d',
        format: 'mm/dd/yyyy'
      })
      
      $('#datepicker2').datepicker({
        autoclose: true,
        startDate: '-0d',
        format: 'mm/dd/yyyy'
      })
      

      $('#datepicker3').datepicker({
        autoclose: true,
        startDate: '-0d',
        format: 'mm/dd/yyyy'
      })
      
      $("#pengingat_datepicker").click(function() {
          $("#pengingat").show().focus();
          setTimeout(()=>{
            $("#pengingat").datepicker("show");
          },2)
      });

      //Red color scheme for iCheck
      $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass   : 'iradio_minimal-red'
      })
    })

</script>
</body>
</html>