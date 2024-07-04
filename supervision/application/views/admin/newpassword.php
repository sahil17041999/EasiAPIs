<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <!-- <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.csss'); ?>" rel="stylesheet" type="text/css">-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">

</head>

<body>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">chage password</h1>
                                        <p class="mb-4"></p>
                                    </div>
                                    <?php
                                
                                    $error = $this->session->flashdata('error');
                                
                                     if ($error) {?>
                                    ?>
                                        <div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <?php echo $this->session->flashdata('error'); ?>
                                        </div>
                                    <?php }?>
                                    <form class="user" action="<?php echo base_url(); ?>general/createPasswordUser" method="post">
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $email; ?>" readonly required />
                                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                            <input type="hidden" name="activation_code" value="<?php echo $activation_code; ?>" required />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Password" name="password" required />
                                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Confirm Password" name="cpassword" required />
                                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="   Reset Password" />
                                    </form>
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