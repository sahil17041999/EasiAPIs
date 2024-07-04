

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
                    <h6 class="m-0 font-weight-bold text-primary">Category Listing</h6>
					<!--<div class="text-right">
					 <form action="<?php echo base_url();?>category/import_category" method="post" enctype="multipart/form-data"> 
                     <input type="file" name="uploadFile" value="" />
                     <input type="submit" name="submit" value="Import" class="btn btn-outline-dark btn-sm" />
                    </form>
					</div>-->
                </div>
                <div class="card-body">
                    <a class="btn btn-primary btn-sm" href="<?= base_url() ?>category/add_category">
						<i class="fa fa-plus" aria-hidden="true"></i> Add</a>
					<button class="mx-2 btn btn-success btn-sm" id="btnExport" onclick="exportReportToExcel(this)">
						<i class="fa fa-download" aria-hidden="true"></i>
						Excel</button>
					<iframe id="txtArea1" style="display:none"></iframe>
                    
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered" id="dataTable" width="100%"  data-cols-width="10,25,25">
                        <thead>
                            <tr>
                                
                                <th data-f-bold="true">Id</th>
                                <th data-f-bold="true">category Icon</th>
                                <th data-f-bold="true">category</th>
								<!--<th data-f-bold="true">category Icon</th>-->
                                <th data-f-bold="true">Status</th>
                                <th data-exclude="true">Action</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (!empty($profession_data)) {
                                // echo $page_content;
                                foreach ($profession_data as $key => $profession) {

                            ?>
                                    <tr>
                                        <td><?php echo $key+1 ?></td>
                                        <td><img  width="40px" class="" src="<?=base_url()?>assets/img/api_category_img/<?php echo $profession['service_icon'];?>"></td>
                                        <td><?php echo $profession['profession_name'] ?></td>
									<!--	<td></td>-->
                                        <td>
										<label class="switch">
                                           <input type="checkbox" data="<?php echo $profession['origin']; ?>"  class="status-switch" id="customSwitch1" <?= $profession['status'] == 1 ? 'checked' : ''; ?>>
										<span class="slider round"></span>
										<span style="display:none"><?php echo $profession['status'];?></span>
									    </label>
											
                                        </td>
                                        <td data-exclude="true">
                                            <a href="<?= base_url() ?>category/category_info/<?php echo $profession['origin']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                            <a onclick="return confirm('Are you sure want to delete static page content');" href="<?= base_url() ?>category/delete_category/<?php echo $profession['origin']; ?>" class="btn btn-danger btn-sm">Delete</a>
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
        url = "<?php echo base_url() . 'category/category_status' ?>/" + origin;
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
	
	
	
	
	
	<script>
  function exportReportToExcel() {
  let table = document.getElementsByTagName("table");
   TableToExcel.convert(table[0], { 
    name: `Category.xlsx`,
    sheet: {
      name: 'Category sheet'
    }
  });  
}
</script>