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
                    <h6 class="m-0 font-weight-bold text-primary">Upload Multiple Images</h6>
                </div>
                <div class="card-body">
                    <a class="btn btn-outline-primary btn-sm mb-3" href="<?= base_url() ?>api_list">back</a>
                    <form role="form" action="<?php echo base_url() ?>api_list/uplaod_multiple_images/<?=$origin?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
							
							<div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputPassword1">Upload Images</label>
							           <input type="file" name="image[]" id="image" class="form-control" multiple="">
									   <input type="hidden" name="api_list_id" value="<?php echo $origin ?>">
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

	