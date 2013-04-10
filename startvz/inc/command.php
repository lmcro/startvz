<?php
	class Command {
		public function sendCommandToServer($node, $container_id, $action, $value) {
			require_once('inc/config.php');
			$query = $db->query('SELECT * FROM nodes WHERE `name`="'.$node.'" LIMIT 1');
			if($query->rowCount() == 0) {
				echo 'Node not found.';
				exit;	
			} else {
				// node found
				foreach($query as $row) {
					$api_key = $row['api_key'];
					$ip = 'http://'.$row['ip'].'/api.php?key='.$api_key.'&container='.$container.'&action='.$action.'&new_value='.$value;
				}
				$contents = file_get_contents($ip);
				if(stristr('error',$contents)) {
					$has_error = true;
				} else {
					$has_error = false;	
				}
				
				if($has_error==true) {
					echo 'An error occured when sending command to node. Please contact the system administrator to get this issue resolved.';
					exit;	
				}
			}
		}
	}
?>