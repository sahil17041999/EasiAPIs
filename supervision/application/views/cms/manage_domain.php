<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?php include('nav.php'); ?>

        <div class="container">
             <div class="row">
            <div class="col-md-8 mx-auto">
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
                $success = $this->session->flashdata('success');
                if ($success) {
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
            <div class="card shadow mb-4 col-md-8 mx-auto">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Manage Domain</h6>
                </div>
                <div class="card-body">
                    <form role="form" action="<?php echo base_url() ?>cms/update_manage_domain" method="post">
                        <div class="box-body">
							
							<div class="row">
                                <div class="col-md-2">
                                    <label for="inputPassword1">Domain</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                       <input type="text" class="form-control" id="" value="<?php echo $data['domain_name'];?>" name="domain_name"  required>
							<input type="hidden" class="form-control" id="origin" value="1" name="origin">
                                    </div>
                                </div>
                            </div>
							
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="inputPassword1">Email Id</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="" value="<?php echo $data['email'];?>" name="email"  required>
                                    </div>
                                </div>
                            </div>
                     
                            <div class="row">
                            <div class="col-md-2">
                            <label for="inputPassword1">Phone</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                   <input type="number" class="form-control" id="" value="<?php echo $data['phone'];?>" name="phone"  required>
                                    </div>
                                </div>
                            </div>
							 <div class="row">
                            <div class="col-md-2">
                            <label for="inputPassword1">Alternative no</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                   <input type="number" class="form-control" id="" value="<?php echo $data['alternatve_no'];?>" name="alternatve_no"  required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-2">
                            <label for="inputPassword1">Address</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                          <input type="text" class="form-control" id="" value="<?php echo $data['address'];?>" name="address" required>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="submit" class="btn btn-outline-primary btn-sm" value="add" />
                            <input type="reset" class="btn btn-outline-dark btn-sm" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>