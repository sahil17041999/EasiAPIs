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
                    <h6 class="m-0 font-weight-bold text-primary">Authentication Listing</h6>
					<!--<div class="text-right">
					 <form action="<?php echo base_url();?>category/import_category" method="post" enctype="multipart/form-data"> 
                     <input type="file" name="uploadFile" value="" />
                     <input type="submit" name="submit" value="Import" class="btn btn-outline-dark btn-sm" />
                    </form>
					</div>-->
                </div>
                <div class="card-body">
                    <a class="btn btn-outline-primary btn-sm" href="<?= base_url() ?>user/add_auth">
						<i class="fa fa-plus" aria-hidden="true"></i> Add</a>
					<button class="mx-2 btn btn-outline-success btn-sm" id="btnExport" onclick="exportReportToExcel(this)">
						<i class="fa fa-download" aria-hidden="true"></i>
						Excel</button>
					<iframe id="txtArea1" style="display:none"></iframe>
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" data-cols-width="10,25,25,20,20,20">
                            <thead>
                            <tr>
                                <th data-f-bold="true">Id</th>
                                <th data-f-bold="true">Domain</th>
                                <th data-f-bold="true">Username</th>
								<th data-f-bold="true">Password</th>
								<th data-f-bold="true">Status</th>
                                <th data-exclude="true">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (!empty($authentication_data)) {
                                // echo $page_content;
                                foreach ($authentication_data as $key => $authentication_list) {

                            ?>
                                    <tr>
                                        <td><?php echo $key+1 ?></td>
                                        <td><?php echo $authentication_list['domain'] ?></td>
										<td><?php echo $authentication_list['username'] ?></td>
										<td><?php echo $authentication_list['password'] ?></td>
                                        <td>
										<label class="switch">
                                           <input type="checkbox" data="<?php echo $authentication_list['id']; ?>"  class="status-switch" id="customSwitch1" <?= $authentication_list['status'] == 1 ? 'checked' : ''; ?>>
										<span class="slider round"></span>
										<span style="display:none"><?php echo $authentication_list['status'];?></span>
									    </label>
											
                                        </td>
                                        <td data-exclude="true">
                                          <a href="<?= base_url() ?>user/edit_auth/<?php echo $authentication_list['id']; ?>" class="btn btn-outline-primary btn-sm">Edit</a>
                                            <a onclick="return confirm('Are you sure want to delete Authenticaton');" href="<?= base_url() ?>user/delete_auth/<?php echo $authentication_list['id']; ?>" class="btn btn-outline-danger btn-sm">Delete</a>
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
        url = "<?php echo base_url() . 'user/auth_status' ?>/" + origin;
        $.ajax({
            url:url ,
            type: 'POST',
            data: {
                id: origin,
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
    name: `ApiS_Auth.xlsx`,
    sheet: {
      name: 'Apis Auth sheet'
    }
  });  
}
</script>