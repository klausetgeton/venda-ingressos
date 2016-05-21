@extends('index')

@section('content')


		<div class="container">
			<h1>Usuário</h1>		

			@include('errors.list')			

			@if (isset($user))
				{!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) !!}				
			@else
				{!! Form::open(array('action' => 'UsersController@store')) !!}
			@endif

			<!-- Nome Form Input -->
			<div class="form-group">
			</div>
			<div class="form-group">
				{!! Form::label('testeid', 'teste do lookup:') !!}
				{!! Form::modalSeek(null, 'testeid', 'testedescric', 'User', 'name', '', []) !!}
			</div>


			<?php
				$ar = array(
					'0' => array( 'id' => 'L', 'name' => 'Large'),
					'1' => array('id' => 'S', 'name' => 'Small') 
					);				
			?>
			<div class="form-group">
				{!! Form::label('teste', 'teste o Select2:') !!}
				{!! Form::select2('teste', $ar, array('L', 'S'), 'User', 'name', 'true', ['']) !!}
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