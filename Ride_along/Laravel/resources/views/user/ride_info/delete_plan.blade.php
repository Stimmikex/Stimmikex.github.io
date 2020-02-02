@extends('layouts.app')
@section('content')
<?php
	if (Auth::guest()) {
		Redirect::to('/home');
	}
	$user = Auth::getUser()['attributes'];
	$scheduleRes = DB::table('planner')->select('id', 'plan_name')->where('user_id', $user['id'])->get();
	if (empty($scheduleRes)) {
		echo '<h4>Nothing found</h4>';
	}
	else {
		// echo "<pre>";
		// print_r($scheduleRes);
		// echo "</pre>";
		echo '<ul class="footer_planner_ul">';
		for ($i=0; $i < count($scheduleRes); $i++) { 
			echo '<h4>'.$scheduleRes[$i]->plan_name.'</h4>';
			echo '<a href="/profile/plan_info/'.$scheduleRes[$i]->id.'">Info</a>';
			echo '<li><form method="post">';
			?>
				<input type="submit" name="delete_<?php echo $scheduleRes[$i]->id; ?>" value="Delete" class="delete_planner">
			<?php
				if (isset($_POST['delete_'.$scheduleRes[$i]->id])) {
					DB::table('dayplanner')->where('plan_id', $scheduleRes[$i]->plan_id)->delete();
					DB::table('planner')->where('id', $scheduleRes[$i]->plan_id)->delete();

					Redirect::to('/profile');
				}
			echo '</form>';
			echo '</li>';
		}
		echo '</ul>';
	}
?>
@endsection