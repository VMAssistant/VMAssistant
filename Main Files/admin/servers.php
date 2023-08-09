<?php
include('security.php');
include('../includes/admin-header.php');
include('../includes/admin-navbar.php');
?>


<!--app-content open-->
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Add Server</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Servers</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->


            <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Servers</h3>
                                    </div>
                                    <div class="card-body">
                                        <button type="button" id="table2-new-row-button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addserver"> Add New Server</button>
                                        <div class="table-responsive">

                                        <?php
                                        $query = "SELECT * FROM servers";
                                        $query_run = mysqli_query($connection, $query);
                                        ?>

                                    <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                                <thead>
                                                    <tr>
                                                        <th class="wd-15p border-bottom-0">Server ID</th>
                                                        <th class="wd-15p border-bottom-0">Name</th>
                                                        <th class="wd-20p border-bottom-0">IP Address</th>
                                                        <th class="wd-15p border-bottom-0">Port</th>
                                                        <th class="wd-15p border-bottom-0">Delete Server</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if(mysqli_num_rows($query_run) > 0){
                                                        while($row = mysqli_fetch_assoc($query_run)){
                                                        ?>

                                                    <tr>
                                                        <td><?php echo $row['server_id']; ?></td>
                                                        <td><?php echo $row['server_name']; ?></td>
                                                        <td><?php echo $row['ip_address']; ?></td>
                                                        <td><?php echo $row['port']; ?></td>
                                                        <td>
                                             
                                                            <button type="button" id="table2-new-row-button" class="btn btn-danger mb-4 serverdeletebtn"> Delete Server</button>
                                                            </td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    }
                                                    else{
                                                        echo "No Record Found";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Row -->  

  
                          <!-- Input modal -->
                          <div class="modal fade" id="addserver" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Add new server</h6>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="functions.php" method="POST">
                      <div class="mb-3">
                        <label for="servername" class="col-form-label">Server Name:</label>
                        <input type="text" class="form-control" name="server-name" required>
                      </div>
                      <div class="mb-3">
                        <label for="serverip" class="col-form-label">IP Address:</label>
                        <input type="text" class="form-control" name="server-ip" required>
                      </div>
                      <div class="mb-3">
                        <label for="serveros" class="col-form-label">Linux Distribution:</label>
                        <select name="server-os" class="form-control form-select" data-bs-placeholder="Select Linux Distribution">
                        <option value="RHEL">RHEL (CentOS, RockyLinux, AlmaLinux, etc)</option>
                        <option value="Ubuntu">Ubuntu</option>
                                                </select>
                      </div>
                      <div class="mb-3">
                        <label for="serverusername" class="col-form-label">Username:</label>
                        <input type="text" value="root" class="form-control" name="server-username" required>
                      </div>
                      <div class="mb-3">
                        <label for="serverpassword" class="col-form-label">Password:</label>
                        <input type="password" class="form-control" name="server-password" required>
                      </div>
                      
                      <div class="mb-3">
                        <label for="serverport" class="col-form-label">Port:</label>
                        <input type="number" value="22" class="form-control" name="server-port" required>
                      </div>
                      <div class="mb-3">
                                                <div class="modal-footer">
                    <button class="btn ripple btn-success" name="addserverbtn" type="submit">Add</button>
                    <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Close</button>
                </div>
                      </div>
                    </form>
                  </div>
            </div>
        </div>
    </div>
    <!-- End Input modal -->

        <!-- Delete modal -->
        <div class="modal fade" id="deleteservermodal">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Confirm Server Deletion</h6>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="functions.php" method="POST">
                    <h6>Would you like to delete the server?</h6>
                    <div class="mb-3">
                        <input type="hidden" class="form-control" name="delete_serverid" id="delete_serverid">
                      </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="deleteserverbtn" class="btn ripple btn-success">Delete</button>
                    <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Close</button>
                        
                </div>
            </div>
            </form>
        </div>
    </div>
    <!-- End Delete modal -->


<?php
include('../includes/admin-scripts.php');
include('../includes/footer.php');
?>