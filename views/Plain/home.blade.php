@extends('partials.default')
@section('content')	
	<center id="luna-home">
		<br><br><br>
		<p>
			<strong>Olive</strong> Framework
		</p>
	</center>
	<p>
		This is a variable $message: {{ $saludo }}		
	</p>
	<p>
		Go over an array $names
	</p>
	@forelse($nombres as $user)
	    <li>{{ $user }}</li>
	@empty
	    <p>No users</p>
	@endforelse
@stop