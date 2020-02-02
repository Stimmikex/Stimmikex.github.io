<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Auth;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function logincheck() {
		if (Auth::guest()) {
			return redirect()->to('/home');
		}
		else {
			return true;
		}
	}

	public function getUserID() {
		if($this->logincheck())
			return Auth::getUser()['attributes']['id'];

		return null;
	}

	public function location_check() {
		$dp_get_schedule = DB::table('planner')->select('id', 'plan_name')->where('user_id', $user_id['id'])->get();
		$location = DB::table('')->select('name')->where('')->get();
	}
}
