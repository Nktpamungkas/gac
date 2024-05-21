    <script src="<?= base_url(); ?>bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?= base_url(); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="<?= base_url(); ?>bower_components/select2/dist/js/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="<?= base_url(); ?>plugins/input-mask/jquery.inputmask.js"></script>
    <script src="<?= base_url(); ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="<?= base_url(); ?>plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- date-range-picker -->
    <script src="<?= base_url(); ?>bower_components/moment/min/moment.min.js"></script>
    <script src="<?= base_url(); ?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap datepicker -->
    <script src="<?= base_url(); ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- bootstrap color picker -->
    <script src="<?= base_url(); ?>bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <!-- bootstrap time picker -->
    <script src="<?= base_url(); ?>plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- SlimScroll -->
    <script src="<?= base_url(); ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="<?= base_url(); ?>plugins/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="<?= base_url(); ?>bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url(); ?>dist/js/demo.js"></script>
    <!-- table -->
    <script src="<?= base_url(); ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- Page script -->
    <script>
        $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
        //Money Euro
        $('[data-mask]').inputmask()

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' } })
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),
            endDate: moment()
            },
            function (start, end) {
            $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        )

        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        })

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        })

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        //Timepicker
        $('.timepicker').timepicker({
            showInputs: false
        })
        })
    </script>
    

<!-- FastClick -->
<script src="<?= base_url(); ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url(); ?>dist/js/demo.js"></script>
<script src="<?= base_url(); ?>bower_components/xeditable/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script>
    $.fn.editable.defaults.mode = 'inline';
    $(document).ready(function() {
        $('.dept').editable({
            type: 'text',
            disabled : false,
            url: '<?= base_url(); ?>Tugas/updatemesin_dept'
        });
    })
    $(document).ready(function() {
        $('.no_mesin').editable({
            type: 'text',
            disabled : false,
            url: '<?= base_url(); ?>Tugas/updatemesin_nomesin'
        });
    })
    $(document).ready(function() {
        $('.jenis').editable({
            type: 'text',
            disabled : false,
            url: '<?= base_url(); ?>Tugas/updatemesin_jenis'
        });
    })
    $(document).ready(function() {
        $('.merk').editable({
            type: 'text',
            disabled : false,
            url: '<?= base_url(); ?>Tugas/updatemesin_merk'
        });
    })
    $(document).ready(function() {
        $('.capacity').editable({
            type: 'text',
            disabled : false,
            url: '<?= base_url(); ?>Tugas/updatemesin_capacity'
        });
    })
    $(document).ready(function() {
        $('.freon').editable({
            type: 'text',
            disabled : false,
            url: '<?= base_url(); ?>Tugas/updatemesin_freon'
        });
    })
    $(document).ready(function() {
        $('.lokasi').editable({
            type: 'text',
            disabled : false,
            url: '<?= base_url(); ?>Tugas/updatemesin_lokasi'
        });
    })
    $('.kategori').editable({
        type: 'select',
        url: '<?= base_url(); ?>Tugas/updatemesin_kategori',
        disabled : false,
        showbuttons : false,
        source:[{value: "", text: ""}, 
                {value: "AC", text: "AC"},
                {value: "Kebersihan", text: "Kebersihan"},
                {value: "Building", text: "Building"}]
    });
    $(document).ready(function() {
        $('.pemasangan').editable({
            type: 'date',
            disabled : false,
            url: '<?= base_url(); ?>Tugas/updatemesin_pemasangan'
        });
    })
    $('.status').editable({
        type: 'select',
        url: '<?= base_url(); ?>Tugas/updatemesin_status',
        disabled : false,
        showbuttons : false,
        source:[{value: "", text: ""}, 
                {value: "AKTIF INDOOR", text: "AKTIF INDOOR"},
                {value: "AKTIF OUTDOOR", text: "AKTIF OUTDOOR"},
                {value: "TIDAK AKTIF INDOOR", text: "TIDAK AKTIF INDOOR"},
                {value: "TIDAK AKTIF OUTDOOR", text: "TIDAK AKTIF OUTDOOR"},
                {value: "STOCK GAC", text: "STOCK GAC"}]
    })
    $(document).ready(function() {
        $('.note').editable({
            title: 'Enter comments',
            rows: 5,
            url: '<?= base_url(); ?>Tugas/updatemesin_note'
        });
        
    })
    $(document).ready(function() {
        $('.keterangan').editable({
            title: 'Enter comments',
            rows: 5,
            url: '<?= base_url(); ?>Tugas/updatemesin_keterangan'
        });
    })

</script>
<script>
  $(document).ready(function() {
    // $('.js-example-basic-single').select2();
  });

  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable()
    $('#example3').DataTable()
    $('#example4').DataTable()
    $('#example5').DataTable()
})
</script>
</body>
</html>