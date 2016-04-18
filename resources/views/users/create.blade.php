@extends('index')

@section('content')

	@role('admin')


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
	


	@else
		<script>
			swal("Acesso Negado!", "", "error");
		</script>
@endrole


@endsection