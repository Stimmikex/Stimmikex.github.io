<?php
	$pageName = 'Profile';
?>
<!DOCTYPE html>
<html class="no-js" lang="IS_is">
	<head>
		<?php require_once 'inc/head.php'; ?>
	</head>
	<body>
		<?php require_once 'inc/header.php'; ?>
		<?php
			$output = null;

			/*$userQuery = "SELECT fname, lname, oauth_uid FROM users WHERE id=:uid LIMIT 1";
			$userRes = $db->prepare($userQuery);
			$userRes->bindParam(':uid', $_SESSION['user_id']);
			$userRes->execute();

			while ($row = $userRes->fetch(PDO::FETCH_ASSOC)) {
				$fromPicture = 'http://graph.facebook.com/'.$row['oauth_uid'].'/picture?width=300';
			}*/
			if ($logged === 'in') {
				$output = '<p>Name: ' . $user_data['fname'].' '.$user_data['lname'].'</p>';
				$output .= '<p>Email: ' . $user_data['email'].'</p>';
			}else{
				$output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
			}
		?>
		<div class="pro_info">
			<?php
				echo '<h1>Profile</h1>';
				echo '<div class="profile_img_main">';
					echo '<div class="profile_img_big"><img src="'.$user_data['picture'].'">';
					echo '<p class="profile_name">'.$user_data['fname'].' '.$user_data['lname'].'</p></div>';
				echo '</div>';
				echo $output;
			?>
			<p>Rating: </p>
		</div>
		<h2>Get a Ride Controlls</h2>
		<div class="pro_icons">
			<a href="notifications.php" class="pro_note"><img src="img/icons/notification.png">Notifications <span class="notification_count"></span></a>
			<a href="delete_plan.php" class="pro_del"><img src="img/icons/delete.png">Delete Plans</a>
			<a href="schedule.php" class="pro_sch"><img src="img/icons/schedule.png">Schedule</a>
		</div>
		<h2>Carpooling Info</h2>
		<div class="pro_icons">
			<a href="#" class="pro_driver"><img src="img/icons/driver_icon.png">Driver Info</a>
			<a href="#" class="pro_pass"><img src="img/icons/passanger_icon.png">Passanger Info</a>
		</div>
		<?php
			} else {
				header('Location: index.php');
			}
		?>
		<?php require_once 'inc/footer.php'; ?>
	</body>
</html>