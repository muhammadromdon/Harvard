<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Harvard University <?php echo date('Y') ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

</body>

</html>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url() ?>plugins/sbadmin2/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>plugins/sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url() ?>plugins/sbadmin2/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url() ?>plugins/sbadmin2/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?php echo base_url() ?>plugins/sbadmin2/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?php echo base_url() ?>plugins/sbadmin2/js/demo/chart-area-demo.js"></script>
<script src="<?php echo base_url() ?>plugins/sbadmin2/js/demo/chart-pie-demo.js"></script>

<!-- Datatables -->
<script src="<?php echo base_url() ?>plugins/datatables/Here/js/jquery.dataTables.js ?>"></script>
<script src="<?php echo base_url() ?>plugins/datatables/Here/js/dataTables.bootstrap4.js ?>"></script>

<!-- Sweetalert2 -->
<script src="<?php echo base_url() ?>plugins/sweetalert2/sweetalert2.all.min.js"></script>

<!-- Jquery untuk tambah/delete access di menu role -->
<script>
    $('.form-check-input').on('click', function() {
        const menuid = $(this).data('menu')
        const roleid = $(this).data('role')

        $.ajax({
            type: "post",
            url: "<?php echo base_url('Admin/Changeaccess') ?>",
            data: {
                menuid: menuid,
                roleid: roleid
            },
            success: function() {
                document.location.href = "<?php echo base_url('Admin/Roleaccess/') ?>" + roleid
            }
        })
    })
</script>

<!-- Jquery untuk menampilkan nama input file upload foto -->
<script>
    $('.custom-file-input').on('change', function() {
        let filename = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(filename);
    });
</script>

<!-- Datatables untuk master data -->
<script>
    $('.tabeldata').DataTable({
        "ordering": false
    })
</script>

<!-- Datatables untuk menu setting -->
<script>
    $('.tablemenu').DataTable({
        "ordering": false,
        "paging": false,
        "searching": true
    })
</script>

<!-- Sweetalert untuk insert update datamaster -->
<script>
    const flashdata = $('.flashdata').data('flashdata')

    if (flashdata) {
        Swal.fire({
            title: 'Your data',
            type: 'success',
            text: 'has been successfully ' + flashdata
        })
    }
</script>

<!-- Hapus master data sweetalert -->
<script>
    $('.tombolhapus').on('click', function(e) {
        e.preventDefault()

        const href = $(this).attr('href')

        Swal.fire({
            title: 'Are you sure',
            text: 'want to delete this data?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085D6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                document.location.href = href
            }
        })
    })
</script>