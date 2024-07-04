<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?php include('includes/nav.php'); ?>

        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $pageTitle ?></h6>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <tr>
                                <th>userId</th>
                                <th>User name</th>
                                <th>User type</th>
                                <!-- <th>IP Address</th> -->
                                <th>Platform</th>
                                <th>Last Login Date</th>
                                <th>Last Login Time</th>
                            </tr>
                            <?php
                            if (!empty($userRecords)) {

                                foreach ($userRecords as $record) {
                                    $admin_info = $record->sessionData;
                                    // echo json_decode( json_encode($admin_info), true);
                                    //echo json_decode($admin_info);
                                    $data = json_decode($admin_info, true);
                                    //debug($data['roleText']);die;

                                

                                    $date_data = $record->createdDtm;
                                    $date = date('F-d-Y', strtotime($date_data));
                                    $time = date('h-i a', strtotime($date_data));
                                    //echo $time;

                                    if (is_array($data) && isset($data['name'])) {
                                        $name = $data['name'];
                                        // $role = $data['roleText'];
                                        //debug($role);die;
                                        // echo $name; // Output: Admin
                                    } else {
                                        echo "Rolevand name does not exist or the variable is not an array.";
                                    }

                                    if ($record->userId != '1') {

                            ?>
                                        <tr>
                                            <td><?php echo $record->userId ?></td>
                                            <td><?php echo $name ?></td>
                                            <td><?php echo $data['roleText'] ?></td>
                                            <!-- <td><?php echo $record->machineIp ?></td> -->
                                            <td><?php echo $record->platform ?></td>
                                            <td><?php echo $date ?></td>
                                            <td><?php echo $time?></td>
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


    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>