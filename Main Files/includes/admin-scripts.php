    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    <!-- JQUERY JS -->
    <script src="../assets/js/jquery.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="../assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- SPARKLINE JS-->
    <script src="../assets/js/jquery.sparkline.min.js"></script>

    <!-- Sticky js -->
    <script src="../assets/js/sticky.js"></script>

    <!-- CHART-CIRCLE JS
    <script src="../assets/js/circle-progress.min.js"></script> -->

    <!-- PIETY CHART JS
    <script src="../assets/plugins/peitychart/jquery.peity.min.js"></script>
    <script src="../assets/plugins/peitychart/peitychart.init.js"></script>
    -->

    <!-- SIDEBAR JS -->
    <script src="../assets/plugins/sidebar/sidebar.js"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="../assets/plugins/p-scroll/perfect-scrollbar.js"></script>
    <script src="../assets/plugins/p-scroll/pscroll.js"></script>
    <script src="../assets/plugins/p-scroll/pscroll-1.js"></script>

    <!-- INTERNAL CHARTJS CHART JS
    <script src="../assets/plugins/chart/Chart.bundle.js"></script>
    <script src="../assets/plugins/chart/rounded-barchart.js"></script>
    <script src="../assets/plugins/chart/utils.js"></script>
    -->

    <!-- INTERNAL SELECT2 JS -->
    <script src="../assets/plugins/select2/select2.full.min.js"></script>

    <!-- INTERNAL Data tables js-->
    <script src="../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="../assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
    <script src="../assets/plugins/datatable/dataTables.responsive.min.js"></script>

    <!-- INTERNAL APEXCHART JS
    <script src="../assets/js/apexcharts.js"></script>
    <script src="../assets/plugins/apexchart/irregular-data-series.js"></script>
    -->

    <!-- INTERNAL Flot JS 
    <script src="../assets/plugins/flot/jquery.flot.js"></script>
    <script src="../assets/plugins/flot/jquery.flot.fillbetween.js"></script>
    <script src="../assets/plugins/flot/chart.flot.sampledata.js"></script>
    <script src="../assets/plugins/flot/dashboard.sampledata.js"></script>
    -->

    <!-- INTERNAL Vector js 
    <script src="../assets/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="../assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    -->

    <!-- SIDE-MENU JS-->
    <script src="../assets/plugins/sidemenu/sidemenu.js"></script>

	<!-- TypeHead js 
	<script src="../assets/plugins/bootstrap5-typehead/autocomplete.js"></script>
    <script src="../assets/js/typehead.js"></script>
    -->

    <!-- INTERNAL INDEX JS -->
    <script src="../assets/js/index1.js"></script>

    <!-- Color Theme js -->
    <script src="../assets/js/themeColors.js"></script>

    <!-- CUSTOM JS -->
    <script src="../assets/js/custom.js"></script>
    <!-- SHOW PASSWORD JS -->
    <script src="../assets/js/show-password.min.js"></script>
        <!-- SWEET-ALERT JS -->
        <script src="../assets/plugins/sweet-alert/sweetalert.min.js"></script>
    <script src="../assets/js/sweet-alert.js"></script>

        <!-- DATA TABLE JS-->
     <script src="../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="../assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
    <script src="../assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
    <!--<script src="../assets/plugins/datatable/js/buttons.bootstrap5.min.js"></script> 
    <script src="../assets/plugins/datatable/js/jszip.min.js"></script>
    <script src="../assets/plugins/datatable/pdfmake/pdfmake.min.js"></script>
    <script src="../assets/plugins/datatable/pdfmake/vfs_fonts.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.html5.min.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.print.min.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.colVis.min.js"></script> -->
    <script src="../assets/plugins/datatable/dataTables.responsive.min.js"></script>
    <!--<script src="../assets/plugins/datatable/responsive.bootstrap5.min.js"></script> -->
    <script src="../assets/js/table-data.js"></script>


   <script> // Check if email exists
$(document).ready(function () {
    $('.check-email').keyup(function (e) { 
        var email = $('.check-email').val();
        $.ajax({
            type: "POST",
            url: "functions.php",
            data: {
                "check-submitbtn": 1,
                "email_id": email,
            },
            success: function (response){
                $('.error-email').text(response);
            }
        })
    });
});
</script>

<script>
    // JQuery for deleting users
$(document).ready(function () {

        $('body').on('click', '.deletebtn', function () {

        $('#deletemodal').modal('show');
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        console.log(data);

        $('#delete_id').val(data[0]);

    });
});
</script>

<script>
    // JQuery for deleting users
$(document).ready(function () {

        $('body').on('click', '.serverdeletebtn', function () {

        $('#deleteservermodal').modal('show');
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        console.log(data);

        $('#delete_serverid').val(data[0]);

    });
});
</script>

<?php
if (isset($_SESSION['status']) && $_SESSION['status'] != ''){
    ?>
        <script>
        swal({
            title: "<?php echo $_SESSION['status']; ?>",
            //text: "You clicked the button!",
            icon: "<?php echo $_SESSION['status_code']; ?>",
            button: "Aww yiss!",
        });
    </script>
    <?php
    unset($_SESSION['status']);
}
?>