<style>
    .error {
        color: red;
        font-size: 10px;
    }

    .box-body .form-control:focus {
        box-shadow: none;
    }

    textarea .form-control:focus {
        box-shadow: none;
    }

    .image_error {
        color: red;
        font-size: 10px;
    }

    span.select2-selection__rendered {
        display: block;
        width: 100%;
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        border: 1px solid #ced4da;
        height: 38px;
        border-radius: 3px;
    }

    span.select2-selection.select2-selection--single {
        border: none;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 7px;
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

                    <!-- <div class="row">
                        <div class="col-md-8 mx-auto">
                            <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="card shadow mb-4 col-md-10 mx-auto">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> <a class="" href="<?= base_url() ?>api_list"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a> Add Data</h6>

                </div>
                <div class="card-body">

                    <form role="form" action="<?php echo base_url() ?>api_list/add_api_list" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputPassword1">Category<span class="text-danger">*</span></label>
                                        <select class="form-control js-example-basic-multiple" name="category_id" id="category_id">
                                            <option value="" selected="selected">select category</option>
                                            <?php foreach ($category_list as $key => $category) { ?>
                                                <?php if ($category['status'] == '1') { ?>
                                                    <option value="<?= $category['origin'] ?>"><?= $category['profession_name'] ?></option>
                                            <?php }
                                            } ?>
                                        </select>

                                    </div>
                                    <span class="error"><?php echo form_error('category_id'); ?></span>

                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputPassword1">Sub Category<span class="text-danger">*</span> </label>
                                        <select class="form-control js-example-basic-multiple" name="sub_category_id" id="sub_category_id"></select>

                                    </div>
                                    <span class="error"><?php echo form_error('sub_category_id'); ?></span>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputPassword1">Name<span class="text-danger">*</span> </label>
                                        <input type="text" name="name" id="name" class="form-control">
                                        <span class="error"><?php echo form_error('name'); ?></span>
                                    </div>

                                </div>
                            </div>

                            <!--<div class="row">
								
								
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputPassword1">Name <span class="text-danger">*</span>  </label>
							              <input type="text"  name="name" id="name" class="form-control" placeholder="Enter name...">
                                    </div>
									<span class="error"><?php echo form_error('name'); ?></span>
                                </div>
								
								
                            </div>-->

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputPassword1">Email<span class="text-danger">*</span> </label>
                                        <input type="text" name="email" id="email" class="form-control">
                                        <span class="error"><?php echo form_error('email'); ?></span>
                                    </div>

                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputPassword1">Qualification</label>
                                        <input type="text" name="qualification" id="qualification" class="form-control">
                                        <span class="error"><?php echo form_error('qualification'); ?></span>
                                    </div>

                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputPassword1">Total Experience</label>
                                        <input type="tel" name="experience" id="experience" class="form-control">
                                        <span class="error"><?php echo form_error('experience'); ?></span>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputPassword1">Email <span class="text-danger">*</span>  </label>
							<input type="email"  name="email" id="email" class="form-control" placeholder="Enter first email...">
                                    </div>
									<span class="error"><?php echo form_error('email'); ?></span>
                                </div>-->


                                <!--<div class="col-md-1">
                                    <div class="form-group">
										<label for="inputPassword1">code<span class="text-danger">*</span>  </label>
										<select class="form-control" name="phone_code" id="phone_code">
										  <option value="" selected="selected">select code</option>
                                            <?php foreach ($phone_code_list as $key => $code_list) { ?>
                                              <option value="<?= $code_list['phonecode'] ?>"
													  ><?= $code_list['phonecode'] ?></option>
                                            <?php } ?>
                                        </select>
										<span class="error"><?php echo form_error('phone_code'); ?></span>
									</div>
                                </div>-->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputPassword1">Phone<span class="text-danger">*</span> </label>
                                        <input type="number" name="phone" id="phoneNumber" class="form-control">
                                        <span class="error"><?php echo form_error('phone'); ?></span>
                                    </div>

                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputPassword1">Location<span class="text-danger">*</span> </label>
                                        <input type="text" name="location" id="location" class="form-control">
                                        <span class="error"><?php echo form_error('location'); ?></span>
                                    </div>

                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputPassword1">Image<span class="text-danger">*</span> </label>
                                        <input type="file" name='image_url' id="image_url" class="form-control image_url">
                                        <span class="image_error"></span>
                                    </div>
                                </div>
                            </div>

                            <!--<div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputPassword1">Location <span class="text-danger">*</span>  </label>
							<input type="text"  name="location" id="location" class="form-control" placeholder="Enter first location...">
                                    </div>
									<span class="error"><?php echo form_error('location'); ?></span>
                                </div>
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputPassword1">Image <span class="text-danger">*</span>  </label>
						                 <input type="file"  name='image_url' id="image_url" class="form-control">
                                    </div>
                                </div>
                            </div>-->

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputPassword1">Information<span class="text-danger">*</span> </label>
                                    <textarea class="form-control" id="information" name="information"></textarea>
                                    <span class="error"><?php echo form_error('information'); ?></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="box-footer">
                                    <input type="submit" class="btn btn-primary btn-sm submits" value="Add Data" />
                                    <input type="reset" class="btn btn-dark btn-sm" value="Reset" />
                                </div>
                            </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>

    <script>
        $('#category_id').on('change', function() {
            var category_id = $('#category_id').val();
            url = "<?php echo base_url() . 'ajax/get_sub_category_list' ?>";
            if (category_id == '') {
                $("#sub_category_id").empty().html('<option value = "" selected="">Select Sub category</option>');
                return false;
            }
            $.post(url, {
                category_id: category_id
            }, function(data) {
                $("#sub_category_id").empty().html(data);
                $('#sub_category_id').val()
            });
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