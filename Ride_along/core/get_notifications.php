<?php
	if (isset($_POST['user_id'])) {
		require_once 'db_connect.php';

		$data = array();
		$userID = $_POST['user_id'];

		$notificationQuery = "SELECT title, message, sent FROM notifications WHERE user_id=:user_id AND seen=0";
		$notificationRes = $db->prepare($notificationQuery);
		$notificationRes->bindParam(':user_id', $userID);
		$notificationRes->execute();

		while ($row = $notificationRes->fetch(PDO::FETCH_ASSOC)) {
			$data[] = array('title' => $row['title'], 'message' => $row['message'], 'sent' => $row['sent']);
		}

		$notificationQuery = $notificationRes = null;

		echo json_encode($data);
	}
?>