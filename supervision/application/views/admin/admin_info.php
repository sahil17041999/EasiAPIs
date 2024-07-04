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
                    <h6 class="m-0 font-weight-bold text-primary"><?= $pageTitle ?></h6>
                </div>
                <div class="card-body">
                    <a class="btn btn-outline-primary btn-sm" href="<?= base_url() ?>user/add_user"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <tr>
                                <th>UserId</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>User Type</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            if (!empty($userRecords)) {
                              // debug($userRecords);die;
                                foreach ($userRecords as $key => $record) {

                                    if($record->isAdmin == '2'){
                                        $user_role = 'Subadmin';
                                    }
                                   if($record->isAdmin != '1'){


                            ?>
                                        <tr>
                                            <td><?php echo $record->userId ?></td>
                                            <td><?php echo $record->name ?></td>
                                            <td><?php echo $record->email ?></td>
                                            <td><?php echo $user_role ?></td>
                                            <td><?php echo $record->address ?></td>

                                            <td><i  data="<?php echo $record->userId; ?>" class="status_checks btn
                                            <?php echo ($record->status) ?
                                            'btn-outline-success btn-sm' : 'btn-outline-danger btn-sm' ?>"><?php echo $record->status ? 'Active' :     'Inactive' ?>
                                                </i>
                                            </td>
                                           

                                            <td>

                                                <a href="<?= base_url() ?>user/editOld/<?php echo $record->userId; ?>" class="btn btn-outline-primary btn-sm">Edit</a>
                                                <?php if($record->user_type == '1'){?>
                                                    <?php } else{?>
                                                <a onclick="return confirm('Are you sure want to delete user');" href="<?= base_url() ?>user/deleteUser/<?php echo $record->userId; ?>" class="btn btn-outline-danger btn-sm">Delete</a>
                                                <?php }?>
                                            </td>
                                        </tr>
                            <?php
                                    }
                                }
                            }
                            
                            ?>
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
            var userId = $(current_element).attr('data');
              
            url = "<?php echo base_url().'user/update_status'?>/"+userId; 
           // alert(url);
                $.ajax({
                  type:"POST",
                  url: url, 
                  data: {"userId":userId,"status":status}, 
                  success: function(data) { 
                  location.reload();
            } });
         }  
         });
    </script>