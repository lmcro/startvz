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
				file_get_contents($ip);
			}
		}
	}
?>