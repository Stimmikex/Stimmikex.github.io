@extends('layouts.app')
@section('content')

@if($submitted)
	<h3>{{ $output }}</h3>
	<div style="display:none;" id="data"><span id="datalength">{{ $ride_count }}</span>
	@for($i = 0; $i < $ride_count; $i++)
	<span id="data{{ $i }}">{{ $ride_data[$i]->user_id }};{{ $ride_data[$i]->user_name }};{{ $ride_data[$i]->user_img }};{{ $ride_data[$i]->request_time }};{{ $ride_data[$i]->request_message }}</span>
	@endfor
	</div>
	<div class="user_info"></div>
@else
	<form action="/ride/offer_ride/submit" method="POST" accept-charset="UTF-8">
		{{ csrf_field() }}
		<label>Nearest Location</label>
		<select name="from" class="offer_location">
			<option value="-1" disabled selected>Pick</option>
			@for($i = 0; $i < count($locations); $i++)
				<option value="{{ $locations[$i]->id }}">{{ $locations[$i]->location_name }}</option>
			@endfor
		</select>
		<label>Location of dropoff</label>
		<select name="to" class="offer_location">
			<option value="-1" disabled selected>Pick</option>
			@for($i = 0; $i < count($locations); $i++)
				<option value="{{ $locations[$i]->id }}">{{ $locations[$i]->location_name }}</option>
			@endfor
		</select>
		<input type="submit" name="check" value="Check" class="offer_submit">
	</form>
@endif
<script type="text/javascript">
	$(function() {
		let data = [];
		let dataLength = parseInt($('#datalength').text());
		let index = 0;

		for (let i = 0; i < dataLength; i++) {
			data[i] = $('#data' + i).text().split(';');
		}

		function displayNextRequest(currentIndex) {
			if (currentIndex < dataLength - 1) {
				displayRequest(currentIndex + 1);
			} else {
				$('.user_info').html('<h3>Nothing to display.</h3>');
			}
		}

		function displayRequest(requestIndex) {
			$('.user_info').html('<p><b>Request number:</b> ' + (requestIndex + 1) + '/' + dataLength + '</p><img src="' +
									data[requestIndex][2] + '"><h3>' + data[requestIndex][1] + '</h3><p><b>Message:</b> ' +
									data[requestIndex][4] + '</p><p><b>Time of request:</b> ' + data[requestIndex][3] + '</p>' +
									'<label>Pick up?</label><br><input type="button" value="Yes" class="response_btn">' +
									'<input type="button" value="No" class="response_btn">');
			
			$('.response_btn').on('click', function() {
				if ($(this).val() == 'Yes') {
					$.ajax({
						method: 'POST',
						url: 'core/send_notification.php',
						data: {
								title: 'Ride request accepted',
								message: 'Your ride request has been accepted by the driver shown below.',
								from_user_id: $('#user_id_div').text(),
								to_user_id: data[requestIndex][0]
							}
					}).done(function() {
						$('.user_info').html('<h4>The user you accepted has been notified.</h4><input type="button" value="Ok" class="ok_btn">');
						
						$('.ok_btn').on('click', function() {
							displayNextRequest(requestIndex);
						});
					});
				} else {
					displayNextRequest(requestIndex);
				}
			});
		}

		if (dataLength > 0) {
			displayRequest(0);
		}
	});
</script>
@endsection