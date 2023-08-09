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
                <h1 class="page-title">VM Assistant - Admin Dashboard</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

                       <!-- ROW-1 -->
                       <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="mt-2">
                                            <h6 class="">Users</h6>
                                            <?php
                                            require 'security.php';
                                            $query = "SELECT user_id from users WHERE usertype='User' ORDER by user_id";
                                            $query_run = mysqli_query($connection, $query);
                                            $row = mysqli_num_rows($query_run);
                                            echo '<h2 class="mb-0 number-font">'.$row.'</h2>';
         
                                            ?>
                                        </div>
                                        <div class="ms-auto">
                                            <div class="chart-wrapper mt-1">
                                                <canvas id="saleschart" class="h-8 w-9 chart-dropshadow"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="mt-2">
                                            <h6 class="">Admins</h6>
                                            <?php
                                            require 'security.php';
                                            $query = "SELECT user_id from users WHERE usertype='Admin' ORDER by user_id";
                                            $query_run = mysqli_query($connection, $query);
                                            $row = mysqli_num_rows($query_run);
                                            echo '<h2 class="mb-0 number-font">'.$row.'</h2>';
         
                                            ?>
                                        </div>
                                        <div class="ms-auto">
                                            <div class="chart-wrapper mt-1">
                                                <canvas id="leadschart" class="h-8 w-9 chart-dropshadow"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="mt-2">
                                            <h6 class="">Servers</h6>
                                            <?php
                                            require 'security.php';
                                            $query = "SELECT server_id from servers ORDER by server_id";
                                            $query_run = mysqli_query($connection, $query);
                                            $row = mysqli_num_rows($query_run);
                                            echo '<h2 class="mb-0 number-font">'.$row.'</h2>';
         
                                            ?>
                                        </div>
                                        <div class="ms-auto">
                                            <div class="chart-wrapper mt-1">
                                                <canvas id="profitchart" class="h-8 w-9 chart-dropshadow"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="mt-2">
                                            <h6 class="">Apps Available</h6>
                                            <h2 class="mb-0 number-font">3</h2>
                                        </div>
                                        <div class="ms-auto">
                                            <div class="chart-wrapper mt-1">
                                                <canvas id="costchart" class="h-8 w-9 chart-dropshadow"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ROW-1 END -->
  
            <!-- ROW-4 -->
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Cloud Servers</h3>
                        </div>
                        <div class="card-body pt-4">
                            <div class="grid-margin">
                                <div class="">
                                    <div class="panel panel-primary">
                                        <div class="tab-menu-heading border-0 p-0">
                                            <div class="tabs-menu1">
                                                <!-- Tabs -->
                                                <ul class="nav panel-tabs product-sale">
                                                    <li><a href="#tab5" class="active" data-bs-toggle="tab">All Servers</a></li>
                                                    <li><a href="#tab6" data-bs-toggle="tab" class="text-dark">RHEL</a></li>
                                                    <li><a href="#tab7" data-bs-toggle="tab" class="text-dark">Ubuntu</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="panel-body tabs-menu-body border-0 pt-0">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab5">
                                                <?php
                                        $query = "SELECT * FROM servers";
                                        $query_run = mysqli_query($connection, $query);
                                        ?>
                                                    <div class="table-responsive">
                                                        <table id="data-table" class="table table-bordered text-nowrap mb-0">
                                                            <thead class="border-top">
                                                                <tr>
                                                                    <th class="bg-transparent border-bottom-0" style="width: 5%;">Server ID</th>
                                                                    <th class="bg-transparent border-bottom-0">
                                                                        Server Name</th>
                                                                    <th class="bg-transparent border-bottom-0">
                                                                        IP Address</th>
                                                                    <th class="bg-transparent border-bottom-0">
                                                                        Port</th>
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
                                                <div class="tab-pane" id="tab6">
                                                <?php
                                        $query = "SELECT * FROM servers WHERE server_os='RHEL'";
                                        $query_run = mysqli_query($connection, $query);
                                        ?>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered text-nowrap mb-0">
                                                            <thead class="border-top">
                                                            <tr>
                                                                    <th class="bg-transparent border-bottom-0" style="width: 5%;">Server ID</th>
                                                                    <th class="bg-transparent border-bottom-0">
                                                                        Server Name</th>
                                                                    <th class="bg-transparent border-bottom-0">
                                                                        IP Address</th>
                                                                    <th class="bg-transparent border-bottom-0">
                                                                        Port</th>
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
                                                <div class="tab-pane" id="tab7">
                                                <?php
                                        $query = "SELECT * FROM servers WHERE server_os='Ubuntu'";
                                        $query_run = mysqli_query($connection, $query);
                                        ?>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered text-nowrap mb-0">
                                                            <thead class="border-top">
                                                            <tr>
                                                                    <th class="bg-transparent border-bottom-0" style="width: 5%;">Server ID</th>
                                                                    <th class="bg-transparent border-bottom-0">
                                                                        Server Name</th>
                                                                    <th class="bg-transparent border-bottom-0">
                                                                        IP Address</th>
                                                                    <th class="bg-transparent border-bottom-0">
                                                                        Port</th>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ROW-4 END -->

   
        </div>
        <!-- CONTAINER END -->
    </div>
</div>
<!--app-content close-->





<?php
include('../includes/admin-scripts.php');
include('../includes/footer.php');
?>