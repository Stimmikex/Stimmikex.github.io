<?php

namespace App\Http\Controllers;

use Auth;
use DB;

class PlannerController extends Controller {
	public function __construct() {
		$this->logincheck();
	}

	public function planner() {
		$submitted = false;
		$locations = DB::table('location')->select('id','lat','lng')->get();
		$locations = $locations->toArray();

		if (isset($_POST['submit'])) {
			$submitted = true;
		}

		return view('ride.planner', compact('locations', 'submitted'));
	}

	public function delete_plan() {
		return view('user.ride_info.delete_plan');
	}

	public function schedule() {
		return view('user.ride_info.schedule');
	}

	public function driver_info() {
		return view('user.ride_info.driver_info');
	}

	public function passanger_info() {
		return view('user.ride_info.passanger_info');
	}

	public function plan_info($pid) {
		return view('user.ride_info.plan_info');
	}
}

// if (isset($_POST['submit'])) {
// 	$plan_id = null;

// 	if (isset($_POST['plan_name'])) {
// 		$planner_request = "INSERT INTO planner (plan_name, user_id) VALUES (:plan_name, :user_id)";
// 		$plannerRes = $db->prepare($planner_request);
// 		$plannerRes->bindParam(':plan_name', $_POST['plan_name']);
// 		$plannerRes->bindParam(':user_id',$userID);
// 		$plannerRes->execute();
// 		$plannerRes = null;

// 		$planner_id = "SELECT MAX(id) AS plan_id FROM planner WHERE user_id = :user_id LIMIT 1";
// 		$plannerIdRes = $db->prepare($planner_id);
// 		$plannerIdRes->bindParam(':user_id', $userID);
// 		$plannerIdRes->execute();

// 		while ($row = $plannerIdRes->fetch(PDO::FETCH_ASSOC)) {
// 			$plan_id = $row['plan_id'];
// 		}

// 		$plannerIdRes = null;
// 	}

// 	$insert_request = "INSERT INTO weekplanner (day, leaving, to_id, from_id, plan_id) VALUES (:day, :leaving, :to_id, :from_id, :plan_id)";
// 	$rideRes = $db->prepare($insert_request);

// 	if (isset($_POST['dy'])) {
// 		foreach ($_POST['dy'] as $key => $value) {

// 			$time = $_POST['day'.$value.'_drop'];
// 			$from = $_POST['from'.$value];
// 			$to = $_POST['to'.$value];

// 			$rideRes->bindParam(':day', $value);
// 			$rideRes->bindParam(':leaving', $time);
// 			$rideRes->bindParam(':to_id', $to);
// 			$rideRes->bindParam(':from_id', $from);
// 			$rideRes->bindParam(':plan_id', $plan_id);
// 			$rideRes->execute();
// 		}
// 	}

// 	$rideRes = null;

// 	echo '<h2>Plan added</h2>';
// } else {