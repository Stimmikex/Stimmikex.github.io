<?php
	$pageName = 'Schedule';
?>
<!DOCTYPE html>
<html class="no-js" lang="IS_is">
	<head>
		<?php require_once 'inc/head.php'; ?>
	</head>
	<body>
		<?php require_once 'inc/header.php'; ?>
		<div class="week_table">
			<?php
				if ($logged === "out") {
					header('Location: index.php');
				}
				$day = date("N") - 1;

				for ($i=0; $i < count($days); $i++) { 
					$scheduleQuery = "SELECT weekplanner.day AS day, 
									weekplanner.leaving AS leaving, 
									weekplanner.to_id AS to_id, 
									weekplanner.from_id AS from_id, 
									weekplanner.plan_id AS plan_id,
									planner.id AS id
									FROM weekplanner
										JOIN planner ON weekplanner.plan_id=planner.id
									WHERE planner.user_id=:user_id AND weekplanner.day =:day
										ORDER BY  day";
					$scheduleRes = $db->prepare($scheduleQuery);
					$scheduleRes->bindParam(':day', $i);
					$scheduleRes->bindParam(':user_id', $userID);
					$scheduleRes->execute();

					$locationQuery = "SELECT name FROM location WHERE id = :location_id";
					$locationRes = $db->prepare($locationQuery);

					echo '<ul class="schedule_ul">';
					echo '<h4>'.$days[$i].'</h4>';

					while ($row = $scheduleRes->fetch(PDO::FETCH_ASSOC)) {
						// echo '<h4>'.$days[$row['day']].'</h4>';
						echo '<li class="schedule">Time: '.$row['leaving'].'<br>';
						// echo $days[$day].", ".$row['leaving'].", ".$row['to_id'].", ".$row['from_id'].", ".$row['plan_id'];
						$locationRes->bindParam(':location_id', $row['from_id']);
						$locationRes->execute();
						
						while ($row2 = $locationRes->fetch(PDO::FETCH_ASSOC)) {
							echo 'From: '.$row2['name'].'<br>';
						}
						
						$locationRes->bindParam(':location_id', $row['to_id']);
						$locationRes->execute();

						while ($row2 = $locationRes->fetch(PDO::FETCH_ASSOC)) {
							echo 'To: '.$row2['name'].'<br>';
						}
						echo '</li>';
					}

					echo '</ul>';
				}

			?>
		</div>
		<?php require_once 'inc/footer.php'; ?>
	</body>
</html>