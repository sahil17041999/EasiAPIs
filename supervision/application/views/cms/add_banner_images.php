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

        <div class="container">
            <div class="row">
                <div class="col-md-12">
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

                    <!--  <div class="row">
                        <div class="col-md-12">
                            <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                        </div>
                    </div>-->
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add Banners</h6>
                </div>
                <div class="card-body">
                    <a class="btn btn-outline-primary btn-sm" href="<?= base_url() ?>cms/banner_images">Back</a>
                    <form id="add_static_page" action="<?php echo base_url() ?>cms/add_banner_images" method="post" role="form" class="mt-3" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">

                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="" name="title" id="title" placeholder='Enter title..'>
                                        <input type="hidden" class="form-control" value="0" name="status" id="status">
                                        <span class="error"><?php echo form_error('title'); ?></span>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Subtitle<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="subtitle" id="subtitle" placeholder='Enter subtitle..'>
                                        <span class="error"><?php echo form_error('subtitle'); ?></span>
                                    </div>

                                </div>

                            </div>


                            <div class="row">
                                

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">banner order<span class="text-danger">*</span></label>
                                        <select name="banner_order" id="banner_order" class="form-control">
                                            <option value="" selected="selected">select banner order</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                        </select>
                                        <span class="error"><?php echo form_error('banner_order'); ?></span>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <label for="">image<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control banner_image" name="banner_image" id="banner_image">
                                    <span class="image_error text-danger"></span>
                                    
                                </div>



                            </div>


                        </div>
                        <div class="box-footer">
                            <input type="submit" class="btn btn-outline-primary btn-sm submits" value="Add" />
                            <input type="reset" class="btn btn-outline-dark btn-sm" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>-->
    <script src=" <?= base_url('assets/vendor/jquery/jquery.min.js');?>"></script>

    <script>
        $('.submits').click(function() {
            var ext = $('.banner_image').val().split('.').pop().toLowerCase();
            var file_size = $('.banner_image')[0].files[0].size;

            if (ext !== 'jpg' && ext !== 'png' && ext !== 'jpeg' && ext !== 'gif') {
                $('.image_error').html('Please select the image files only gif|jpg|png|jpeg');
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

