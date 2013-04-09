<div class="nav-collapse">
			<ul id="main-nav" class="nav pull-right">
				<!--<li class="nav-icon">
					<a href="index.html">
						<i class="icon-home"></i>
						<span>Home</span>
					</a>
				</li>-->
				<li class="dropdown">					
					<a href="index.php" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-home"></i>
						<span>Home</span> 
						<b class="caret"></b>
					</a>	
				
					<ul class="dropdown-menu">
                    	<li><a href="index.php">Dashboard</a></li>
						<li><a href="settings.php">Settings</a></li>
						<?php error_reporting(0); if($_SESSION['admin']) { echo '<li><a href="admin.php">Admin</a></li>'; } ?>
					</ul>    				
				</li>
				
				<li class="dropdown">					
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-th"></i>
						<span>Virtual Server</span> 
						<b class="caret"></b>
					</a>	
				
					<ul class="dropdown-menu">
						<li><a href="vserver.php">VPS List</a></li>
					</ul>    				
				</li>
			</ul>
			
		</div> <!-- /.nav-collapse -->
