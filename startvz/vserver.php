<?php session_start(); require_once('inc/config.php');
if(!isset($_SESSION['logged_in'])) {
	header('Location: login.php');	
}
// Load header
require_once('template/header.tpl');
?>
<body>
	
<div id="wrapper">
	
<?php require_once('template/topbar.tpl'); ?>
	
	
<div id="header">
	
	<div class="container">
		
		<a href="index.php" class="brand">Dashboard</a>
		
		<a href="javascript:;" class="btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        	<i class="icon-reorder"></i>
      	</a>
	
		<?php require_once('template/highmenu.tpl'); ?>
	</div> <!-- /.container -->
	
</div> <!-- /#header -->




<div id="masthead">
	
	<div class="container">
		
		<div class="masthead-pad">
			
			<div class="masthead-text">
				<h2>Dashboard</h2>
				<p><?php  $query = $db->query('SELECT * FROM virtual_servers WHERE `ownership`="'.$_SESSION['username'].'"'); if($query->rowCount() == 0) { echo 'You currently have <b>0</b> virtual servers.'; } else { echo 'You currently have <b>'.$query->rowCount().'</b> virtual servers.'; }?></p>
			</div> <!-- /.masthead-text -->
			
		</div>
		
	</div> <!-- /.container -->	
	
</div> <!-- /#masthead -->




<div id="content">

	<div class="container">
		
		<div class="row">
			
			<div class="span4">
				<h3>Welcome back, <?php echo $_SESSION['username']; ?>.</h3>
				
				<p></p>
				
				<table class="table stat-table">
					<tbody>
						<tr>
							<td class="value"><?php $query = $db->query('SELECT * FROM virtual_servers'); echo $query->rowCount(); ?></td>
							<td class="full">Total Virtual Servers deployed.</td>
						</tr>
					</tbody>
				</table>
			</div> <!-- /.span4 -->
			
			<div class="span8">
				<?php
					$query = $db->query('SELECT * FROM virtual_servers WHERE `ownership`="'.$_SESSION['username'].'"');
					if($query->rowCount()==0) {
						echo 'No Virtual Servers found.';	
						$vservers_found = false;
					} else {
						$vservers_found = true;	
					}
					
					if($vservers_found==true) {
						$view = $_GET['view']; error_reporting(1);
						if(isset($view)) {
							// View Virtual Server
							$id = mysql_real_escape_string($view);
							// Did the user tell us a empty VSERVER ID or tried something fancy?
							if(empty($view)) {
								echo 'Unknown server.';
								exit;	
							}
							$them = $_SESSION['username'];
							$query = $db->query('SELECT * FROM virtual_servers WHERE `id`="'.$view.'" AND `ownership`="'.$them.'" LIMIT 1');
							if($query->rowCount() == 0) {
								echo 'It appears you do not own this virtual server <b>or</b> the virtual server does not exist.';
								exit;	
							}
							// Assumes it all checks out
							?>
                            <table class="table table-bordered table-striped table-highlight">
						        <thead>
						          <tr>
						            <th>#</th>
						            <th>Hostname</th>
						            <th>Main IP</th>
                                    <th>Additional IPs</th>
                                    <th>VT</th>
                                    <th>Disk Space</th>
                                    <th>Ram</th>
						          </tr>
						        </thead>
                                <tbody>
                                <?php 
									foreach($query as $row) { $node = $row['node'];
										$container = $row['container_id'];
										?>
                                        	<tr>
                                            	<td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['hostname']; $hostname = $row['hostname']; ?></td>
                                                <td><?php echo $row['main_ip']; ?></td>
                                                <td><?php echo $row['additional_ips']; ?></td>
                                                <td><?php echo $row['virt_type']; ?></td>
                                                <td><?php $space = $row['diskspace']; echo $space.' GB'; ?></td>
                                                <td><?php $ram = $row['ram']; echo $ram; echo ' MB'; ?></td>
                                            </tr>
                                        <?php
									}
								?>
                                </tbody>
                                </table>
                                <br>
                                <!-- options -->
                                <?php 
									$sub = mysql_real_escape_string($_GET['sub']);
									$option = mysql_real_escape_string($_GET['option']); // used in power
									if(isset($sub)) {
										require_once('inc/command.php');
										$command = new Command;
										if($sub=='edit_hostname') {
												if($_POST['submit']) {
													$new_hostname = mysql_real_escape_string($_POST['hostname']);
													// Check if hostname same, if yes, then ignore change, if not  the same, then update
													if($hostname==$new_hostname) {
														echo 'Hostname could not be updated. Reason: the old hostname is the same as the new one.';	
													} else {
														// Update in DB
															$db->query("UPDATE `virtual_servers` SET `hostname`='".$new_hostname."' WHERE `id`='".$view."'");
														// Send command to server	
															$command->sendCommandToServer($node, $container, 'hostname', $new_hostname);
														
														echo 'Updated hostname.';
													}
												} else { 
													?>
														<form action="?view=<?php echo $view; ?>&sub=edit_hostname" method="POST">
															Hostname: <input type='text' name='hostname' value='<?php echo $hostname; ?>'><br>
                                                            <input class="btn" name="submit" value="Update">
														</form>
													<?php
												}
											} elseif($sub=='power') {
												if($option=='boot') {
													$command->sendCommandToServer($node, $container, 'power', 'boot');
													echo 'Boot in progress.';
												} elseif($option=='reboot') {
													$command->sendCommandToServer($node, $container, 'power', 'reboot');
													echo 'Reboot in progress.';
												} elseif($option=='shutdown') {
													$command->sendCommandToServer($node, $container, 'power', 'shutdown');
													echo 'Shutting down.';
												} else {
													echo 'Unknown option.';	
												}
											} 
									}
								?>
                                <table class="table table-bordered table-striped table-highlight">
						        <thead>
						          <tr>
						            <th>Options</th>
						          </tr>
						        </thead>
                                <tbody>
                                	<tr>
                                    	<td><a href="?view=<?php echo $view; ?>&sub=edit_hostname"><button class="btn">Edit Hostname</button></a> <a href="?view=<?php echo $view; ?>&sub=power&option=boot"><button class="btn btn-green">Boot</button></a> <a href="?view=<?php echo $view; ?>&subpower&option=reboot"><button class="btn btn-blue">Reboot</button></a> <a href="?view=<?php echo $view; ?>&sub=power&option=shutdown"><button class="btn btn-red">Shutdown</button></a></td>
                                    </tr>
                                </tbody>
                                </table>
                            <?php
						} else {
							?>
                            <table class="table table-bordered table-striped table-highlight">
						        <thead>
						          <tr>
						            <th>#</th>
						            <th>Hostname</th>
						            <th>Actions</th>
						          </tr>
						        </thead>
                                <tbody>
                            <?php
							// List Virtual Servers
							foreach($query as $row) {
								?>
                                <tr>
						            <td><?php echo $row['id']; ?></td>
						            <td><?php echo $row['hostname']; ?></td>
						            <td><a href="?view=<?php echo $row['id']; ?>"><button class="btn">View/Manage</button></a></td>
						          </tr>
                                <?php
							}
							?></tbody></table><?php
						}
					} else {
						echo '<br>If you believe this is an error, please contact your systems administrator.';	
					}
				?>
			</div> <!-- /.span8 -->
			
		</div> <!-- /.row -->
		
	</div> <!-- /.container -->

</div> <!-- /#content -->

</div> <!-- /#wrapper -->




<?php
require_once('template/footer.tpl');
?>