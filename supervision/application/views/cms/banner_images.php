<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?php include('nav.php'); ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <?php
                    $success = $this->session->flashdata('success');
                    if ($success) {
                    ?>
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php } ?>

                    <?php
                    $error = $this->session->flashdata('error');
                    if ($error) {
                    ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Banners</h6>
                </div>
                <div class="card-body">
                    <a class="btn btn-outline-primary btn-sm" href="<?= base_url() ?>cms/add_banner_images"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>subtitle</th>
							
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (!empty($banner_image_data)) {
                               
                                foreach ($banner_image_data as $key => $banner_image) {

                            ?>
                                    <tr>
                                        <td><?php echo $key+1; ?></td>
                                        <td><?php echo $banner_image['title']; ?></td>
                                        <td><?php echo $banner_image['subtitle']; ?></td>
                                       
                                        <td>
					<img width="95px" src="<?= base_url(); ?>assets/img/banner_image/<?=$banner_image['banner_image']?>" alt="Banner Image">
										</td>

                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" data="<?php echo $banner_image['origin']; ?>" class="status-switch" id="customSwitch1" <?= $banner_image['status'] == 1 ? 'checked' : ''; ?>>
                                                <span class="slider round"></span>
                                                <span style="display:none"><?php echo $banner_image['status']; ?></span>
                                            </label>
                                        </td>


                                        <td>

                                            <a href="<?= base_url() ?>cms/edit_info_banner_images/<?php echo $banner_image['origin']; ?>" class="btn btn-outline-primary btn-sm">Edit</a>
                                            <a onclick="return confirm('Are you sure want to delete banner image ');" href="<?= base_url() ?>cms/delete_banner_image/<?php echo $banner_image['origin']; ?>" class="btn btn-outline-danger btn-sm">Delete</a>

                                        </td>
                                    </tr>
                            <?php
                                }
                            }

                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	
<script>
		$(document).ready(function() {
    $('.status-switch').change(function() {
        var current_element = $(this);
        var origin = $(current_element).attr('data');
        var status = $(this).is(':checked') ? 1 : 0;
        url = "<?php echo base_url() . 'cms/banner_image_status' ?>/" + origin;
        $.ajax({
            url:url ,
            type: 'POST',
            data: {
                origin: origin,
                status: status
            },
            success: function(response) {
				location.reload();
               // alert('Status updated successfully');
				
            },
            error: function(response) {
                alert('Failed to update status');
            }
			
        });
		
    });
});
</script>