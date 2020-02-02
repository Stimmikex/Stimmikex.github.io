@extends('layouts.app')
@section('content')

@if($notification_data != null)
	@if($notification_data->user_id != $user_id)
		<h3>You do not have permission to see this notification.</h3>
	@else
		@if($notification_data->seen == 0)
			{{-- Update the database and set 'seen' to 1 --}}
		@endif

		<h3>{{ $notification_data->title }}</h3>
		<p>{{ $notification_data->message }}</p>
		<p><b>{{ $notification_data->sent }}</b></p>
	@endif
@else
	<h3>Notification not found.</h3>
@endif

@endsection