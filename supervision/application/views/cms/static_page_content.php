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
                    <h6 class="m-0 font-weight-bold text-primary">Static Page Content</h6>
                </div>
                <div class="card-body">
                    <a class="btn btn-outline-primary btn-sm" href="<?= base_url() ?>cms/add_page_content"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Page Title</th>
                                <th>Page SEO Title</th>
                                <th>Page SEO Keyword</th>
                                <!-- <th>Page SEO Description</th> -->
                                <th>Page Position</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (!empty($page_content)) {
                                // echo $page_content;
                                foreach ($page_content as $key => $page_contents) {

                            ?>
                                    <tr>
                                        <td><?php echo $page_contents['page_title'] ?></td>
                                        <td><?php echo $page_contents['page_seo_title'] ?></td>
                                        <td><?php echo $page_contents['page_seo_keyword'] ?></td>
                                        <!-- <td><?php echo $page_contents['page_position']  ?></td> -->
                                        <td><?php echo $page_contents['page_position'] ?></td>

                                        <td>
                                            <!--<i data="<?php echo $page_contents['page_id']; ?>" class="status_checks btn
                                            <?php echo ($page_contents['page_status']) ?
                                                'btn-outline-success btn-sm' : 'btn-outline-danger btn-sm' ?>"><?php echo $page_contents['page_status'] ? 'Active' :     'Inactive' ?>
                                            </i>-->
                                            <label class="switch">
                                                <input type="checkbox" data="<?php echo $page_contents['page_id']; ?>" class="status-switch" id="customSwitch1" <?= $page_contents['page_status'] == 1 ? 'checked' : ''; ?>>
                                                <span class="slider round"></span>
                                                <span style="display:none"><?php echo $page_contents['page_status']; ?></span>
                                            </label>
                                        </td>


                                        <td>

                                            <a href="<?= base_url() ?>cms/edit_page_content/<?php echo $page_contents['page_id']; ?>" class="btn btn-outline-primary btn-sm">Edit</a>
                                            <a onclick="return confirm('Are you sure want to delete static page content');" href="<?= base_url() ?>cms/delete_page_content/<?php echo $page_contents['page_id']; ?>" class="btn btn-outline-danger btn-sm">Delete</a>

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
       // var origin = $(current_element).attr('data');
        var status = $(this).is(':checked') ? 1 : 0;
        var page_id = $(current_element).attr('data');
        url = "<?php echo base_url() . 'cms/pages_content_status' ?>/" + page_id;
        $.ajax({
            url:url ,
            type: 'POST',
            data: {
                page_id: page_id,
                page_status: status
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