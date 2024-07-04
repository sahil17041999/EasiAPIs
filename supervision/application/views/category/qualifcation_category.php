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
                    <a class="btn btn-outline-primary btn-sm" href="<?= base_url() ?>category/add_qualification"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
					<button class="mx-2 btn btn-outline-success btn-sm" id="btnExport" onclick="exportReportToExcel(this)">
						<i class="fa fa-download" aria-hidden="true"></i>
						Excel</button>
					<iframe id="txtArea1" style="display:none"></iframe>
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" data-cols-width="10,25,25,20">
                            <tr>
                                <th data-f-bold="true">Id</th>
                                <th data-f-bold="true">Category</th>
								<th data-f-bold="true">Qualifcation category</th>
                                <th data-f-bold="true">Status</th>
                                <th data-exclude="true">Action</th>
                            </tr>
                            <?php
                            if (!empty($qualifcation_category_data)) {
                                // echo $page_content;
                                foreach ($qualifcation_category_data as $key => $qualifcation_category) {

                            ?>
                                    <tr>
                                        <td><?php echo $key+1 ?></td>
                                        <td><?php echo $qualifcation_category->category ?></td>
										<td><?php echo $qualifcation_category->qualification_name?></td>
                                        <td><i data="<?php echo $qualifcation_category->origin; ?>" class="status_checks btn
                                            <?php echo ($qualifcation_category->status) ?
                                    'btn-outline-success btn-sm' : 'btn-outline-danger btn-sm' ?>"><?php echo $qualifcation_category->status ? 'Active' :     'Inactive' ?>
                                            </i>
                                        </td>
                                        <td data-exclude="true">
                                            <a href="<?= base_url() ?>category/qualification_category_info/<?php echo $qualifcation_category->origin; ?>" class="btn btn-outline-primary btn-sm">Edit</a>
                                            <a onclick="return confirm('Are you sure want to delete static page content');" href="<?= base_url() ?>category/delete_quali_category/<?php echo $qualifcation_category->origin; ?>" class="btn btn-outline-danger btn-sm">Delete</a>
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
            var msg = (status == '0') ? 'deactivate' : 'activate';
                var current_element = $(this);
                var origin = $(current_element).attr('data');
                url = "<?php echo base_url() . 'category/quali_category_status' ?>/" + origin;
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
						 html:'<b>Are you want to </b> <b>'+msg+'</b>',
				         }).then(function(){ 
							location.reload();})
                    }
                });
        });
    </script>
	
<script>
  function exportReportToExcel() {
  let table = document.getElementsByTagName("table");
   TableToExcel.convert(table[0], { 
    name: `Qualifcation Category.xlsx`,
    sheet: {
      name: 'Qualifcation sheet'
    }
  });  
}
</script>