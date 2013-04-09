<div id="topbar">
	
	<div class="container">
		
		<a href="javascript:;" id="menu-trigger" class="dropdown-toggle" data-toggle="dropdown" data-target="#">
			<i class="icon-cog"></i>
		</a>
	
		<div id="top-nav">
			
			<ul>
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						View Options				
						<b class="caret"></b>
					</a>
					
					<ul class="dropdown-menu pull-right">
						<li><a href="logout.php">Logout</a></li>
						<?php if(isset($_SESSION['admin'])) { echo '<li><a href="admin.php">Admin</a></li>'; } ?>
					</ul> 
				</li>
			</ul>
			
			<ul class="pull-right">
				<li><a href="javascript:;"><i class="icon-user"></i> Logged in as <?php echo $_SESSION['username']; ?></a></li>
				<li class="dropdown">
					<a href="settings.php" class="dropdown-toggle" data-toggle="dropdown">
						Settings						
						<b class="caret"></b>
					</a>
					
					<ul class="dropdown-menu pull-right">
						<li><a href="settings.php">General Settings</a></li>
					</ul> 
				</li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
			
		</div> <!-- /#top-nav -->
		
	</div> <!-- /.container -->
	
</div> <!-- /#topbar -->

