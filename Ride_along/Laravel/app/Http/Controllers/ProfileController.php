<?php
namespace App\Http\Controllers;

use Auth;
use DB;

class ProfileController extends Controller
{
	public function index()
	{
		$output = array();

		if (!Auth::guest())
		{
			$user = Auth::getUser()['attributes'];
			//dd(Auth::getUser());

			$output[] = 'Name: '.$user['name'];
			$output[] = 'Email: '.$user['email'];

			$user_img = $this->get_profile_img($user['id']);
		}
		else
		{
			$output[] = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
		}

		return view('user.profile', compact('output', 'user_img'));
	}
	public static function get_profile_img($user)
	{
		$fb_user_img = null;
		$fb_check = DB::table('social_accounts')->select('provider')->where('user_id', $user)->get();
		
		if ($fb_check = 'facebook') {
			$fb_user_img = DB::table('social_accounts')->select('user_img')->where('user_id', $user)->get();
			$fb_user_img = $fb_user_img->toArray()[0]->user_img;
		}

		return $fb_user_img;
	}
	public function get_plan() 
	{
		$dp_get_schedule = DB::table('planner')->select('id', 'plan_name')->where('user_id', $user_id['id'])->get();

		return $dp_get_schedule;
	}
}
