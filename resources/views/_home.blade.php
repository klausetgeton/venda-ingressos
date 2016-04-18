@extends('index')

@section('content')

@role('admin')
	<?php
				

		if (Auth::user()->hasRole('admin')) { // you can pass an id or slug

			echo "</br>";
    		echo "O usuário " . Auth::user()->id . " é do grupo admin";	
		}

	?>
	
@endrole


@endsection