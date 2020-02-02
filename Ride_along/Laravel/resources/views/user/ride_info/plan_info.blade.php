@extends('layouts.app')
@section('content')
<?php
	if (Auth::guest()) {
		Redirect::to('/home');
	}
	$user_id = Auth::getUser()['attributes']['id'];
	$days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
	$day = date("N") - 1;

	if (!isset($_GET['id'])) {
		header("location: index.php");	
	} else {
		$_GET['id'];
	}
	$planRes = DB::select("CALL get_plan_info($user_id)");
	// $scheduleQuery = "SELECT weekplanner.day AS day, 
	// 					weekplanner.leaving AS leaving, 
	// 					weekplanner.to_id AS to_id, 
	// 					weekplanner.from_id AS from_id, 
	// 					weekplanner.plan_id AS plan_id,
	// 					planner.id AS id
	// 					FROM weekplanner
	// 						JOIN planner ON weekplanner.plan_id=planner.id
	// 					WHERE weekplanner.plan_id=:user_id";
	// $scheduleRes = $db->prepare($scheduleQuery);
	// $scheduleRes->bindParam(':user_id', $_GET['id']);
	// $scheduleRes->execute();

	// $locationQuery = "SELECT location_name FROM location WHERE id = :location_id";
	$location_fromRes = DB::table('location')->select('location_name')->where('id', $planRes[$i]->from_id)->get();
	$location_toRes = DB::table('location')->select('location_name')->where('id', $planRes[$i]->to_id)->get();
	// $locationRes = $db->prepare($locationQuery);

	echo '<ul class="footer_planner_ul">';

	// while ($row = $scheduleRes->fetch(PDO::FETCH_ASSOC)) {
	for ($i=0; $i < count($planRes); $i++) { 
		$location_fromRes = DB::table('location')->select('location_name')->where('id', $planRes[$i]->from_id)->get();
		$location_toRes = DB::table('location')->select('location_name')->where('id', $planRes[$i]->to_id)->get();

		echo '<li class="footer_planner"><h4>'.$days[$planRes[$i]]->day.'</h4>Time: '.$planRes[$i]->leaving.'<br>';

		for ($j=0; $j < count($location_fromRes); $j++) { 
			echo 'From: '$location_fromRes[$j]->name'<br>';
			echo 'To: '.$location_toRes[$j]->name;
		}
	}
		// echo '<li class="footer_planner"><h4>'.$days[$row['day']].'</h4>Time: '.$row['leaving'].'<br>';
		// echo '<li class="footer_planner"><h4>'.$planRes[$i]->day.'</h4>Time: '.$planRes[$i]->leaving.'<br>';
		// echo $days[$day].", ".$row['leaving'].", ".$row['to_id'].", ".$row['from_id'].", ".$row['plan_id'];
		// $locationRes->bindParam(':location_id', $row['from_id']);
		// $locationRes->execute();
		
		// while ($row2 = $locationRes->fetch(PDO::FETCH_ASSOC)) {
		// 	echo 'From: '.$row2['name'].'<br>';
		// }
		
		// $locationRes->bindParam(':location_id', $row['to_id']);
		// $locationRes->execute();

		// while ($row2 = $locationRes->fetch(PDO::FETCH_ASSOC)) {
		// 	echo 'To: '.$row2['name'];
		// }
		echo '</li>';
	// }

	echo '</ul>';

?>
@endsection
