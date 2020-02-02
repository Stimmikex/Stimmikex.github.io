<?php
	$pageName = 'Notification';
?>
<!DOCTYPE html>
<html class="no-js" lang="IS_is">
	<head>
		<?php require_once 'inc/head.php'; ?>
	</head>
	<body>
		<?php require_once 'inc/header.php'; ?>
		<?php
			if ($logged === 'out' || !isset($_GET['nid'])) {
				header('Location: notifications.php');
			} else {
				if (!$nid = filter_input(INPUT_GET, 'nid', FILTER_VALIDATE_INT)) {
					header('Location: notifications.php');
				}

				$updateQuery = "UPDATE notifications SET seen=1 WHERE id=:nid AND user_id=:user_id";
				$updateRes = $db->prepare($updateQuery);
				$updateRes->bindParam(':nid', $nid);
				$updateRes->bindParam(':user_id', $userID);
				$updateRes->execute();
				$updateQuery = $updateRes = null;

				$notificationQuery = "SELECT title, message, sent, from_user_id, matched, action_taken FROM notifications WHERE id=:nid AND user_id=:user_id LIMIT 1";
				$notificationRes = $db->prepare($notificationQuery);
				$notificationRes->bindParam(':nid', $nid);
				$notificationRes->bindParam(':user_id', $userID);
				$notificationRes->execute();

				if ($notificationRes->rowCount() === 0) {
					echo '<h3>The notification with this ID was not found or it\'s not yours</h3>';
				} else {
					while ($row = $notificationRes->fetch(PDO::FETCH_ASSOC)) {
						echo '<div id="nid" style="display:none;">'.$nid.'</div>';

						$rideAccepted = FALSE;

						if ($row['from_user_id'] != '') {
							$rideAccepted = TRUE;
							$fromFName = null;
							$fromLName = null;
							$fromPicture = null;

							$userQuery = "SELECT fname, lname, oauth_uid FROM users WHERE id=:uid LIMIT 1";
							$userRes = $db->prepare($userQuery);
							$userRes->bindParam(':uid', $row['from_user_id']);
							$userRes->execute();

							while ($row2 = $userRes->fetch(PDO::FETCH_ASSOC)) {
								$fromFName = $row2['fname'];
								$fromLName = $row2['lname'];
								$fromPicture = 'http://graph.facebook.com/'.$row2['oauth_uid'].'/picture?width=300';
							}

							$userQuery = $userRes = null;

							echo '<div id="request_user_id" style="display:none;">'.$row['from_user_id'].'</div>';
						}

						echo '<h3>'.$row['title'].'</h3>';
						echo '<p><b>Message:</b> '.$row['message'].'</p>';

						if ($rideAccepted) {
							echo '<h4>'.$fromFName.' '.$fromLName.'</h4>';
							echo '<img src="'.$fromPicture.'" class="match_img">';

							if ($row['matched'] != '1' && $row['action_taken'] == '0') {
								echo '<div class="btn_div">';
								echo '<input type="button" name="yes" value="Yes" class="accept_btn">';
								echo '<input type="button" name="no" value="No" class="accept_btn">';
								echo '</div>';
							}
						}

						echo '<p><b>Sent:</b> '.$row['sent'].'</p>';
					}
				}

				$notificationQuery = $notificationRes = null;
			}
		?>
		<div class="info"></div>
		<?php require_once 'inc/footer.php'; ?>
		<script type="text/javascript">
			$(function() {
				$('.accept_btn').on('click', function() {
					if ($(this).val() == 'Yes') {
						$.ajax({
							method: 'POST',
							url: 'core/send_notification.php',
							data: {
									title: 'Ride offer accepted',
									message: 'Your ride offer has been accepted by the person shown below.',
									from_user_id: $('#user_id_div').text(),
									to_user_id: $('#request_user_id').text(),
									matched: 1,
									response_from: $('#nid').text()
								}
						}).done(function() {
							$('.info').html('<h4>The user you accepted has been notified.</h4>');
							$('.btn_div').html('');
						});
					}
				});
			});
		</script>
	</body>
</html>