<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <meta name="keywords" content="<?= META_KEYWORDS ?>">
    <meta name="description" content="<?= META_DESCRIPTION ?>">
    
    <title><?php echo 'Welcome'. ' '.HEADER_TITLE_SUFFIX; ?></title>

    <!-- Custom fonts for this template-->
    <!-- <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.csss'); ?>" rel="stylesheet" type="text/css">-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">

</head>



<body class="">

    <div class="container">
        <?php
        //echo  base_url();
        ?>
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-5 col-md-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!--<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>-->
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
										<img width="230px" src="<?= base_url(); ?>assets/img/logo/EasiApis.png" alt="Banner Image">
                                        <h1 class="h4 text-gray-900 mb-4 mt-2">Welcome Back <span class="text-primary">EasiAPIs</span></h1>

                                        <?php
                                        
                                        $error = $this->session->flashdata('error');
                                        if ($error) {
                                        ?>
                                            <div class="alert alert-danger alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <?php echo $error; ?>
                                            </div>
                                        <?php }
                                        $success = $this->session->flashdata('success');
                                        if ($success) {
                                        ?>
                                            <div class="alert alert-success alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <?php echo $success; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <form class="user" action="<?php echo base_url(); ?>general/login" method="post">

                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user" id="" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input name="password" type="password" class="form-control form-control-user" id="" placeholder="Password">
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?php echo base_url(); ?>general/forgot_password">Forgot Password ?</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

    <!-- Custom scripts for all pages-->
    <!--<script src="<?= base_url('assets/js/sb-admin-2.min.js'); ?>" ></script>-->

</body>

</html>