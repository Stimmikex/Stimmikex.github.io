@extends('layouts.app')
@section('content')
<div>
	<img src='{{ $user_img }}'>
</div>
<div class="pro_info">
	@foreach ($output as $line)
		<p>{{ $line }}</p>
	@endforeach

	<p>Rating: </p>
</div>
<h2>Get a Ride Controlls</h2>
<div class="pro_icons">
	<a href="{{ url('profile/notifications') }}" class="pro_note"><img src="{{ config('paths.icons') }}notification.png">Notifications <span class="notification_count"></span></a>
	<a href="{{ url('profile/delete_plan') }}" class="pro_del"><img src="{{ config('paths.icons') }}delete.png">Delete Plans</a>
	<a href="{{ url('profile/schedule') }}" class="pro_sch"><img src="{{ config('paths.icons') }}schedule.png">Schedule</a>
	<a href="{{ url('profile/plan_info') }}" class="pro_sch"><img src="{{ config('paths.icons') }}info_icon.png"> Plan info</a>
</div>
<h2>Carpooling Info</h2>
<div class="pro_icons">
	<a href="{{ url('profile/driver_info') }}" class="pro_driver"><img src="{{ config('paths.icons') }}driver_icon.png">Driver Info</a>
	<a href="{{ url('profile/passanger_info') }}" class="pro_pass"><img src="{{ config('paths.icons') }}passanger_icon.png">Passanger Info</a>
</div>
@endsection