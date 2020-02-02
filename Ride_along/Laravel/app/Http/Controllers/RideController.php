<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class RideController extends Controller
{
	private function has_open_request($user_id)
	{
		$query = DB::table('ride')->where(['user_id' => $user_id, 'available' => 1, 'is_request' => 1])->value('id');

		if (count($query) > 0)
			return true;
		else
			return false;
	}

	public function offer_ride()
	{
		$this->logincheck();

		$submitted = false;
		$locations = DB::select('CALL get_all_locations()');

		return view('ride.offer', compact('locations', 'submitted'));
	}

	public function offer_ride_submit(Request $req)
	{
		$user_id = $this->getUserID();
		$hasOpenRequest = false;

		$submitted = true;
		$output = null;
		$ride_data = [];
		$ride_count = 0;

		$from_id = intval($req->input('from'));
		$to_id = intval($req->input('to'));

		if ($from_id < 1 || $to_id < 1)
			$output .= 'Please select both locations.';
		else
		{
			DB::select("CALL add_ride($user_id, $to_id, $from_id, null, 0)");
			$ride_data = DB::select("CALL get_ride_requests($to_id, $from_id)");
			$ride_count = count($ride_data);

			$output .= 'Offer added';
		}

		return view('ride.offer', compact('output', 'submitted', 'ride_data', 'ride_count', 'hasOpenRequest'));
	}

	public function request_ride()
	{
		$user_id = $this->getUserID();
		$hasOpenRequest = false;

		if ($this->has_open_request($user_id)) {
			$output = 'You already have a request.';
			$hasOpenRequest = true;
		}

		$submitted = false;
		$locations = DB::select('CALL get_all_locations()');

		return view('ride.request', compact('locations', 'submitted', 'hasOpenRequest'));
	}

	public function request_ride_submit(Request $req)
	{
		$user_id = $this->getUserID();
		$hasOpenRequest = false;

		$output = null;
		$submitted = true;
		$from_id = intval($req->input('from'));
		$to_id = intval($req->input('to'));
		$message = $req->input('message');

		if ($from_id < 1 || $to_id < 1)
			$output .= 'Please select both locations.';
		else
		{
			DB::select("CALL add_ride($user_id, $to_id, $from_id, '$message', 1)");
			$output .= 'Request added';
		}

		return view('ride.request', compact('output', 'submitted', 'hasOpenRequest'));
	}

	public function cancel_request()
	{
		/* Get the user id */
		$user_id = $this->getUserID();
		$hasOpenRequest = false;
		$submitted = false;
		$output = null;
		$locations = DB::select('CALL get_all_locations()');

		/* Cancel the request */
		DB::table('ride')->where(['user_id' => $user_id, 'available' => 1, 'is_request' => 1])->update(['available' => 0]);

		/* Go to the request page */
		return view('ride.request', compact('locations', 'output', 'submitted', 'hasOpenRequest'));
	}

	public function planner()
	{
		$this->logincheck();

		return view('ride.planner');
	}

	public function check_plan()
	{
		$this->logincheck();

		return view('ride.check_plan');
	}
}