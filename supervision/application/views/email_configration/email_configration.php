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
                    <h6 class="m-0 font-weight-bold text-primary">Add Email Configuration</h6>
                </div>
                <div class="card-body">
                    <form role="form" action="<?php echo base_url() ?>email_configration/index" method="post">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="inputPassword1">Username</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="" value="<?= $user_name ?>" name="username"  required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                <label for="inputPassword1">Password</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                       
                                        <input type="password" class="form-control" id="" name="password" maxlength="20" required>
                                        <span>Note :- Password will not displayed for security reason.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-2">
                            <label for="inputPassword1">from</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                       
                                        <input type="text" class="form-control" id="" value="<?= $from ?>" name="from" maxlength="20" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-2">
                            <label for="inputPassword1">Host</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        
                                        <input type="text" class="form-control" id="" value="<?= $host ?>" name="host" maxlength="20" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-2">
                            <label for="inputPassword1">Port</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        
                                        <input type="text" class="form-control" id="" value="<?= $port ?>" name="port" maxlength="20" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-2">
                            <label for="inputPassword2">CC Email</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                       
                                        <input type="email" class="form-control" id="" value="<?= $cc ?>" name="cc_email"  required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-2">
                            <label for="inputPassword2">BCC Email</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                       
                                        <input type="email" class="form-control" id="" value="<?= $bcc ?>" name="bcc_email"  required>
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