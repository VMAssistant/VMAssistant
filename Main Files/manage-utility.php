<?php
include('security.php');

if(isset($_POST['utilityserver_id'])){
    $server_id = $_POST['utilityserver_id'];
    // If server_id is present, proceed with the page
    // rest of your code
}
elseif(isset($_GET['utilityserver_id'])){
    $server_id = $_GET['utilityserver_id'];
    // If server_id is present, proceed with the page
    // rest of your code
}else{
    // If server_id is not present, redirect to utility page
    header("Location: utilities.php");
    exit;
}

include('includes/header.php');
include('includes/navbar.php');
include 'connection.php';

if(isset($_POST['utility-serverbtn'])){
    $server_id = $_POST['utilityserver_id'];
}

// Execute the command to get server load
$stream = ssh2_exec($server_connection, 'uptime | grep "load average:"');
stream_set_blocking($stream, true);
$load = stream_get_contents($stream);
fclose($stream);

// display the uptime and load on your PHP page
//echo "Server Uptime: " . $uptime;
//echo "Server Load: " . $load;


?>




<!--app-content open-->
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title"><?php echo $load; ?></h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Server Utilities</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

                       <!-- ROW-2 OPEN -->
                       <div class="row">
                            <div class="col-xl-4 col-md-6">
                            <div class="card text-center">
                                    <div class="card-body">

                                    
                                        <h5 class="card-title">Update Server Packages</h5>
                                        <p class="card-text">Keep your server up to date, with the latest packages!</p>
                                        <form action="functions.php" method="POST">
  <input type="hidden" name="utilityserver_id" value="<?php echo $server_id?>">
  <button type="submit" class="btn btn-primary" name="update-serverpackages" id="configure-button">Configure</button>
  <div id="loading-overlay" class="loading-overlay" style="display:none">
    <div class="loading-icon"></div>
    <div class="loading-text-box">
    <div class="loading-text">Server is being updated. This can take time. Do not refresh this page</div>
</div>

</div>

</form>


                                    </div>
                                </div>
                            </div>
                            <!-- COL END -->
                            <div class="col-xl-4 col-md-6">
                            <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">Reboot Server</h5>
                                        <p class="card-text">Perform the complete reboot of the cloud server</p>
                                        <form action="functions.php" method="POST">
  <input type="hidden" name="utilityserver_id" value="<?php echo $server_id?>">
  <button type="submit" class="btn btn-primary" name="reboot-server" id="configure-button">Configure</button>
  <div id="loading-overlay" class="loading-overlay" style="display:none">
    <div class="loading-icon"></div>
    <div class="loading-text-box">
    <div class="loading-text">Server is rebooting.</div>
</div>

</div>

</form>
                                    </div>
                                </div>
                            </div>
                            <!-- COL END -->
                            <div class="col-xl-4 col-md-6">
                            <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">Speed test</h5>
                                        <p class="card-text">Perform a speed test of your server to monitor the network performance</p>
                                        <form action="functions.php" method="POST">
  <input type="hidden" name="utilityserver_id" value="<?php echo $server_id?>">
  <button type="submit" class="btn btn-primary" name="server-speedtest" id="configure-button">Configure</button>
  <div id="loading-overlay" class="loading-overlay" style="display:none">
    <div class="loading-icon"></div>
    <div class="loading-text-box">
    <div class="loading-text">Performing a speed test of the server - please do not refresh</div>
</div>

</div>

</form>
                                    </div>
                                </div>
                            </div>
                            <!-- COL END -->
                            <div class="col-xl-4 col-md-6">
                            <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">Firewall (Attack Mode) (FYP 2 Final)</h5>
                                        <p class="card-text">Are you under attack? Use this mode to mitigate the attacks!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                            <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">Firewall (Normal Mode) (FYP 2 Final)</h5>
                                        <p class="card-text">Use this normal mode if you are not facing any attacks!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">Change SSH Port (FYP 2 Final)</h5>
                                        <p class="card-text">Change to the valid custom port to prevent attacks!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ROW-2 CLOSED -->







<?php
include('includes/scripts.php');
include('includes/footer.php');
?>