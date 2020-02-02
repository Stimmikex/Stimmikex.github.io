<?php
	if (isset($_POST['title'], $_POST['message'], $_POST['from_user_id'], $_POST['to_user_id'])) {
		require_once 'db_connect.php';

		$matched = NULL;
		$response = FALSE;

		if (isset($_POST['matched'])) {
			if ($_POST['matched'] === '1') {
				$matched = 1;
			}
		}

		if (isset($_POST['response_from'])) {
			$response = $_POST['response_from'];

			$updateQuery = "UPDATE notifications SET action_taken=1 WHERE id=:nid";
			$updateRes = $db->prepare($updateQuery);
			$updateRes->bindParam(':nid', $response);
			$updateRes->execute();
			$updateQuery = $updateRes = null;
		}

		$toUserID = filter_input(INPUT_POST, 'to_user_id', FILTER_VALIDATE_INT);
		$fromUserID = filter_input(INPUT_POST, 'from_user_id', FILTER_VALIDATE_INT);
		$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
		$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

		$insertQuery = "INSERT INTO notifications (user_id, title, message, from_user_id, matched) VALUES (:to_user_id, :title, :message, :from_user_id, :matched)";
		$insertRes = $db->prepare($insertQuery);
		$insertRes->bindParam(':to_user_id', $toUserID);
		$insertRes->bindParam(':title', $title);
		$insertRes->bindParam(':message', $message);
		$insertRes->bindParam(':from_user_id', $fromUserID);
		$insertRes->bindParam(':matched', $matched);
		$insertRes->execute();
		$insertQuery = $insertRes = null;
	}
?>