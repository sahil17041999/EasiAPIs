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
                    <h6 class="m-0 font-weight-bold text-primary">Manage Social Login</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <tr>
                                <th>Social Network</th>
                                <th>Status</th>
                                <th>Config Id</th>
                                <th>Action</th>

                            </tr>
                            <?php
                            if (!empty($social_login)) {
                                foreach ($social_login as $key => $social_logins) {

                            ?>
                                    <tr>
                                        <td><?php echo $social_logins['social_login_name'] ?></td>
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" data="<?php echo $social_logins['origin']; ?>" class="status-switch" id="customSwitch1" <?= $social_logins['status'] == 1 ? 'checked' : ''; ?>>
                                                <span class="slider round"></span>
                                                <span style="display:none"><?php echo $social_logins['status']; ?></span>
                                            </label>
                                        </td>
                                        <form action='<?= base_url() ?>cms/social_login_update' id="update_social_login" method="POST">
                                            <td>
                                                <input type="text" autocomplete="off" name="config" id="config" class="form-control" value="<?php echo $social_logins['config'] ?>" />
                                            </td>
                                            <input type="hidden" name="origin" id="origin" value="<?php echo $social_logins['origin'] ?>" />
                                            <td><input class="updateButton btn btn-outline-primary btn-sm" type="submit" name="submit" value="Update"></td>
                                        </form>

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
        $(document).on('click', '.status_checks', function() {
            var status = ($(this).hasClass("btn-outline-success")) ? '0' : '1';
            var msg = (status == '0') ? 'Deactivate' : 'Activate';
            if (confirm("Are you sure to " + msg)) {
                var current_element = $(this);
                var origin = $(current_element).attr('data');

                url = "<?php echo base_url() . 'cms/social_login_status' ?>/" + origin;
                // alert(url);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        "origin": origin,
                        "status": status
                    },
                    success: function(data) {
                        location.reload();
                    }
                });
            }
        });
    </script>
   

   <script>
		$(document).ready(function() {
    $('.status-switch').change(function() {
        var current_element = $(this);
        var origin = $(current_element).attr('data');
        var status = $(this).is(':checked') ? 1 : 0;
        url = "<?php echo base_url() . 'cms/social_login_status' ?>/" + origin;
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