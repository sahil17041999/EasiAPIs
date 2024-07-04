<style>
    .error {
        color: red;
        font-size: 12px;
    }
</style>

<?php
//print_r($information);die;
$information =   $information->information;
//$origin = $edit_api_data->origin;
//$image_url = $edit_api_data->image_url;


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

                    <!-- <div class="row">
                        <div class="col-md-8 mx-auto">
                            <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="card shadow mb-4 col-md-12 mx-auto">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><a class="" href="<?= base_url() ?>api_list"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a> View Information </h6>
                </div>
                <div class="card-body">
                    <!-- <a class="btn btn-outline-primary btn-sm mb-3" href="<?= base_url() ?>api_list">Back</a> -->
                    <p><?php echo $information ?></p>
                </div>
            </div>

        </div>
    </div>