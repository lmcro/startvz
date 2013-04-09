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
				<?php require_once('template/content_home.tpl'); ?>
                <!--<div id="line-chart" class="chart-holder"></div> /#bar-chart -->
			</div> <!-- /.span8 -->
			
		</div> <!-- /.row -->
		
	</div> <!-- /.container -->

</div> <!-- /#content -->

</div> <!-- /#wrapper -->




<?php
require_once('template/footer.tpl');
?>