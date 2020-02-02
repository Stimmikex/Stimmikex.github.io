@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <h2>Get a Ride</h2>
                <ul class="index_ul">
                    <li><a href="{{ url('/ride/offer_ride') }}">Offer a ride</a></li>
                    <li><a href="{{ url('/ride/request_ride') }}">Request a ride</a></li>
                    <li><a href="{{ url('/ride/planner') }}">Dayplan</a></li>
                    <li><a href="{{ url('/ride/check_plan') }}">Check for plans</a></li>
                </ul>
                <h2>Carpooling</h2>
                <ul class="index_ul">
                    <li><a href="{{ url('/carpooling/ask_ride') }}">Ask ride</a></li>
                    <li><a href="{{ url('/carpooling/add_ride') }}">Add ride</a></li>
                    <li><a href="{{ url('/carpooling/search') }}">Search</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
