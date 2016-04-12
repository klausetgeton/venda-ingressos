@extends('index')

@section('content')


	{{ dd(\Auth::user()) }}
	{{-- dd(\App\User::all()) --}}

@endsection