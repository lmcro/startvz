<?php session_start(); require_once('inc/config.php');
// Load header
require_once('template/header.tpl'); error_reporting(0);
if($_SESSION['logged_in']) {
	header('Location: index.php');
}
?>
<body class="login">



<div class="account-container login stacked">
	
	<div class="content clearfix">
		
		<form action="login.php" method="post">
		
			<h1>Sign In</h1>		
			
			<?php
				if(isset($_POST['submit'])) {
					$user = $_POST['username'];
					$pass = md5($_POST['password']);
					$query = $db->query('SELECT * FROM vps_users WHERE `username`="'.$user.'"');
					if($query->rowCount() == 0) {
						echo 'The Username you submitted is not valid.';
					}
					foreach($query as $row) {
						if($user==$row['username']&&$pass==$row['password']) {
							$_SESSION['logged_in']='yes';
							$_SESSION['loggedin']='yes';
							$_SESSION['username']=$user;
							echo '<b>Logged in successfully. <a href="index.php">Home</a></b>';	
						} else {
							echo 'The <b>password</b> you supplied is incorrect. Please, <a href="login.php">try again</a>.';	
						}
					}
				} else {
					?>
                    <div class="login-fields">
				
				<p>Sign in using your registered account:</p>
				
				<div class="field">
					<label for="username">Username:</label>
					<input type="text" id="username" name="username" value="" placeholder="Username" class="login username-field" />
				</div> <!-- /field -->
				
				<div class="field">
					<label for="password">Password:</label>
					<input type="password" id="password" name="password" value="" placeholder="Password" class="login password-field"/>
				</div> <!-- /password -->
				
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<span class="login-checkbox">
					<input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
					<label class="choice" for="Field">Keep me signed in</label>
				</span>
									
				<input type="submit" name="submit" value="Login" class="button btn btn-primary btn-large">
				
			</div> <!-- .actions -->
			
			<div class="login-social">
				<p>Sign in using social network:</p>
				
				<div class="twitter">
					<a href="#DISABLED" class="btn_1">Login with Twitter</a>				
				</div>
				
				<div class="fb">
					<a href="#DISABLED" class="btn_2">Login with Facebook</a>				
				</div>
			</div>
                    <?php	
				}
			?>
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->


<!-- Text Under Box -->
<div class="login-extra">
	Don't have an account? <a href="signup.html">Sign Up</a><br/>
	Remind <a href="#">Password</a>
</div> <!-- /login-extra -->



<?php
require_once('template/footer.tpl');
?>