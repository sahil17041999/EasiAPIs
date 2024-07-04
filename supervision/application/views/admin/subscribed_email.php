<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?php include('includes/nav.php'); ?>

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
                    <h6 class="m-0 font-weight-bold text-primary">Subscribed Email Listing</h6>
                </div>
                <div class="card-body">
					<button class="mx-2 btn btn-outline-success btn-sm" id="btnExport" onclick="exportReportToExcel(this)">
						<i class="fa fa-download" aria-hidden="true"></i>
						Excel</button>
					<iframe id="txtArea1" style="display:none"></iframe>
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" data-cols-width="10,25,20">
                            <thead>
                            <tr>
                                <th data-f-bold="true">Id</th>
                                <th data-f-bold="true">Email</th>
                                <th data-f-bold="true">Status</th>
                                <th data-exclude="true">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (!empty($subscriber_list)) {
                                  //debug($subscriber_list[0]->id);die;
                                foreach ($subscriber_list as $key => $subscriber) {

                                                                          ?>
                                        <tr>
                                            <td><?php echo $key+1 ?></td>
                                            <td><?php echo $subscriber->email_id; ?></td>
                                            <td><i  data="<?php echo $subscriber->id; ?>" class="status_checks btn
                                            <?php echo ($subscriber->status) ?
                                            'btn-outline-success btn-sm' : 'btn-outline-danger btn-sm' ?>"><?php echo $subscriber->status ? 'Active' :     'Inactive' ?>
                                                </i>
                                            </td>
                                       
                                            <td data-exclude="true">
 <a onclick="return confirm('Are you sure want to delete subscribed email');" href="<?= base_url() ?>user/delete_subscribed_emails/<?php echo $subscriber->id; ?>" class="btn btn-outline-danger btn-sm">Delete</a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>
     <script>
       $(document).on('click','.status_checks',function()
         { 
        var status = ($(this).hasClass("btn-outline-success")) ? '0' : '1'; 
        var msg = (status=='0')? 'Deactivate' : 'Activate'; 
        if(confirm("Are you sure to "+ msg))
        { 
            var current_element = $(this); 
            var id = $(current_element).attr('data');
			//console.log(id);
              
            url = "<?php echo base_url().'user/status_subscribed'?>/"+id; 
                $.ajax({
                  type:"POST",
                  url: url, 
                  data: {"id":id,"status":status}, 
                  success: function(data) { 
                  location.reload();
            } });
         }  
         });
    </script>
	

	
<script>
     function exportReportToExcel() {
     let table = document.getElementsByTagName("table");
     TableToExcel.convert(table[0], { 
     name: `subscribed_email.xlsx`,
     sheet: {
      name: 'subscribed email sheet'
     }
  });  
}
</script>
