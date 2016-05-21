@extends('index')

@section('content')

		<script src="/js/jquery.maskedinput.min.js" type="text/javascript"></script>

		<div class="container">
			<h1>Usuário</h1>

			@if ($errors->any())
			<ul class="alert alert-warning">
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
			@endif

			@if (isset($user))
				{!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) !!}				
			@else
				{!! Form::open(array('action' => 'UsersController@store')) !!}
			@endif
			
			<div class="form-group">
			{!! Form::label('name', 'Nome:') !!}
			{!! Form::text('name', Input::old('name'), ['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
			{!! Form::label('rg', 'RG:') !!}
			{!! Form::number('rg', Input::old('rg'), ['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
			{!! Form::label('cpf', 'CPF:') !!}
			{!! Form::text('cpf', Input::old('cpf'), ['class'=>'form-control', 'data-mask' => '00/00/0000']) !!}
			</div>

			<div class="form-group">
			{!! Form::label('email', 'Email:') !!}
			{!! Form::text('email', Input::old('email'), ['class'=>'form-control']) !!}
			</div>
		
			<div class="form-group">
				{!! Form::label('roles', 'Grupos:') !!}
				{!! Form::select2('roles', isset($user) ? $user->roles()->get() : array(), 'Role', 'name', 'true', ['']) !!}
			</div>
			
			@if (!isset($user))
				<div class="form-group">
				{!! Form::label('password', 'Senha:') !!}
				{!! Form::password('password', ['class'=>'form-control']) !!}
				</div>
			@endif

			<div class="form-group">
			{!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
			</div>
			{!! Form::close() !!}
		</div>
		
		<script type="text/javascript">
			jQuery(function($){
				$("#cpf").mask("999.999.999-99");
			});
		</script>
@endsection