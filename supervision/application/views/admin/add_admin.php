<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?php include('includes/nav.php'); ?>

        <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add User</h6>
                </div>
                <div class="card-body">
                    <a class="btn btn-outline-primary btn-sm" href="<?= base_url() ?>user/admin">Back</a>
                    <form role="form" id="addUser" action="<?php echo base_url() ?>user/add_user" method="post" role="form" class="mt-3" >
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control required" value="" id="name" name="name" maxlength="50" required>
                                        <span style="color:red"></span>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email address <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control required email" id="email" value="" name="email" maxlength="128" required>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                    <label for="email"> Phone code</label>
                                        <select class="form-control required" id="phone_code" name="phone_code" required>
                                        <option value="0">Select phone code</option>
                                        <?php
                                         echo $phone_code;

                                          foreach ($phone_code as $key => $phone_code_record) {
                                        ?>
                                        <option value="<?=$phone_code_record->code?>"><?= $phone_code_record->code,' ',$phone_code_record->country?></option>
                                        <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mobile">Mobile Number</label>
                                        <input type="text" class="form-control required digits" id="mobile" value="" name="mobile" maxlength="10" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select class="form-control required" id="roleId" name="roleId" required>
                                            <option value="0">Select Role</option>
                                            <option value="1">View</option>
                                            <option value="2">Add</option>
                                            <option value="3">Delete</option>
                                            <option value="4">Update</option>
                                        </select>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="isAdmin">User Type <span class="text-danger">*</span></label>
                                        <select class="form-control required" id="isAdmin" name="isAdmin" required>
                                            <option value="2">Sub Admin</option>
                                            <!-- <option value="1">System Administrator</option> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="isAdmin">Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control required" id="address" name="address" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control required" id="password" name="password" maxlength="20" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpassword">Confirm Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control required equalTo" id="cpassword" name="cpassword" maxlength="20" required>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="submit" class="btn btn-outline-primary btn-sm" value="Add" />
                            <input type="reset" class="btn btn-outline-dark btn-sm" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>