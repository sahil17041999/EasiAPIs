<style>
    .error {
        color: red;
        font-size: 12px;
    }
</style>
<?php
     $sub_category_name =  $sub_category_info->sub_category_name;
     $category_id =  $sub_category_info->category_id;
     $origin =  $sub_category_info->origin;
?>


<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?php include('nav.php'); ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 mx-auto">
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
                     <!--   <div class="col-md-8 mx-auto">
                            <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                        </div>-->
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4 col-md-8 mx-auto">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><a class="" href="<?= base_url() ?>category/sub_category"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a> Edit Sub Category</h6>

                </div>
                <div class="card-body">
                    <form role="form" action="<?php echo base_url() ?>category/edit_sub_category" method="post">
                        <div class="box-body">
							<div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputPassword1">Category<span class="text-danger">*</span></label>
										
                                        <select class="form-control" name="category_id" id="category_id" >
                                     
                                            <?php  foreach($category_list as $key => $category){?>
                                                <?php if($category['status'] == '1') { ?>
                                                <option value="<?=$category['origin']?>" <?php if($category['origin'] == $category_id) { echo "selected=selected";} ?>><?=$category['profession_name']?></option>
                                                <?php } } ?>
                                        </select>
                                    </div>
									<span class="error"><?php echo form_error('category_id'); ?></span>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputPassword1">Sub Category<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="<?=$sub_category_name?>"  id="sub_category_name" name="sub_category_name"  placeholder="Enter Sub Category .... ">
                                        <input type="hidden" name="origin" value="<?=$origin?>">
                                    </div>
                                    <span class="error"><?php echo form_error('sub_category_name'); ?></span>
                                </div>
								
                            </div>
        
                            
                        </div>
                        <div class="box-footer">
                            <input type="submit" class="btn btn-outline-primary btn-sm" value="Edit Data" />
                            <input type="reset" class="btn btn-outline-dark btn-sm" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>