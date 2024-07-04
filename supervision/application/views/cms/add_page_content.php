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
                    <h6 class="m-0 font-weight-bold text-primary">Add Static page content</h6>
                </div>
                <div class="card-body">
                    <a class="btn btn-outline-primary btn-sm" href="<?= base_url() ?>cms/static_page_content">Back</a>
                    <form id="add_static_page" action="<?php echo base_url() ?>cms/add_page_content" method="post" role="form" class="mt-3">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Page Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="" name="page_title" id="page_title">
                                        <span></span>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Page SEO Title<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="page_seo_title" id="page_seo_title">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Page Position<span class="text-danger">*</span></label>
                                        <select name="page_position" id="page_position" class="form-control">
                                            <option value="">Select page Position</option>
                                            <option value="Top">Top</option>
                                            <option value="Bottom">Bottom</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="">Page SEO Keyword <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="page_seo_keyword" id="page_seo_keyword">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Page SEO Description <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="page_seo_description" id="page_seo_description">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Page Description<span class="text-danger">*</span></label>
                                        <textarea rows="10" cols="80" class="ckeditor" id="editor" name="page_description" id="page_description">
                                        </textarea>
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