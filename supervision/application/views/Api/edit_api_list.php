<style>
    .error {
        color: red;
        font-size: 10px;
    }

    .image_error {
        color: red;
        font-size: 10px;
    }
</style>

<?php

$origin = $edit_api_data->origin;
$first_name = $edit_api_data->first_name;
$last_name = $edit_api_data->last_name;
$image_url = $edit_api_data->image_url;
$phone_code = $edit_api_data->phone_code;
$information = $edit_api_data->information;
$location = $edit_api_data->location;
$qualification = $edit_api_data->qualification;
$experience = $edit_api_data->experience;
$category_id = $edit_api_data->category_id;
$sub_category_id = $edit_api_data->sub_category_id;
$phone = $edit_api_data->phone;
$name = $edit_api_data->name;
$email = $edit_api_data->email;
$title = $edit_api_data->title;

?>

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

                    <!-- <div class="row">
                        <div class="col-md-8 mx-auto">
                            <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="card shadow mb-4 col-md-10 mx-auto">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><a class="" href="<?= base_url() ?>api_list"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a> Edit Data</h6>
                </div>
                <div class="card-body">
                    <form role="form" action="<?php echo base_url() ?>api_list/edit_api_list/<?= $origin ?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputPassword1">Category<span class="text-danger">*</span> </label>
                                        <select class="form-control" disabled>
                                            <option value="" selected="selected">select category </option>
                                            <?php foreach ($category_list as $key => $category) { ?>
                                                <?php if ($category['status'] == '1') { ?>
                                                    <option value="<?= $category['origin'] ?>" <?php if ($category['origin'] == $category_id) {
                                                                                                    echo "selected=selected";
                                                                                                } ?>>
                                                        <?= $category['profession_name'] ?>
                                                    </option>
                                            <?php }
                                            } ?>
                                        </select>
                                        <span class="error"><?php echo form_error('category_id'); ?></span>
                                        <input type="hidden" name="" value="<?= $origin ?>" id="">
                                    </div>

                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputPassword1">Sub Category<span class="text-danger">*</span> </label>
                                        <select class="form-control" disabled>
                                            <?php foreach ($sub_category_list as $key => $sub_category) { ?>
                                                <?php if ($sub_category['status'] == '1') { ?>
                                                    <option value="<?= $sub_category['origin'] ?>" <?php if ($sub_category['origin'] == $sub_category_id) {
                                                                                                        echo "selected=selected";
                                                                                                    } ?>> <?= $sub_category['sub_category_name'] ?>
                                                    </option>
                                            <?php }
                                            } ?>
                                        </select>
                                        <span class="error"><?php echo form_error('sub_category_id'); ?></span>
                                    </div>

                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputPassword1">Name<span class="text-danger">*</span> </label>
                                        <input type="text" value="<?php echo $name ?>" name="name" id="name" class="form-control" placeholder="Enter last name...">
                                        <span class="error"><?php echo form_error('name'); ?></span>
                                    </div>

                                </div>

                            </div>

                            <!--<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputPassword1">Name <span class="text-danger">*</span> </label>
                                        <input type="text" value="<?php echo $name ?>" name="name" id="name" class="form-control" placeholder="Enter last name...">
                                    </div>
                                    <span class="error"><?php echo form_error('name'); ?></span>
                                </div>
                            </div>-->

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputPassword1">Email<span class="text-danger">*</span> </label>
                                        <input type="text" value="<?php echo $email ?>" name="email" id="email" class="form-control" placeholder="Enter first email...">
                                        <span class="error"><?php echo form_error('email'); ?></span>
                                    </div>

                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputPassword1">Qualification</label>
                                        <input type="text" value="<?php echo $qualification ?>" name="qualification" id="qualification" class="form-control" placeholder="Enter  Qualification...">
                                    </div>

                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputPassword1">Total Experience</label>
                                        <input type="tel" value="<?php echo $experience ?>" name="experience" id="experience" class="form-control" placeholder="Enter  Experience...">
                                    </div>

                                </div>
                            </div>

                            <div class="row">

                                <!-- <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="inputPassword1">Phone code <span class="text-danger">*</span> </label>
                                        <select class="form-control" name="phone_code" id="phone_code">
                                            <option value="" selected="selected">select code</option>
                                            <?php foreach ($phone_code_list as $key => $code_list) { ?>
                                                <option value="<?= $code_list['phonecode'] ?>"><?= $code_list['phonecode'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="error"><?php echo form_error('phone_code'); ?></span>
                                    </div>
                                </div>-->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputPassword1">Phone<span class="text-danger">*</span> </label>
                                        <input type="text" value="<?php echo $phone ?>" name="phone" id="phoneNumber" class="form-control" placeholder="Enter last number...">
                                        <span class="error"><?php echo form_error('phone'); ?></span>
                                    </div>

                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputPassword1">Location<span class="text-danger">*</span> </label>
                                        <input type="text" name="location" value="<?php echo $location ?>" id="location" class="form-control" placeholder="Enter first location...">
                                        <span class="error"><?php echo form_error('location'); ?></span>
                                    </div>

                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputPassword1">Image<span class="text-danger">*</span></label>
                                        <input type="file" name='image_url' id="image_url" class="form-control image_url">
                                        <input type="hidden" name="image_urlss" value="<?php echo $image_url ?>">
                                        <img width="40px" src="<?= base_url(); ?>assets/img/api_images/<?= $image_url ?>" alt="Banner Image">
                                        <span class="image_error"></span>
                                    </div>
                                </div>
                            </div>

                            <!--  <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputPassword1">Location <span class="text-danger">*</span> </label>
                                        <input type="text" name="location" value="<?php echo $location ?>" id="location" class="form-control" placeholder="Enter first location...">
                                    </div>
                                    <span class="error"><?php echo form_error('location'); ?></span>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputPassword1">Image</label>
                                        <input type="file" name='image_url' id="image_url" class="form-control">
                                        <input type="hidden" name="image_urlss" value="<?php echo $image_url ?>">
                                        <img width="40px" src="<?= base_url(); ?>assets/img/api_images/<?= $image_url ?>" alt="Banner Image">
                                    </div>
                                </div>
                            </div>-->

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputPassword1">Information<span class="text-danger">*</span> </label>
                                    <textarea class="form-control" id="information" name="information">
										 <?php echo $information ?>
										</textarea>
                                    <span class="error"><?php echo form_error('information'); ?></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="box-footer">
                                    <input type="submit" class="btn btn-primary btn-sm submits" value="Edit Data" />
                                    <input type="reset" class="btn btn-dark btn-sm" value="Reset" />
                                </div>
                            </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        $('.submits').click(function() {
            var ext = $('.image_url').val().split('.').pop().toLowerCase();
            var file_size = $('.image_url')[0].files[0].size;

            if (ext !== 'jpg' && ext !== 'png' && ext !== 'jpeg' && ext !== 'gif') {
                $('.image_error').html('Please select the image files only gif|jpg|png|jpeg');
                //alert('Please select the image files only (gif|jpg|png|jpeg)');
                return false;
            }

            if (file_size > 1097152) {
                $(".image_error").html("File size is greater than 1MB");
                return false;
            } else {
                return true;
            }

        });
    </script>



    <script>
        $(document).ready(function() {
            $('#phoneNumber').on('input', function() {
                let value = $(this).val();
                // Ensure the number doesn't exceed 10 digits
                if (value.length > 10) {
                    $(this).val(value.slice(0, 10));
                }
            });

            $('#phoneNumber').on('keydown', function(event) {
                // Prevent entering non-numeric characters and limit to 10 digits
                if ((event.key.length === 1 && !/\d/.test(event.key)) || (this.value.length >= 10 && event.key !== 'Backspace' && event.key !== 'Delete')) {
                    event.preventDefault();
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#experience').on('input', function() {
                let value = $(this).val();
                // Ensure the number doesn't exceed 2 digits
                if (value.length > 2) {
                    $(this).val(value.slice(0, 2));
                }
            });

            $('#experience').on('keydown', function(event) {
                // Prevent entering non-numeric characters and limit to 2 digits
                if ((event.key.length === 1 && !/\d/.test(event.key)) || (this.value.length >= 2 && event.key !== 'Backspace' && event.key !== 'Delete')) {
                    event.preventDefault();
                }
            });
        });
    </script>