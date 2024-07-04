<style>
    .error {
        color: red;
        font-size: 12px;
    }
</style>

<?php 

    $origin = $edit_api_data->origin;
    $image_url = $edit_api_data->image_url;
    

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
            <div class="card shadow mb-4 col-md-6 mx-auto">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit image data</h6>
                </div>
                <div class="card-body">
                    <a class="btn btn-outline-primary btn-sm mb-3" href="<?= base_url() ?>api_list">back</a>
                    <form role="form" action="<?php echo base_url() ?>api_list/edit_image/<?=$origin?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
							
							<div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="inputPassword1">Image</label>
							<input type="file" name="image_url" id="image_url" class="form-control" placeholder="Enter first name...">
									</div>
									<img width="100px" src="<?= base_url(); ?>assets/img/api_images/<?php echo $image_url?>" alt="Banner Image">
                                </div>

                            </div>
							
							
                        <div class="box-footer">
                            <input type="submit" class="btn btn-outline-primary btn-sm mt-3" value="Edit Image" />
                            <input type="reset" class="btn btn-outline-dark btn-sm mt-3" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

	