<?php
	$pageName = 'info plan';
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
			$day = date("N") - 1;

			if (!isset($_GET['id'])) {
				header("location: index.php");	
			} else {
				$_GET['id'];
			}
			$scheduleQuery = "SELECT weekplanner.day AS day, 
								weekplanner.leaving AS leaving, 
								weekplanner.to_id AS to_id, 
								weekplanner.from_id AS from_id, 
								weekplanner.plan_id AS plan_id,
								planner.id AS id
								FROM weekplanner
									JOIN planner ON weekplanner.plan_id=planner.id
								WHERE weekplanner.plan_id=:user_id";
			$scheduleRes = $db->prepare($scheduleQuery);
			$scheduleRes->bindParam(':user_id', $_GET['id']);
			$scheduleRes->execute();

			$locationQuery = "SELECT name FROM location WHERE id = :location_id";
			$locationRes = $db->prepare($locationQuery);

			echo '<ul class="footer_planner_ul">';

			while ($row = $scheduleRes->fetch(PDO::FETCH_ASSOC)) {
				echo '<li class="footer_planner"><h4>'.$days[$row['day']].'</h4>Time: '.$row['leaving'].'<br>';
				// echo $days[$day].", ".$row['leaving'].", ".$row['to_id'].", ".$row['from_id'].", ".$row['plan_id'];
				$locationRes->bindParam(':location_id', $row['from_id']);
				$locationRes->execute();
				
				while ($row2 = $locationRes->fetch(PDO::FETCH_ASSOC)) {
					echo 'From: '.$row2['name'].'<br>';
				}
				
				$locationRes->bindParam(':location_id', $row['to_id']);
				$locationRes->execute();

				while ($row2 = $locationRes->fetch(PDO::FETCH_ASSOC)) {
					echo 'To: '.$row2['name'];
				}
				echo '</li>';
			}

			echo '</ul>';

		?>
		<?php require_once 'inc/footer.php'; ?>
	</body>
</html>