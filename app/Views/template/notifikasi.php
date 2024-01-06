<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if (session('success')) { ?>
    <script>
        Swal.fire({
            icon: "success",
            title: "<?= session('success') ?>",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
<?php } ?>

<?php if (session('warning')) { ?>
    <script>
        Swal.fire({
            icon: "warning",
            title: "<?= session('warning') ?>",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
<?php } ?>

<?php if (session('danger')) { ?>
    <script>
        Swal.fire({
            icon: "error",
            title: "<?= session('danger') ?>",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
<?php } ?>