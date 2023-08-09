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
                        <li class="breadcrumb-item active" aria-current="page">Server Apps</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

                       <!-- ROW-2 OPEN -->
                       <div class="row">
                            <div class="col-xl-4 col-md-6">
                            <div class="card text-center">
                                    <div class="card-body">

                                    
                                        <h5 class="card-title">VPN Server</h5>
                                        <p class="card-text">Turn your server into a VPN server!</p>
                                        <input type="hidden" name="utilityserver_id" value="<?php echo $server_id?>">
                                        <button type="button" class="btn btn-primary" name="configure-vpnserver" data-bs-toggle="modal" data-bs-target="#vpnserver">Configure</a>
                                    </div>
                                </div>
                            </div>
                            <!-- COL END -->
                            <div class="col-xl-4 col-md-6">
                            <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">RDP Server (XFCE)</h5>
                                        <p class="card-text">Get RDP for your Linux server, connect it from your Windows PC easily!</p>
                                        <form action="functions.php" method="POST">
  <input type="hidden" name="rdp_serverid" value="<?php echo $server_id?>">
  <button type="submit" class="btn btn-primary" name="installrdpbtn" id="configure-button">Configure</button>
  <div id="loading-overlay" class="loading-overlay" style="display:none">
    <div class="loading-icon"></div>
    <div class="loading-text-box">
    <div class="loading-text">RDP is being installed, this can take long time as GUI modules are being installed. Do not refresh this page.</div>
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
                                        <h5 class="card-title">FTP Server</h5>
                                        <p class="card-text">Install FTP server, and add new users to access the server files</p>
                                        <input type="hidden" name="ftpserver_id" value="<?php echo $server_id?>">
                                        <button type="button" class="btn btn-primary" name="configure-ftpserver" data-bs-toggle="modal" data-bs-target="#ftpserver">Configure</a>
                                    </div>
                                </div>
                            </div>
                            <!-- COL END -->
                            <div class="col-xl-4 col-md-6">
                            <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">WordPress (FYP 2)</h5>
                                        <p class="card-text">Deploy the WordPress application using one-click</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                            <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">Static Website (FYP 2)</h5>
                                        <p class="card-text">This will allow you to host static sites </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">(FYP 2)</h5>
                                        <p class="card-text">A new app for FYP 2</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ROW-2 CLOSED -->

                                                  <!-- VPN Server modal -->
                                                  <div class="modal fade" id="vpnserver" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Configure VPN Server</h6>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">
                <p>If you are configuring it for first time, it can take time to install the VPN server, please wait and do not leave this page! </p>
                <p>After user has been created, you will be redirected to download the VPN file. Just import this into your OpenVPN Community Software to use VPN </p>
                    <form action="functions.php" method="POST">

                      <div class="mb-3">
                        <label for="vpnusername" class="col-form-label">Username:</label>
                        <input type="text" class="form-control" name="vpn-username" required>
                      </div>
                    
                                                <div class="modal-footer">
                    <input type="hidden" name="utility_serverid" value="<?php echo $server_id; ?>">
                    <button class="btn ripple btn-success" name="addvpnuserbtn" type="submit">Add</button>
                    <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Close</button>
                </div>
                      </div>
                    </form>
                  </div>
            </div>
        </div>
    </div>
    <!-- End VPN Server modal -->


                                                  <!-- FTP Server modal -->
                                                  <div class="modal fade" id="ftpserver" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Configure FTP Server</h6>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">
                <p>If you are configuring it for first time, it can take time to install the FTP server, please wait and do not leave this page! </p>
                <p>After user has been created, you can access the FTP server using applications like FileZilla, please use server IP as your Host, username and password which you have set below. </p>
                    <form action="functions.php" method="POST">

                      <div class="mb-3">
                        <label for="ftp_username" class="col-form-label">FTP Username:</label>
                        <input type="text" class="form-control" name="ftp-username" required>
                      </div>
                      <div class="mb-3">
                        <label for="ftp_password" class="col-form-label">FTP Password:</label>
                        <input type="text" class="form-control" name="ftp-password" required>
                      </div>
                      <div class="mb-3">
                        <label for="ftp_directory" class="col-form-label">FTP Home Directory:</label>
                        <input type="text" class="form-control" name="ftp-directory" required>
                        <p>Example of FTP directory format, /home/user, /var/www/html, etc.</p>
                      </div>
                                                <div class="modal-footer">
                    <input type="hidden" name="utility_serverid" value="<?php echo $server_id; ?>">
                    <button class="btn ripple btn-success" name="addftpuserbtn" type="submit">Add</button>
                    <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Close</button>
                </div>
                      </div>
                    </form>
                  </div>
            </div>
        </div>
    </div>
    <!-- End VPN Server modal -->




<?php
include('includes/scripts.php');
include('includes/footer.php');
?>