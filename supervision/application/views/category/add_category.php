
<style>
    .error {
        color: red;
        font-size: 12px;
        margin-top: 20px;
    }

    .image_error {
        font-size: 12px;
    }
</style>
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?php include('nav.php'); ?>

        <div class="container-fluid">
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
            <div class="card shadow mb-4 col-md-8 mx-auto">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><a class="" href="<?= base_url() ?>category"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a> Add Category</h6>
                    
                </div>
                <div class="card-body">
                    <form role="form" action="<?php echo base_url() ?>category/add_category" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputPassword1">Category<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="profession_name" name="profession_name" maxlength="30" placeholder="Enter Category...">
                                        <input type="hidden" name="status" value="0">
                                        <span class="error"><?php echo form_error('profession_name'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputPassword1">Category Image<span class="text-danger">*</span></label>
                                        <input type="file" class="form-control banner_image" id="service_icon" name="service_icon">
                                        <span class="image_error text-danger"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary btn-sm submits" value="Add Data" />
                            <input type="reset" class="btn btn-dark btn-sm" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>


    <script src=" <?= base_url('assets/vendor/jquery/jquery.min.js');?>"></script>

<script>
    $('.submits').click(function() {
        var ext = $('.banner_image').val().split('.').pop().toLowerCase();
        var file_size = $('.banner_image')[0].files[0].size;

        if (ext !== 'png') {
            $('.image_error').html('Please select the image files only png');
            //alert('Please select the image files only (gif|jpg|png|jpeg)');
            return false;
        }

        if(file_size>1097152) {
            $(".image_error").html("File size is greater than 1MB");
            return false;} 
        else{
            return true;
        }
        
    });
</script>