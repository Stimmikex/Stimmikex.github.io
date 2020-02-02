@extends('layouts.app')
@section('content')
<div id="chat"></div>
<script type="text/javascript">
	$(function() {
		$('#chat').load('http://138.68.181.216:3000/');
	});
</script>
@endsection