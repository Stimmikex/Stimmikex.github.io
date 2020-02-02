@extends('layouts.app')
@section('content')
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" accept-charset="UTF-8">
	<label>Day:</label>
	<select name="day" class="request_location">
		<option value="-1" disabled selected>Pick</option>
		<?php
			for ($i=0; $i < 7; $i++) {
			 	echo '<option value="'.$i.'">'.$days[$i].'</option>';
			}
		?>
	</select>	
	<label>Nearest Location</label>
	<select name="from" class="request_location">
		<option value="-1" disabled selected>Pick</option>
	    <?php
			// $query = "SELECT id, name FROM location ORDER BY name ASC";
			// $res = $db->prepare($query);
			// $res->execute();

			// while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
			// 	echo '<option value="'.$row['id'].'"name="from">'.$row['name'].'</option>';
			// }
		?>
	</select>
	<input type="submit" name="submit" value="check" class="cp_submit">
	<?php
		// $daySet = $fromSet = $error = FALSE;

 	// 	if (isset($_POST['from'], $_POST['day'])) //both
 	// 		$daySet = $fromSet = TRUE;
 	// 	else if (isset($_POST['from']) && !isset($_POST['day'])) //from
 	// 		$fromSet = TRUE;
 	// 	else if (!isset($_POST['from']) && isset($_POST['day'])) //day
 	// 		$daySet = TRUE;
 	// 	else
 	// 		$error = TRUE;

	 // 	if (isset($_POST['submit'])) {
	 // 		if ($error)
	 // 			echo 'ERROR!';
	 // 		else {
	 // 			// $SelectQuery = "SELECT * FROM weekplanner WHERE day = :day OR from_id = :location";
		// 		$SelectQuery = "SELECT * FROM weekplanner WHERE ";

		//  		if ($daySet && $fromSet) {
		//  			$SelectQuery .= "day=:day AND from_id=:location";

		// 	 	 	$SelectRes = $db->prepare($SelectQuery);
		// 	 	 	$SelectRes->bindParam(':day', $_POST['day']);
		// 	 	 	$SelectRes->bindParam(':location', $_POST['from']);
		//  		} else if ($daySet && !$fromSet) {
		//  			$SelectQuery .= "day=:day";

		// 	 	 	$SelectRes = $db->prepare($SelectQuery);
		// 	 	 	$SelectRes->bindParam(':day', $_POST['day']);
		//  		} else if (!$daySet && $fromSet) {
		//  			$SelectQuery .= "from_id=:location";

		// 	 	 	$SelectRes = $db->prepare($SelectQuery);
		// 	 	 	$SelectRes->bindParam(':location', $_POST['from']);
		//  		}

		//  	 	$SelectRes->execute();

		//  	 	if ($SelectRes->rowCount() === 0)
		//  	 		echo 'Nothing found';
		//  	 	else {
		//  	 		while ($row = $SelectRes->fetch(PDO::FETCH_ASSOC)) {
		// 	 	 		echo '<div class="check_plan_output">';
		// 	 	 		echo $days[$row['day']].'<br>';
		// 	 	 		echo 'Time: '.$row['leaving'].'<br>';

		// 	 	 		$toQuery = "SELECT id, name FROM location WHERE id = :id";
		// 				$toRes = $db->prepare($toQuery);
		// 				$toRes->bindParam(':id',$row['from_id']);
		// 				$toRes->execute();

		// 				while ($row2 = $toRes->fetch(PDO::FETCH_ASSOC)) echo 'From: '.$row2['name'].'<br>';

		// 				$toRes = null;

		// 				$fromQuery = "SELECT id, name FROM location WHERE id = :id";
		// 				$fromRes = $db->prepare($fromQuery);
		// 				$fromRes->bindParam(':id',$row['to_id']);
		// 				$fromRes->execute();

		// 				while ($row2 = $fromRes->fetch(PDO::FETCH_ASSOC)) echo 'To: '.$row2['name'].'<br>';

		// 				echo '<a href="sign_plan.php?id='.$row['id'].'">Sign up</a>';

		// 				$fromRes = null;

		// 				echo '</div>';
		// 	 	 	}
		//  	 	}

		//  	 	$SelectRes = null;
	 // 		}
		// }
	?>
</form>
@endsection