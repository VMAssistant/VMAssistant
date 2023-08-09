<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
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
                        <li class="breadcrumb-item active" aria-current="page">Server Utilities</li>
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
                                        <div class="table-responsive">

                                        <?php
                                         $query = "SELECT * FROM servers where user_id='".$_SESSION['user_id']."'";
                                        $query_run = mysqli_query($connection, $query);
                                        ?>

                                    <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                                <thead>
                                                    <tr>
                                                        <th class="wd-15p border-bottom-0">Server ID</th>
                                                        <th class="wd-15p border-bottom-0">Name</th>
                                                        <th class="wd-20p border-bottom-0">IP Address</th>
                                                        <th class="wd-15p border-bottom-0">Port</th>
                                                        <th class="wd-15p border-bottom-0">Status</th>
                                                        <th class="wd-15p border-bottom-0">Manage Server Utilities</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
if(mysqli_num_rows($query_run) > 0){
    function ping($host) {
        exec("ping -c 1 -w 1 " . $host, $output, $status);
        return ($status == 0);
    }
    while($row = mysqli_fetch_assoc($query_run)){
    ?>


                                                    <tr>
                                                        <td><?php echo $row['server_id']; ?></td>
                                                        <td><?php echo $row['server_name']; ?></td>
                                                        <td><?php echo $row['ip_address']; ?></td>
                                                        <td><?php echo $row['port']; ?></td>
                                                        <td>
                                                        <?php 
        $status = ping($row['ip_address']);
        if ($status) {
            echo "<span class='server-up'></span> UP";
        } else {
            echo "<span class='server-down'></span> DOWN";
        }
        ?>
</td>




                                                        <td>
                                                        <?php 
        if (!$status) {
            echo "<button type='button' class='btn btn-primary mb-4' disabled>Manage Utility</button>";
        } else {
            echo "<form action='manage-utility.php' method='post'><input type='hidden' name='utilityserver_id' value='" . $row['server_id'] . "'><button type ='submit' name='utility-serverbtn' class='btn btn-primary mb-4'>Manage Utility</button></form>";
        }
        ?>
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




<?php
include('includes/scripts.php');
include('includes/footer.php');
?>