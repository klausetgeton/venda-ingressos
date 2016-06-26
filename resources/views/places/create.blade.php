@extends('index')

@section('content')

		<div class="container">

	    	<ol class="breadcrumb" style="margin-bottom: 5px;">
	            <li><a href='/'>Início</a></li>
	            <li><a href='{{route('places.index')}}'>Locais</a></li>
	            <li class="active">Edição de Local</li>
        	</ol>

			<h3>Local</h3>

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

			<div class="form-group">
			{!! Form::label('nome', 'Nome:*') !!}
			{!! Form::text('nome', Input::old('nome'), ['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
			{!! Form::label('qtd_x', 'Lugares na Horizontal:*') !!}
			{!! Form::number('qtd_x', Input::old('qtd_x'), ['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
			{!! Form::label('qtd_y', 'Lugares na Vertical:*') !!}
			{!! Form::number('qtd_y', Input::old('qtd_y'), ['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
			{!! Form::label('cidade', 'Cidade:*') !!}
			{!! Form::text('cidade', Input::old('cidade'), ['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
			{!! Form::label('endereco', 'Endereço:*') !!}
			{!! Form::text('endereco', Input::old('endereco'), ['class'=>'form-control']) !!}
			</div>

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