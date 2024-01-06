<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <link rel="shortcut icon" href="<?= base_url() ?>/assets/img/undraw_rocket.svg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row vh-100 align-items-center justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-dark" style="background:url('<?= base_url('assets/img/bg_login.jpg') ?>') no-repeat; background-size: cover; background-position: center; ">
                                <button class="btn carousel-caption p-3" style="backdrop-filter: blur(5px) brightness(0.7); border-radius: 10px;">
                                    <div class="text-white fw-bold" onclick="parent.open('https://smkmuhammadiyahseyegan.sch.id/');">SMK Muhammadiyah Seyegan</div>
                                </button>
                            </div>
                            <div class=" col-lg-6">
                                <div class="p-5">
                                    <div class="mb-4 d-lg-block">
                                        <div class="h4 text-gray-800 fw-bold">Selamat Datang</div>
                                        <div class="text-gray-900" style="font-size: 0.7rem;">Ketikan Username & Password Anda dengan benar.</div>
                                    </div>
                                    <?php if (session('danger')) : ?>
                                        <div class="alert alert-danger alert-dismissible fade show d-flex" style="font-size: 0.7rem;" role="alert">
                                            <i class="fa-solid fa-triangle-exclamation fa-sm my-auto"></i>
                                            &ensp;<?= session('danger') ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="height: auto;"></button>
                                        </div>
                                    <?php endif ?>
                                    <form action="<?= base_url('auth/login') ?>" method="post" class="user">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control border-secondary px-3 py-4" name="txtUsername" placeholder="Username" />
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control border-secondary px-3 py-4" name="txtPassword" placeholder="Password" id="inputPw" />
                                            <button class="btn btn-outline-secondary" type="button"><i class="fas fa-eye" onclick="togglePw()"></i></button>
                                        </div>
                                        <button type="submit" class="fs-6 btn btn-primary btn-user btn-block rounded">Login</button>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url() ?>assets/js/sb-admin-2.min.js"></script>

    <script>
        function togglePw() {
            var x = document.getElementById("inputPw");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

</body>

</html>