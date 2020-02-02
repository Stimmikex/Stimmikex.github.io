<?php
	$pageName = 'match';
?>
<!DOCTYPE html>
<html class="no-js" lang="IS_is">
	<head>
		<?php require_once 'inc/head.php'; ?>
	</head>
	<body>
		<?php require_once 'inc/header.php'; ?>
		
		<?php
			if ($logged === "out") {
				header('Location: index.php');
			}
			$SelectQuery = "SELECT title, message, sent, from_user_id FROM notifications WHERE seen = 0 AND user_id = :user_id";
			$SelectRes = $db->prepare($SelectQuery);
			$SelectRes->bindParam(':user_id', $userID);
			$SelectRes->execute();

			while ($row = $SelectRes->fetch(PDO::FETCH_ASSOC)) {
				if ($row['from_user_id'] != "") {
					$userQuery = "SELECT oauth_uid, fname, picture FROM users WHERE id = :user_id";
					$userRes = $db->prepare($userQuery);
					$userRes->bindParam(':user_id', $row['from_user_id']);
					$userRes->execute();

					while ($row2 = $userRes->fetch(PDO::FETCH_ASSOC)) {
						echo $row2['fname'].'<br> ';
						echo '<img src="http://graph.facebook.com/'.$row2['oauth_uid'].'/picture?width=300" class="match_img">';
						echo '<input type="button" name="yes" value="Yes">';
						echo '<input type="button" name="no" value="No">';
					}
				}
			}
		?>

		<?php require_once 'inc/footer.php'; ?>
	</body>
</html>