@extends('layouts.app')
@section('content')
<?php
	if ($logged === "out") {
		header('Location: index.php');
	}
 	$SelectQuery = "SELECT * FROM weekplanner WHERE id = :id";
 	$SelectRes = $db->prepare($SelectQuery);
 	$SelectRes->bindParam(':id', $_GET['id']);
 	$SelectRes->execute();

 	while ($row = $SelectRes->fetch(PDO::FETCH_ASSOC)) {
 	 	echo '<div class="check_plan_output">';
 	 	echo $days[$row['day']].'<br>';
 	 	echo 'Time: '.$row['leaving'].'<br>';

	 	$fromQuery = "SELECT id, name, lat, location.long AS lon FROM location WHERE id = :id";
		$fromRes = $db->prepare($fromQuery);
		$fromRes->bindParam(':id',$row['from_id']);
		$fromRes->execute();

		while ($row2 = $fromRes->fetch(PDO::FETCH_ASSOC)) {
			echo 'From: '.$row2['name'].'<br>';


			$toQuery = "SELECT id, name, lat, location.long AS lon FROM location WHERE id = :id";
			$toRes = $db->prepare($toQuery);
			$toRes->bindParam(':id',$row['to_id']);
			$toRes->execute();

			while ($row3 = $toRes->fetch(PDO::FETCH_ASSOC)) {
				echo 'To: '.$row3['name'].'<br>';


				echo '</select><iframe width="100%" height="300" frameborder="0" style="border:0"
								src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyC32v6xptkwqC_dhbKPWtsIrc4C1RX7Chs&origin='.$row3['lat'].','.$row3['lon'].'&destination='.$row2['lat'].','.$row2['lon'].'"
								id="map"
								allowfullscreen></iframe>';
				echo '<input type="submit" name="submit" class="sign_submit" value="Sign up">';
			}
		}
		$toRes = null;
		$fromRes = null;

		echo '</div>';
	}
?>
@endsection