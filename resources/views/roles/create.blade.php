@extends('index')

@section('content')

	<div class="container">
		@if ($errors->any())
			<ul class="alert alert-warning">
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		@endif

        <ol class="breadcrumb" style="margin-bottom: 5px;">
            <li><a href='/'>Início</a></li>
            <li><a href='{{route('roles.index')}}'>Grupo</a></li>
            <li class="active">Edição de Grupo</li>
        </ol>

		<h3>Grupo</h3>

		@if (isset($role))
			{!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'put']) !!}
		@else
			{!! Form::open(array('action' => 'RolesController@store')) !!}
		@endif

		<!-- Nome Form Input -->
		<div class="form-group">
		{!! Form::label('name', 'Nome amigável:*') !!}
		{!! Form::text('name', Input::old('name'), ['class'=>'form-control']) !!}
		</div>

		<!-- Nome Form Input -->
		<div class="form-group">
		{!! Form::label('slug', 'Nome identificador:*') !!}
		{!! Form::text('slug', Input::old('slug'), ['class'=>'form-control']) !!}
		</div>

		<!-- Descricao Form Input -->
		<div class="form-group">
		{!! Form::label('description', 'Descrição:') !!}
		{!! Form::textarea('description', Input::old('description'), ['class'=>'form-control']) !!}
		</div>

		<div class="form-group">
		{!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
		</div>
		{!! Form::close() !!}
	</div>

@endsection