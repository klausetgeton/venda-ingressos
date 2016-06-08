@extends('index')

@section('content')

		<div class="container">
			<h1>Local</h1>

			@if ($errors->any())
			<ul class="alert alert-warning">
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
			@endif

			@if (isset($place))
				{!! Form::model($place, ['route' => ['places.update', $place->id], 'method' => 'put']) !!}				
			@else
				{!! Form::open(array('action' => 'PlacesController@store')) !!}
			@endif

			<!-- Nome Form Input -->
			<div class="form-group">
			{!! Form::label('nome', 'Nome:') !!}
			{!! Form::text('nome', Input::old('nome'), ['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
			{!! Form::label('qtd_x', 'Lugares na Horizontal:') !!}
			{!! Form::number('qtd_x', Input::old('qtd_x'), ['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
			{!! Form::label('qtd_y', 'Lugares na Vertical:') !!}
			{!! Form::number('qtd_y', Input::old('qtd_y'), ['class'=>'form-control']) !!}
			</div>

			<!-- Descricao Form Input -->
			<div class="form-group">
			{!! Form::label('descricao', 'Descrição:') !!}
			{!! Form::textarea('descricao', Input::old('descricao'), ['class'=>'form-control']) !!}
			</div>
		
			<div class="form-group">
			{!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
			</div>
			{!! Form::close() !!}
		</div>

@endsection