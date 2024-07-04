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
                    <h6 class="m-0 font-weight-bold text-primary">why choose us</h6>
                </div>
                <div class="card-body">
                    <a class="btn btn-outline-primary btn-sm" href="<?= base_url() ?>cms/add_why_choose_us"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                            <head>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Icon</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </head>
                            <tbody>
                                <?php
                                if (!empty($why_choose_list)) {

                                    foreach ($why_choose_list as $k => $list) {

                                ?>
                                        <tr>
                                            <td><?php echo $k + 1; ?></td>
                                            <td><?php echo $list->title; ?></td>
                                            <td><i style="font-size:26px" class="<?php echo $list->icon_name; ?>" aria-hidden="true"></i></td>
                                            <td>
                                                <!--<i data="<?php echo $list->origin; ?>" class="status_checks btn
                                            <?php echo ($list->status) ?
                                                'btn-outline-success btn-sm' : 'btn-outline-danger btn-sm' ?>"><?php echo $list->status ? 'Active' :     'Inactive' ?>
                                                </i>-->
                                                <label class="switch">
                                                <input type="checkbox" data="<?php echo $list->origin; ?>" class="status-switch" id="customSwitch1" <?= $list->status == 1 ? 'checked' : ''; ?>>
                                                <span class="slider round"></span>
                                                <span style="display:none"><?php echo $list->status; ?></span>
                                            </label>
                                            </td>


                                            <td>

                                                <a href="<?= base_url() ?>cms/edit_why_choose_us/<?php echo $list->origin; ?>" class="btn btn-outline-primary btn-sm">Edit</a>
                                                <a onclick="return confirm('Are you sure want to delete why choose data ');" href="<?= base_url() ?>cms/why_choose_delete/<?php echo $list->origin; ?>" class="btn btn-outline-danger btn-sm">Delete</a>

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
        $(document).on('click', '.status_checks', function() {
            var status = ($(this).hasClass("btn-outline-success")) ? '0' : '1';
            var msg = (status == '0') ? 'deactivate' : 'activate';
            var current_element = $(this);
            var origin = $(current_element).attr('data');
            url = "<?php echo base_url() . 'cms/why_choose_status' ?>/" + origin;
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    "origin": origin,
                    "status": status
                },
                success: function(data) {
                    Swal.fire({
                        icon: "success",
                        html: '<b>Are you want to </b> <b>' + msg + '</b>',
                    }).then(function() {
                        location.reload();
                    })
                }
            });
        });
    </script>


   
<script>
$(document).ready(function() {
    $('.status-switch').change(function() {
        var current_element = $(this);
        var origin = $(current_element).attr('data');
        var status = $(this).is(':checked') ? 1 : 0;
        url = "<?php echo base_url() . 'cms/why_choose_status' ?>/" + origin;
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