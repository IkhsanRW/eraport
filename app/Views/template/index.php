<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>E-Raport | <?= $title ?></title>

    <link rel="shortcut icon" href="<?= base_url('assets/img/bg_login.jpg') ?>" type="image/x-icon">

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="<?= base_url('') ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script>

    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        if (session('log_auth')['accountRole'] == '1') {
            echo $this->include('template/sidebar');
        } elseif (session('log_auth')['accountRole'] == '2') {
            echo $this->include('template/sidebar_guru');
        } elseif (session('log_auth')['accountRole'] == '3') {
            echo $this->include('template/sidebar_siswa');
        }
        ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?= $this->include('template/navbar') ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <?= $this->renderSection('content') ?>

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Sistem E-Raport SMK Muhammadiyah Seyegan</span>
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

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url() ?>assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script src="<?= base_url('') ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('') ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script>
        // Format datepicker
        $(document).ready(function() {
            document.querySelectorAll('.eraport-date').forEach(e => {
                $(e).datepicker();
                $(e).datepicker("option", "dateFormat", "dd MM yy");
            });
            try {
                if (isEditPage) {
                    setDateValueformDB();
                }
            } catch (error) {

            }
        })
        // End Datepicker

        // DataTables
        $(document).ready(function() {
            $('#example1').DataTable({
                pageLength: 10,
                lengthMenu: [10, 20, 50]
            });
            $('#example2').DataTable({
                pageLength: 10,
                lengthMenu: [10, 20, 50],
                bFilter: false,
                bPaginate: false,
                bInfo: false,
            });
        });

        // preview img
        function bacaGambar(input) {
            try {
                $('#gambar_load').attr('src', URL.createObjectURL(input.target.files[0]));
                tampilPreview();
            } catch (error) {

            }
        }

        function editGambar(input, target) {
            try {
                $(target).attr('src', URL.createObjectURL(input.target.files[0]));
            } catch (error) {

            }
        }

        $('#foto').change(function() {
            bacaGambar(this);
        });
        //end preview img

        // tampil password pada txt
        function togglePw() {
            var x = document.getElementById("inputPw");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
        // end
    </script>

    <?= $this->include('template/notifikasi'); ?>

</body>

</html>