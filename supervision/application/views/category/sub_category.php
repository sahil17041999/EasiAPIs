<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?php include('nav.php'); ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">

                    <div id="message"></div>


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
                    <?php
                    $warning = $this->session->flashdata('warning');
                    if ($warning) {
                    ?>
                        <div class="alert alert-warning alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->flashdata('warning'); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Category</h6>
                </div>
                <div class="card-body">
                    <a class="btn btn-primary btn-sm" href="<?= base_url() ?>category/add_sub_category"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
                    <button class="mx-2 btn btn-success btn-sm" id="btnExport" onclick="exportReportToExcel(this)">
                        <i class="fa fa-download" aria-hidden="true"></i>
                        Excel</button>
                    <iframe id="txtArea1" style="display:none"></iframe>
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" data-cols-width="10,25,25,20">
                            <thead>
                                <tr>
                                    <th data-f-bold="true">Id</th>
                                    <th data-f-bold="true">Category</th>
                                    <th data-f-bold="true">Sub category</th>
                                    <th data-f-bold="true">Status</th>
                                    <th data-exclude="true">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($sub_category_data)) {
                                    // echo $page_content;
                                    foreach ($sub_category_data as $key => $sub_category) {

                                ?>

                                        <tr>
                                            <td><?php echo $key + 1 ?></td>
                                            <td><?php echo $sub_category->category ?></td>
                                            <td><?php echo $sub_category->sub_category_name ?></td>
                                            <td>
                                                <label class="switch">
                                                    <input type="checkbox" data="<?php echo $sub_category->origin; ?>" class="status-switch" id="customSwitch1" <?= $sub_category->status == 1 ? 'checked' : ''; ?>>
                                                    <span class="slider round"></span>
                                                    <span style="display:none"><?php echo $sub_category->status; ?></span>
                                                </label>
                                            </td>
                                            <td data-exclude="true">
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                                <a href="<?= base_url() ?>category/sub_category_info/<?php echo $sub_category->origin; ?>" class="btn btn-primary btn-sm mx-1">Edit</a>
                                                <form id="deleteForms">
                                                    <input type="hidden" name="origin" id="catehory_id" value="<?php echo $sub_category->origin; ?>">
                                                    <!--<a type="submit" class="btn btn-outline-danger btn-sm mt-1">Delete</a>-->
                                                    <button class="btn btn-danger btn-sm " type="submit">Delete</button>
                                                    <!--  <a onclick="return confirm('Are you sure want to delete static page content');" href="<?= base_url() ?>category/delete_sub_category/<?php echo $sub_category->origin; ?>" class="btn btn-outline-danger btn-sm">Delete</a>-->
                                                </form>
                                            </div>
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
            //   alert('hiiiii');
            $('#deleteForms').on('submit', function(e) {
                //alert('inside');
                e.preventDefault(); // Prevent the form from submitting the traditional way

                var origin = $('#catehory_id').val();

                var formData = $(this).serialize();
                url = "<?php echo base_url() . 'category/delete_sub_category' ?>/" + origin;
                // Send the AJAX request
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        // Display the message
                        $('#message').html(response.message);

                        // Add a class based on the status (optional)
                        if (response.status === 'success') {
                            $('#message').addClass('alert alert-success alert-dismissable');
                        } else {
                            $('#message').addClass('alert alert-danger alert-dismissable');
                        }
                    },
                    error: function() {
                        // Handle any errors
                        $('#message').html('Cannot delete this row because it is linked to other records.');
                        $('#message').addClass('alert alert-danger');
                    }
                });
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('.status-switch').change(function() {
                var current_element = $(this);
                var origin = $(current_element).attr('data');
                var status = $(this).is(':checked') ? 1 : 0;
                url = "<?php echo base_url() . 'category/sub_category_status' ?>/" + origin;
                $.ajax({
                    url: url,
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


    <script>
        function exportReportToExcel() {
            let table = document.getElementsByTagName("table");
            TableToExcel.convert(table[0], {
                name: `Specialty Category.xlsx`,
                sheet: {
                    name: 'Specialty sheet'
                }
            });
        }
    </script>