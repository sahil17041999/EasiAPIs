<div id="content-wrapper" class="d-flex flex-column">
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
                    <h6 class="m-0 font-weight-bold text-primary">Seo</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Keyword</th>
                                <th>Description</th>
                                <th>Module</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            if (!empty($data_list)) {
                                $data_list = $data_list['data'];
                                foreach ($data_list as $k => $v) {
                                   // debug($list['title']);die;
                            ?>
                                    <tr>
                                       <td><?=($k+1)?></td>
						<td><?=$v['title']?></td>
						<td><?=$v['keyword']?></td>
						<td><?=$v['description']?></td>
						<td><?=$v['module']?></td>

                                      <td>

                        <a href="<?= base_url() ?>cms/edit_seo/<?php echo $v['id']; ?>" class="btn btn-outline-primary btn-sm">Edit</a>
                                     
                                        </td>
                                    </tr>
                            <?php
                                }
                            }

                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    