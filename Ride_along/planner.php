<?php
	$pageName = 'Planner';
?>
<!DOCTYPE html>
<html class="no-js" lang="IS_is">
	<head>
		<?php require_once 'inc/head.php'; ?>
	</head>
	<body>
		<?php require_once 'inc/header.php'; ?>
		<?php
			if ($logged === 'out') {
				header('Location: index.php');
			}
			$locationQuery = "SELECT id, lat, location.long AS lon FROM location";
			$locationRes = $db->prepare($locationQuery);
			$locationRes->execute();

			echo '<div style="display: none;">';

			while ($row = $locationRes->fetch(PDO::FETCH_ASSOC)) {
				echo '<span id="location'.$row['id'].'">'.$row['lat'].';'.$row['lon'].'</span>';
			}

			echo '</div>';

			$locationQuery = $locationRes = null;

			if (isset($_POST['submit'])) {
				$plan_id = null;

				if (isset($_POST['plan_name'])) {
					$planner_request = "INSERT INTO planner (plan_name, user_id) VALUES (:plan_name, :user_id)";
					$plannerRes = $db->prepare($planner_request);
					$plannerRes->bindParam(':plan_name', $_POST['plan_name']);
					$plannerRes->bindParam(':user_id',$userID);
					$plannerRes->execute();
					$plannerRes = null;

					$planner_id = "SELECT MAX(id) AS plan_id FROM planner WHERE user_id = :user_id LIMIT 1";
					$plannerIdRes = $db->prepare($planner_id);
					$plannerIdRes->bindParam(':user_id', $userID);
					$plannerIdRes->execute();

					while ($row = $plannerIdRes->fetch(PDO::FETCH_ASSOC)) {
						$plan_id = $row['plan_id'];
					}

					$plannerIdRes = null;
				}

				$insert_request = "INSERT INTO weekplanner (day, leaving, to_id, from_id, plan_id) VALUES (:day, :leaving, :to_id, :from_id, :plan_id)";
				$rideRes = $db->prepare($insert_request);

				if (isset($_POST['dy'])) {
					foreach ($_POST['dy'] as $key => $value) {

						$time = $_POST['day'.$value.'_drop'];
						$from = $_POST['from'.$value];
						$to = $_POST['to'.$value];

						$rideRes->bindParam(':day', $value);
						$rideRes->bindParam(':leaving', $time);
						$rideRes->bindParam(':to_id', $to);
						$rideRes->bindParam(':from_id', $from);
						$rideRes->bindParam(':plan_id', $plan_id);
						$rideRes->execute();
					}
				}

				$rideRes = null;

				echo '<h2>Plan added</h2>';
			} else {
		?>
		<form method="post">
			<div><label>Name of the plan</label><input type="text" name="plan_name" class="plan_name"></div>
			<div class="day_select">
				<ul>
					<?php
						for ($i = 0; $i < count($days); $i++) {
							echo '<li class="li_planner"><input type="checkbox" name="dy[]" id="day'.$i.'" class="day" value="'.$i.'"><label for="day'.$i.'"> '.$days[$i].'</label>';
							echo '<ul id="day'.$i.'_ul" class="day_ul"><li>';
							echo '<label>Time</label><input type="text" name="day'.$i.'_drop" class="day_drop"><label>Nearest Location</label><select value="'.$i.'" name="from'.$i.'" id="from'.$i.'" class="request_location"><option value="-1" disabled selected>Pick</option>';

							$query = "SELECT id, name FROM location ORDER BY name ASC";
							$res = $db->prepare($query);
							$res->execute();

							while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
								echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
							}

							echo '</select><label>Location of dropoff</label>';
							echo '<select name="to'.$i.'" id="to'.$i.'" class="request_location"><option value="-1" disabled selected>Pick</option>';

							$res->execute();

							while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
								echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
							}

							$res = null;

							echo '</select><iframe width="100%" height="300" frameborder="0" style="border:0"
									src="" id="map'.$i.'"
									allowfullscreen></iframe>';
							echo '</li></ul></li>';
						}
					?>
				</ul>
			</div>
			<div>
				<input type="submit" name="submit" class="plan_submit">
			</div>
		</form>
		<?php
			}
		?>
		<?php require_once 'inc/footer.php'; ?>
		<script type="text/javascript">
			let red = '#E6393C';
			let green = '#92E639';

			for (var i = 0; i < 7; i++) {
				$("#day"+[i]+"_ul").hide();
				$('.day').next().css('background-color', red);
			}

			$('.day').on('click', function() {
				if ($(this).is(":checked")) {
		 			$(this).nextAll('.day_ul').show();
		 			$(this).next().css('background-color', green);
		 			//$('.li_planner').css('background-color','#E6393C');
				}
				else {
					$(this).nextAll('.day_ul').hide();
		 			$(this).next().css('background-color', red);
				}
			});

			$('iframe').attr('src', 'https://www.google.com/maps/embed/v1/directions?key=AIzaSyC32v6xptkwqC_dhbKPWtsIrc4C1RX7Chs&origin=Oslo+Norway&destination=Telemark+Norway');

			$('select').on('change', function() {
				for (var i = 0; i < 7; i++) {
					if ($('#from' + i).children(':selected').val() != '-1' && $('#to' + i).children(':selected').val() != '-1') {
						let fromId = $('#from' + i).val();
						let fromLat = $('#location' + fromId).text().split(';')[0];
						let fromLong = $('#location' + fromId).text().split(';')[1];

						let toId = $('#to' + i).val();
						let toLat = $('#location' + toId).text().split(';')[0];
						let toLong = $('#location' + toId).text().split(';')[1];

						console.log(fromId + ',' + fromLat + ',' + fromLong);

						$('#map' + i).attr('src', 'https://www.google.com/maps/embed/v1/directions?key=AIzaSyC32v6xptkwqC_dhbKPWtsIrc4C1RX7Chs&' +
							'origin=' + fromLat + ',' + fromLong +
							'&destination=' + toLat + ',' + toLong);
					}
				}
			});

			// https://www.google.com/maps/embed/v1/directions
			//   ?key=AIzaSyAGo8wWQeVgZk7so5t2FAJMUYnmB9zY2rw
			//   &origin=Oslo+Norway
			//   &destination=Telemark+Norway
			//   &avoid=tolls|highways
		</script>
	</body>
</html>