@extends('index')

@section('content')

	<div class="container">

		<link rel="stylesheet" href="/css/breadcrumb.css">

		<ol class="progtrckr">
       		<li class="progtrckr-todo">Evento</li>
       		<li class="progtrckr-todo">Patrocinadores</li>
       		<li class="progtrckr-todo">Lotes</li>
		    <li class="progtrckr-todo">Descontos</li>
	    </ol>

		<h1>Evento</h1>

		@if ($errors->any())
			<ul class="alert alert-warning">
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		@endif

		@if (isset($event))
			{!! Form::model($event, ['route' => ['events.update', $event->id], 'method' => 'put']) !!}
		@else
			{!! Form::open(array('action' => 'EventsController@store')) !!}
		@endif

		<!-- Nome Form Input -->
		<div class="form-group">
		{!! Form::label('nome', 'Nome:*') !!}
		{!! Form::text('nome', Input::old('nome'), ['class'=>'form-control']) !!}
		</div>

		<!-- Data Form Input -->
		<div class="form-group">
		{!! Form::label('data', 'Data:*') !!}
		{!! Form::date('data', Input::old('data'), ['class'=>'form-control']) !!}
		</div>

		<!-- hora Form Input -->
		<div class="form-group">
		{!! Form::label('hora', 'Hora:*') !!}
		{!! Form::text('hora', Input::old('hora'), ['class'=>'form-control', 'placeholder' => 'hh:mm']) !!}
		</div>

		<!-- local Form Input -->
		<div class="form-group">
			{!! Form::label('locais_id', 'Local:*') !!}
			{!! Form::modalSeek(null, 'locais_id', 'locais_nome', 'Local', 'nome', '', []) !!}
		</div>

		<!-- Descricao Form Input -->
		<div class="form-group">
		{!! Form::label('descricao', 'Descrição:') !!}
		{!! Form::textarea('descricao', Input::old('descricao'), ['class'=>'form-control']) !!}
		</div>

		<div class="form-group">
		{!! Form::button('Próxima Etapa <i class="fa fa-arrow-right" aria-hidden="true"></i>', array('type' => 'submit', 'class' => 'btn btn-primary')) !!}
		</div>
		{!! Form::close() !!}
	</div>
@endsection
@section('scripts')
	<script src="/js/jquery.maskedinput.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		jQuery(function($){
			$("#hora").mask("99:99");
		});
	</script>

@show