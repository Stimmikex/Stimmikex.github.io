@extends('layouts.app')
@section('content')
<label>Registration number: </label><input type="text" name="car_number" id="car-number" maxlength="6">
<label>Seats (including driver): </label><input type="number" name="car_seats" id="car-seats" max="10">
<input type="button" name="get_car_data" id="get-data-btn" value="Get Data">
<script type="text/javascript">
	var carNumber = null;

	$(function() {
		$('#get-data-btn').on('click', function() {
			carNumber = $('#car-number').val();
			
			$.ajax({
				'url': 'http://apis.is/car',
				'type': 'GET',
				'dataType': 'json',
				'data': {'number': carNumber},
				'success': function(response) {
					console.log(response);
				}
			});
		});
	});
</script>
@endsection