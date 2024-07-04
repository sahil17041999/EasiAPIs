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
                    <h6 class="m-0 font-weight-bold text-primary">Category</h6>
                </div>
                <div class="card-body">
                    <a class="btn btn-outline-primary btn-sm" href="<?= base_url() ?>product/add_category"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <tr>
                                <th>Id</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            if (!empty($category_data)) {
                                // echo $page_content;
                                foreach ($category_data as $key => $category) {

                            ?>
                                    <tr>
                                        <td><?php echo $category['origin'] ?></td>
                                        <td><?php echo $category['category_name'] ?></td>
                                        <td><i data="<?php echo $category['origin']; ?>" class="status_checks btn
                                            <?php echo ($category['status']) ?
                                                'btn-outline-success btn-sm' : 'btn-outline-danger btn-sm' ?>"><?php echo $category['status'] ? 'Active' :     'Inactive' ?>
                                            </i>
                                        </td>
                                        <td>
                                            <a href="<?= base_url() ?>product/category_info/<?php echo $category['origin']; ?>" class="btn btn-outline-primary btn-sm">Edit</a>
                                            <a onclick="return confirm('Are you sure want to delete static page content');" href="<?= base_url() ?>product/delete_category/<?php echo $category['origin']; ?>" class="btn btn-outline-danger btn-sm">Delete</a>
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
        $(document).on('click', '.status_checks', function() {
            var status = ($(this).hasClass("btn-outline-success")) ? '0' : '1';
            var msg = (status == '0') ? 'Deactivate' : 'Activate';
            if (confirm("Are you sure to " + msg)) {
                var current_element = $(this);
                var origin = $(current_element).attr('data');

                url = "<?php echo base_url() . 'product/category_status' ?>/" + origin;
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