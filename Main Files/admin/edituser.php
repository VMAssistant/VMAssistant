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
                            <h1 class="page-title">Edit Profile</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        
                        <!-- ROW-1 OPEN -->
                        <div class="row">

                        <div class="col-xl-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Edit Profile</h3>
                                    </div>
                                    <div class="card-body">
<?php
if(isset($_POST['editbtn'])){
    $id = $_POST['edit_id'];
    $query = "SELECT * from users WHERE user_id='$id'";
    $query_run = mysqli_query($connection, $query);
    foreach($query_run as $row){
        ?>



                            <form action="functions.php" method="POST">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12">
                                                <input type="hidden" name="edit_id" value="<?php echo $row['user_id']?>">
                                                <div class="form-group">
                                                    <label for="exampleInputname">Full Name</label>
                                                    <input type="text" class="form-control" name="edit_fullname" value="<?php echo $row['fullname'] ?>" placeholder="Full Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" class="form-control check-email" name="edit_useremail" value="<?php echo $row['email'] ?>" placeholder="Email address">
                                            <small class="error-email" style="color: red;"></small>
                                        </div>


                                    </div>
                                    <div class="card-footer text-end">
                               
                                        <button type="submit" name="update_btn" class="btn btn-success my-1">Save</button>
                             </form>
                                        <?php
    }
}

?>

                                    </div>
                                </div>

                            </div>
                            <form action="functions.php" method="POST">
                            <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Edit Password</div>
                                    </div>
                                    <div class="card-body">

                                    <?php
if(isset($_POST['editbtn'])){
    $id = $_POST['edit_id'];
    $query = "SELECT * from users WHERE user_id='$id'";
    $query_run = mysqli_query($connection, $query);
    foreach($query_run as $row){
        ?>
                                        <div class="form-group">
                                        <input type="hidden" name="edit_id" value="<?php echo $row['user_id']?>">
                                            <label class="form-label">New Password</label>
                                            <div class="wrap-input100 validate-input input-group" id="Password-toggle1">
                                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                    <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                                </a>
                                                <input class="input100 form-control" name="update_userpass" type="password" placeholder="New Password" autocomplete="new-password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Confirm Password</label>
                                            <div class="wrap-input100 validate-input input-group" id="Password-toggle2">
                                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                    <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                                </a>
                                                <input class="input100 form-control" name="confirm_userpass" type="password" placeholder="Confirm Password" autocomplete="new-password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-end">
                                        <button type="submit" name="update_passbtn" class="btn btn-primary">Update</button>
                                    </form>
                                    <?php
    }
}

?>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <!-- ROW-1 CLOSED -->

                    </div>
                    <!--CONTAINER CLOSED -->

                </div>
            </div>
            <!--app-content open-->





<?php
include('../includes/admin-scripts.php');
include('../includes/footer.php');
?>