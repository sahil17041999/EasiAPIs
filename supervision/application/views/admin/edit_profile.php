<?php
$name = $userInfo->name;
$email = $userInfo->email;
$address = $userInfo->address;
$userId = $userInfo->userId;
$image  = $userInfo->image;
?>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?php include('includes/nav.php'); ?>

        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
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

                    <div class="row">
                        <div class="col-md-12">
                            <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4 col-md-8 mx-auto">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Update Profile</h6>
                </div>
                <div class="card-body">
                    <form role="form" action="<?php echo base_url() ?>user/profile_Update" method="post">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputPassword1"> name</label>
                                        <input type="text" class="form-control" id="name" value="<?= $name ?>" name="name" maxlength="30" required>
                                        <input type="hidden" name="userId" value="<?= $userId ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputPassword1">Username</label>
                                        <input type="email" class="form-control" readonly="email" value="<?= $email ?>" name="email" maxlength="30" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputPassword1">Address</label>
                                        <input type="text" class="form-control" id="address" value="<?= $address ?>" name="address" required>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="submit" class="btn btn-outline-primary btn-sm" value="Update" />
                            <input type="reset" class="btn btn-outline-dark btn-sm" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>