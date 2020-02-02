<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class NotificationController extends Controller
{
	public function notification_list()
	{
		$user_id = $this->getUserID();

		$notification_list = DB::select("CALL get_notification_list($user_id)");

		return view('user.notifications.notification_list', compact('notification_list'));
	}

	public function show_notification($nid)
	{
		$user_id = $this->getUserID();
		$from_user_data = null;
		
		$notification_data = DB::table('notifications')->select('user_id', 'title', 'message', 'sent', 'seen', 'from_user_id', 'matched', 'action_taken')->where('id', $nid)->get();

		if (count($notification_data) > 0) {
			$notification_data = $notification_data[0];
			
			if ($notification_data->from_user_id !== null)
				$from_user_data = DB::table('users')->select('name')->where('id', $from_user_data->from_user_id)->get()[0];
		}
		else
			$notification_data = null;

		return view('user.notifications.show_notification', compact('notification_data', 'user_id'));
	}
}
