@extends('layouts.app')
@section('content')
<div>
	<label>Year: </label>
	<select name="car-years" id="car-years"></select><br>
	<label>Make: </label>
	<select name="car-makes" id="car-makes"></select><br>
	<label>Model: </label>
	<select name="car-models" id="car-models"></select><br>
	<label>Seats: </label>
	<select name="car-seats" id="car-seats">
		<option value>---</option>
	</select>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="http://www.carqueryapi.com/js/carquery.0.3.4.js"></script>
<script type="text/javascript">
	var carquery = new CarQuery();
	var carYear = '---', carMake = '---', carModel = '---', carSeats = '---';
	var res = [];
	
	function getNumSeats() {
		setTimeout(function() {
			carYear = $('#car-years').val();
			carMake = $('#car-makes').val();
			carModel = $('#car-models').val();

			if (carYear != '---' && carMake != '---' && carModel != '---') {
				$('#car-seats').empty();
				$('#car-seats').html('<option value>---</option>');

				$.getJSON(carquery.base_url + "?callback=?", {cmd: "getTrims", year: carYear, make: carMake, model: carModel}, function(data) {
					var trims = data.Trims;
					var curSeats = null;

					res = [];

					for (var i = 0; i < trims.length; i++) {
						curSeats = trims[i].model_seats;

						if ($.inArray(curSeats, res) == -1) {
							if (curSeats) {
								res.push(curSeats);
							}
						}
					}

					if (res.length == 0) {
						res.push(2, 3, 4, 5, 6, 7, 8, 9);
					}

					res.sort((a, b) => a - b);

					for (var i = 0; i < res.length; i++) {
						$('#car-seats').append('<option value="' + res[i] + '">' + res[i] + '</option>');
					}
				});
			}
		}, 0);
	}

	// CarQueryAPI for getting information about cars
	$(function() {
		carquery.init();
		carquery.setFilters({sold_in_us: false});
		carquery.initYearMakeModelTrim('car-years', 'car-makes', 'car-models');

		getNumSeats();

		$('#car-years, #car-makes, #car-models').on('change keyup', function() {
			getNumSeats();
		});
	});
</script>
@endsection