<?php 
$tab1 = " active ";
$page_data = $data_list[0];
$primary_id = $page_data['id'];
$title =  $page_data['title'];
$keyword =  $page_data['keyword'];
$description =  $page_data['description'];
$order =  $page_data['module'];
?>

<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?php include('nav.php'); ?>

        <div class="container">
            <div class="row">
                <!-- <div class="col-md-12">
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
                </div> -->
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Seo</h6>
                </div>
                <div class="card-body">
                    <a class="btn btn-outline-primary btn-sm" href="<?= base_url() ?>cms/seo">Back</a>
                    <form id="add_static_page" action="<?=base_url().'cms/update_seo_action?bid='.$primary_id?>" method="post" role="form" class="mt-3">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Title <span class="text-danger">*</span></label>
                                     <textarea class=" description form-control" rows="5" name="title" dt=""  data-original-title="" title="">                                       <?=$title?>
										</textarea>
                                    </div>
									<input type="hidden" value="<?=$primary_id?>" name="BID">
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Keyword<span class="text-danger">*</span></label>
                                     <textarea class=" description form-control" rows="5" name="keyword" dt=""  data-original-title="" title="">                                      <?=$keyword?>
										</textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Description<span class="text-danger">*</span></label>
                                 <textarea class=" description form-control" rows="5" id="banner_description" name="description" dt=""  data-original-title="" title="">
											<?=$description?>
										</textarea>
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Module<span class="text-danger">*</span></label>
                                        <input type="text" value="<?=$order?>" class="form-control" name="banner_order" id="page_seo_description">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="box-footer">
                            <input type="submit" class="btn btn-outline-primary btn-sm" value="Add" />
                            <input type="reset" class="btn btn-outline-dark btn-sm" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- <style>
        span.error {
            color: red;
            font-size: 1rem;
            display: block;
            margin-top: 5px;
        }
    </style> -->


    <!-- <script>
     
            $('form[id="add_static_page"]').validate({
                rules: {
                    page_title: {
                        required: true,
                        minlength: 15,
                        maxlength: 20
                    },
                    page_seo_title: {
                        required: true,
                        minlength: 15,
                        maxlength: 20
                    },
                    page_position: {
                        required: true,
                    },
                    page_seo_keyword: {
                        required: true,
                        minlength: 15,
                        maxlength: 25
                    },
                    page_seo_description: {
                        required: true,
                        minlength: 40,
                        maxlength: 50
                    },
                    page_description: {
                        required: true,
                    }

                },
                messages: {
                    page_title: {
                        required: "Please enter page title",
                        minlength: "page title should be at least min 15 characters",
                        maxlength: "page title should be at least max 20 characters"
                    },
                    page_seo_title: {
                        required: "Please enter page seo title",
                        minlength: "page seo title should be at least min 15 characters",
                        maxlength: "page seo title should be at least max 20 characters"
                    },
                    page_position: {
                        required: "Please select page postion",
                    },
                    page_seo_keyword: {
                        required: "Please enter page seo keyword",
                        minlength: "page seo keyword should be at least min 15 characters",
                        maxlength: "page seo keyword should be at least max 25 characters"
                    },
                    page_seo_description: {
                        required: "Please enter page seo description",
                        minlength: "page seo description should be at least min 40 characters",
                        maxlength: "page seo description should be at least max 50 characters"
                    },
                    page_description: {
                        required: "Please enter page description",
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
    </script> -->


<!-- <script type="text/javascript">
    $(document).ready(function () {
    alert('hi')
});
</script> -->