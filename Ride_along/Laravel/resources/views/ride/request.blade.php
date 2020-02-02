@extends('layouts.app')
@section('content')

@if($hasOpenRequest)
	<form action="/ride/request_ride/cancel" method="POST">
		{{ csrf_field() }}
		<input type="submit" name="cancel" value="Cancel Request">
	</form>
@else
	@if($submitted)
		<h3>{{ $output }}</h3>
	@else
		<form action="/ride/request_ride/submit" method="POST" accept-charset="UTF-8">
			{{ csrf_field() }}
			<label>Pickup location</label>
			<select name="from" class="request_location">
				<option value="-1" disabled selected>Pick</option>
				@for($i = 0; $i < count($locations); $i++)
					<option value="{{ $locations[$i]->id }}">{{ $locations[$i]->location_name }}</option>
				@endfor
			</select>
			<label>Dropoff location</label>
			<select name="to" class="request_location">
				<option value="-1" disabled selected>Pick</option>
				@for($i = 0; $i < count($locations); $i++)
					<option value="{{ $locations[$i]->id }}">{{ $locations[$i]->location_name }}</option>
				@endfor
			</select>
			<label>Message</label>
			<div class="input-field">
				<textarea class="request_message" id="textarea" name="message" maxlength="200"></textarea>
				<div id="textarea_feedback"></div>
			</div>
			<input type="submit" name="submit" value="Add" class="request_submit">
		</form>
	@endif
@endif
<script type="text/javascript">
	$(document).ready(function() {
	    var text_max = 200;
	    $('#textarea_feedback').html(text_max + ' characters remaining');

	    $('#textarea').on('keyup', function() {
	        var text_length = $('#textarea').val().length;
	        var text_remaining = text_max - text_length;

	        $('#textarea_feedback').html(text_remaining + ' characters remaining');
	    });
	});
</script>
@endsection