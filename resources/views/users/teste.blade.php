@extends('index')

@section('content')


		<div class="container">
			<h1>Usuário</h1>		

			@include('errors.list')


			<?php

			$model = "User";
			$search_column = "name";
			$id_field = 'gp_id';
			$description_field = 'gp_name';

			?>

			@include('modalSeek')

			@if (isset($user))
				{!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) !!}				
			@else
				{!! Form::open(array('action' => 'UsersController@store')) !!}
			@endif



			<!-- Nome Form Input -->
			<div class="form-group">
			</div>

			<!-- Nome Form Input -->
			<div class="form-group form-inline">
				{!! Form::label('gp_id', 'teste:') !!}			
				<br>
				{!! Form::text('gp_id', null, ['class'=>'form-control', 'style'=>'width:10%;']) !!}

				{!! Form::label('gp_name', ' ') !!}			
				{!! Form::text('gp_name', null, ['class'=>'form-control', 'style'=>'width:80%;', 'disabled']) !!}
				<a class="btn btn-info" style="width:9%;" data-toggle="modal" data-target="#searchModal">Procurar	</a>
			</div>

			<!-- Nome Form Input -->
			<div class="form-group">
				{!! Form::label('name', 'Nome:') !!}
				{!! Form::text('name', Input::old('name'), ['class'=>'form-control']) !!}
			</div>

			<!-- Nome Form Input -->
			<div class="form-group">
				{!! Form::label('email', 'Email:') !!}
				{!! Form::text('email', Input::old('email'), ['class'=>'form-control']) !!}
			</div>

			<!-- Password Form Input -->

			@if (!isset($user))
			<div class="form-group">
				{!! Form::label('password', 'Senha:') !!}
				{!! Form::text('password', null, ['class'=>'form-control']) !!}
			</div>
			@endif

			<div class="form-group">
				{!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	
@endsection