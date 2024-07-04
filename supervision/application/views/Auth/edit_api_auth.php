<style>
    .error {
        color: red;
        font-size: 12px;
    }

    .col-md-12.mb-2 label.form-check-label {
        vertical-align: middle;
        margin-top: -8px;
    }
</style>

<?php

$domin_name = $update_auth_data[0]->domain;
$user_id   = $update_auth_data[0]->id;
$username   = $update_auth_data[0]->username;
$password   = $update_auth_data[0]->password;
$moudels = explode(',', $update_auth_data[0]->modules);
//$user_id = $update_auth_data[0]->user_id;


?>

<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?php include('nav.php'); ?>

        <div class="container">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <?php
                    $error = $this->session->flashdata('error');
                    if ($error) {
                    ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php } ?>
                    <?php
                    $success = $this->session->flashdata('success');
                    if ($success) {
                    ?>
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php } ?>

                    <!--<div class="row">
                        <div class="col-md-8 mx-auto">
                            <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                        </div>
                    </div>-->
                </div>
            </div>
            <div class="card shadow mb-4 col-md-10 mx-auto">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Api Authentication</h6>

                </div>
                <div class="card-body">
                    <a class="btn btn-outline-primary btn-sm mb-3" href="<?= base_url() ?>user/auth">back</a>
                    <form role="form" action="<?php echo base_url() ?>user/edit_auth/<?php echo $user_id ?>" method="post">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputPassword1">Domain Name <span class="text-danger">*</span> </label>
                                        <input type="text" value="<?= $domin_name ?>" class="form-control" id="domain" name="domain" placeholder="Enter Domain Name.. ">
                                        <!-- <input type="hidden" name="status" value="0"> -->
                                        <span class="error"><?php echo form_error('domain'); ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputPassword1">Username <span class="text-danger">*</span> </label>
                                        <input type="text" disabled value="<?= $username ?>" maxlength="8" class="form-control" id="username" name="username" placeholder="Enter Username.. ">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputPassword1">Password <span class="text-danger">*</span></label>
                                        <input type="text" value="<?= $password ?>" maxlength="8" class="form-control" id="password" name="password" placeholder="Enter Password.. ">
                                        <span class="error"><?php echo form_error('password'); ?></span>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <div class="form-check">
                                        <?php foreach ($modules_data as $key => $modules_list) {
                                            if ($modules_list['status'] == '1') {
                                        ?>
                                                <input class="form-check-input" type="checkbox" value="<?= $modules_list['origin'] ?>" name="modules[]" <?php echo (in_array($modules_list['origin'], $moudels) == 1) ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="flexCheckDefault" style="display: inline-block; margin-right: 25px;">
                                                    <?php echo $modules_list['profession_name']; ?>
                                                </label>
                                        <?php }
                                        } ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <input type="submit" class="btn btn-outline-primary btn-sm" value="Edit" />
                            <input type="reset" class="btn btn-outline-dark btn-sm" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>