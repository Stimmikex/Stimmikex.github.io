</div>
<footer>
	<div class="top-footer flex-container">
		<div class="col-1-2 footer-padding">
			<div id="dgi">
			</div>
		</div>
		<div class="col-1-2 flex-container footer-padding">
			<div class="col-1-2">
				<?php
					$day = date("N") - 1;


					$scheduleQuery = "SELECT weekplanner.day AS day, 
										weekplanner.leaving AS leaving, 
										weekplanner.to_id AS to_id, 
										weekplanner.from_id AS from_id, 
										weekplanner.plan_id AS plan_id,
										planner.id AS id
										FROM weekplanner
											JOIN planner ON weekplanner.plan_id=planner.id
										WHERE weekplanner.day = :day AND planner.user_id=:user_id";
					$scheduleRes = $db->prepare($scheduleQuery);
					$scheduleRes->bindParam(':day', $day);
					$scheduleRes->bindParam(':user_id', $userID);
					$scheduleRes->execute();

					$locationQuery = "SELECT name FROM location WHERE id = :location_id";
					$locationRes = $db->prepare($locationQuery);

					echo '<h4>'.$days[$day].'</h4>';
					echo '<ul class="footer_planner_ul">';

					while ($row = $scheduleRes->fetch(PDO::FETCH_ASSOC)) {
						echo '<li class="footer_planner">Time: '.$row['leaving'].'<br>';
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
			</div>
			<div class="col-1-2">
				<p><b>WARNING!</b><br>You have to be 18 or older to use this site!<br>We are not responsible for anything our users do or say!</p>
			</div>
		</div>
	</div>
	<div class="bottom-footer">
		<p class="copyright-text">&copy; 2016 | Styrmir Óli Þorsteinsson and Bjarki Fannar Snorrason</p>
	</div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/moment.js"></script>
<script src="js/geolocation.js"></script>
<script src="js/google_maps.js"></script>
<script src="js/notifications.js"></script>
<script src="js/ism-2.2.min.js"></script>
<script type="text/javascript">
	function update() {
		$('#dgi').html(moment().format('H:mm:ss'));
	}

	setInterval(update, 1000);
</script>
<?php $db = null; ?>