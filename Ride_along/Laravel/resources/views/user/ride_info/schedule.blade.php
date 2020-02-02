@extends('layouts.app')
@section('content')
<div class="week_table">
	<?php
		if (Auth::guest()) {
			Redirect::to('/home');
		}
		$user_id = Auth::getUser()['attributes']['id'];
		$days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
		$day = date("N") - 1;

		for ($i = 0; $i < count($days); $i++) {
			$scheduleRes = DB::select("CALL get_schedule_user($user_id, $i)");

			echo '<ul class="schedule_ul">';
			echo '<h4>'.$days[$i].'</h4>';

			if (empty($scheduleRes)) {
				echo "Nothing on this day.";
			}
			else {
				echo '<pre>';
				for ($j = 0; $j < count($scheduleRes); $j++) {
					echo $scheduleRes[$j]->leaving. "<br>";
					$location_toRes = DB::table('location')->select('location_name')->where('id', $scheduleRes[$j]->to_id)->get();
					$location_fromRes = DB::table('location')->select('location_name')->where('id', $scheduleRes[$j]->from_id)->get();

					echo "To: ".$location_toRes[0]->location_name."<br>";
					echo "From: ".$location_fromRes[0]->location_name."<br>";
					echo "<hr>";
				}
				echo '</pre>';
			}
			echo '</ul>';
		}

	?>
</div>
@endsection