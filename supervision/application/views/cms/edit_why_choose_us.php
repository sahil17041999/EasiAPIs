<?php
     $origin = $edit_why_choose_us->origin ;
     $icon_id = $edit_why_choose_us->icon_id;
     $title = $edit_why_choose_us->title;
     $icon = $edit_why_choose_us->icon;
     $description = $edit_why_choose_us->description;
?>

<style>
	.error{
		color:red;
		font-size:12px;
		margin-top:20px;
	}
</style>
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?php include('nav.php'); ?>

        <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
               
                <?php
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
                
                
            </div>
        </div>
            <div class="card shadow mb-4 col-md-8 mx-auto">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Edit Why choose us</h6>
                </div>
                <div class="card-body">
					<a href="<?= base_url()?>cms/why_choose_us" class="btn btn-outline-primary mb-2 btn-sm">back</a>
                   <form role="form" action="<?php echo base_url() ?>cms/edit_why_choose_us/<?php echo $origin ?>" method="post">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputPassword1">Title</label>
                                        <input type="text" value="<?=$title?>" class="form-control" id="title"  name="title" placeholder="Enter title...">
										<input type="hidden"  id="status"  name="status" value="0">
										<input type="hidden"  id="origin"  name="origin" value="<?=$origin?>">
										<span class="error"><?php echo form_error('title'); ?></span>
										
                                    </div>
                                </div>
								 <div class="col-md-6">
                                    <div class="form-group">
										
                                 <label >Icons</label>
										<select class='form-control' name="icon_id">
											<option value="" selected="selected">Select icon</option>
											
											<?php 
	                                        //   echo $icon_list
	                             foreach($icon_list as  $key => $icon){?>
					<option  value="<?=$icon['origin']?>"<?php if($icon['origin'] == $icon_id) { echo "selected=selected";} ?>>
												<?=$icon['name']?>
											</option>
	                                       <?php }?>
										</select>
										<span class="error"><?php echo form_error('icon_id'); ?></span>
                                    </div>
                                </div>
                            </div>
                
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Descripton</label>
										<textarea class="form-control" name="description">
											<?=$description?>
										</textarea>
										<span class="error"><?php echo form_error('description'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-outline-primary btn-sm" value="Add" />
                            <input type="reset" class="btn btn-outline-dark btn-sm" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>