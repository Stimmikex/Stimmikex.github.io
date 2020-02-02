@extends('layouts.app')
@section('content')

@if(count($notification_list) == 0)
	<h3>No notifications found.</h3>
@else
	@foreach($notification_list as $notification)
		@if($notification->seen == 0)
			<b>
		@endif
		<a href="/profile/notifications/{{ $notification->id }}">{{ $notification->title }}</a>
		<p>{{ $notification->sent }}</p>
		@if($notification->seen == 0)
			</b>
		@endif
	@endforeach
@endif

@endsection