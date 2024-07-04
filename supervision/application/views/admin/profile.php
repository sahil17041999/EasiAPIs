<?php
//debug($userInfo);die;
$userId = $userInfo->userId;
$name = $userInfo->name;
$email = $userInfo->email;
$address = $userInfo->address;
$isAdmin = $userInfo->isAdmin;
$image = $userInfo->image;

?>

  <style>
        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ccc;
        }
    </style>
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?php include('includes/nav.php'); ?>

        <div class="container">
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
                        <div class="col-md-12">
                            <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4 col-md-7 mx-auto">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">User Profile <a class="btn btn-outline-primary btn-sm" href="<?= base_url(); ?>user/profile_Update">Update Profile</a></h6>
                </div>
                <div class="card-body">


                    <div class="box box-warning">
                        <div class="box-body box-profile">

                            <div>
                                <img id="profilePreview" class="profile-img" src="<?= base_url(); ?>assets/img/user_images/<?=$image?>" alt="Profile Image">
                                <input type="file" id="profileImage" name="image" style="display:none;">
                            </div>
                            <!-- <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url(); ?>assets/dist/img/avatar5.png" alt="User profile picture">
 -->

                            <h4 class="profile-username mt-2">Name : <?= $name ?></h4>
                            <ul class="list-group list-group-unbordered">
                                <?php if ($isAdmin == '1') {
                                    $user_type = 'Admin';
                                ?>
                                    <li class="list-group-item">
                                        <b><i class="fa fa-user" aria-hidden="true"></i> </b> <a class="pull-right"><?= $user_type  ?></a>
                                    </li>
                                <?php } else { ?>
                                <?php } ?>
                                <li class="list-group-item">
                                    <b><i class="fa fa-envelope" aria-hidden="true"></i> </b> <a class="pull-right"><?= $email ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b><i class="fa fa-address-card" aria-hidden="true"></i> </b> <a class="pull-right text-dark text-underline-none"><?= $address ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function()
        {
            $('#profilePreview').on('click', function() {
                $('#profileImage').click();
            });

            $('#profileImage').on('change', function() {
                var formData = new FormData();
                formData.append('image', this.files[0]);
                Url = "<?php echo base_url() . 'user/update_profile_image' ?>";

                $.ajax({
                    url: Url,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Update the preview image with the new image URL
                        $('#profilePreview').attr('src', 'assets/img/user_images' + response.newImageName);
                        location.reload();
                    }
                });
            });
        });
    </script>