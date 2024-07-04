<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?php include('nav.php'); ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <?php
                    $this->load->helper('form');
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

                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Manage Social Links</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <tr>
                                <th>Social</th>
                                <th>Url</th>
                                <th>Action</th>
                                <th>Status</th>

                            </tr>
                            <?php
                            if (!empty($social_links)) {
                                foreach ($social_links as $key => $social_link) {

                            ?>
                                    <tr>
                                        <td><?php echo $social_link['social'] ?></td>
                                        <form action='<?= base_url() ?>cms/edit_social_url' id="update_social_login" method="POST">
                                            <td>
                                                <input type="text" autocomplete="off" name="social_url" id="social_url" class="form-control" value="<?php echo $social_link['url_link'] ?>" />
                                            </td>
                                            <input type="hidden" name="origin" id="origin" value="<?php echo $social_link['origin'] ?>" />
                                            <td><input class="updateButton btn btn-outline-primary btn-sm" type="submit" name="submit" value="Update"></td>
                                        </form>
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" data="<?php echo $social_link['origin']; ?>" class="status-switch" id="customSwitch1" <?= $social_link['status'] == 1 ? 'checked' : ''; ?>>
                                                <span class="slider round"></span>
                                                <span style="display:none"><?php echo $social_link['status']; ?></span>
                                            </label>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }

                            ?>
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
        url = "<?php echo base_url() . 'cms/social_link_status' ?>/" + origin;
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