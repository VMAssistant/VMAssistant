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
                <h1 class="page-title">Add Admin</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Admins</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->


            <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Admins</h3>
                                    </div>
                                    <div class="card-body">
                                        <button type="button" id="table2-new-row-button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#adduser"> Add New Admin</button>
                                        <div class="table-responsive">

                                        <?php
                                        $query = "SELECT * FROM users where usertype='Admin'";
                                        $query_run = mysqli_query($connection, $query);
                                        ?>

                        <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                                <thead>
                                                    <tr>
                                                        <th class="wd-15p border-bottom-0">ID</th>
                                                        <th class="wd-15p border-bottom-0">Full Name</th>
                                                        <th class="wd-15p border-bottom-0">Email</th>
                                                        <th class="wd-15p border-bottom-0">User Type</th>
                                                        <th class="wd-15p border-bottom-0">Edit User</th>
                                                        <th class="wd-15p border-bottom-0">Delete User</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if(mysqli_num_rows($query_run) > 0){
                                                        while($row = mysqli_fetch_assoc($query_run)){
                                                        ?>

                                                    <tr>
                                                        <td><?php echo $row['user_id']; ?></td>
                                                        <td><?php echo $row['fullname']; ?></td>
                                                        <td><?php echo $row['email']; ?></td>
                                                        <td><?php echo $row['usertype']; ?></td>
                                                        <td>
                                                            <form action="editadmin.php" method="post">
                                                            <input type="hidden" name="edit_id" value="<?php echo $row['user_id']; ?>">
                                                            <button type ="submit" name="editbtn" class="btn btn-secondary mb-4">Edit</button>
                                                            </form>
                                                        </td>
                                                        <td>
                                             
                                                            <button type="button" id="table2-new-row-button" class="btn btn-danger mb-4 deletebtn"> Delete User</button>
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

  
                          <!-- Input modal -->
                          <div class="modal fade" id="adduser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Add new admin</h6>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="functions.php" method="POST">
                      <div class="mb-3">
                        <label for="user-fullname" class="col-form-label">Full Name:</label>
                        <input type="text" class="form-control" name="fullname" required>
                      </div>
                      <div class="mb-3">
                      <label for="user-email" class="col-form-label">Email Address:</label>
                        <input type="email" class="form-control check-email" name="email" required>
                        <small class="error-email" style="color: red;"></small>
                      </div>
                      <div class="mb-3">
                        <label for="user-password" class="col-form-label">Password:</label>
                        <input type="password" class="form-control" name="password" required>
                      </div>
                      <div class="mb-3">

                                                <div class="modal-footer">
                    <button class="btn ripple btn-success" name="addadminbtn" type="submit">Add</button>
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
        <div class="modal fade" id="deletemodal">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Confirm User Deletion</h6>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="functions.php" method="POST">
                    <h6>Would you like to delete the user?</h6>
                    <div class="mb-3">
                        <input type="hidden" class="form-control" name="delete_id" id="delete_id">
                      </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="deleteadminbtn" class="btn ripple btn-success">Delete</button>
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