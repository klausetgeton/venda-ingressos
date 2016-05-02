@extends('index')

@section('content')


		<div class="container">
			<h1>Usuário</h1>

			@if ($errors->any())
			<ul class="alert alert-warning">
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
			@endif


		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>


		<!-- Trigger the modal with a button -->
		<a class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</a>

		<!-- Modal -->
		<div id="myModal" class="modal" role="dialog">
			<div class="modal-dialog modal-lg">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Busca</h4>
					</div>
					<div class="modal-body">
						<form class="form-inline" role="form">
							<div class="form-group">
								<label for="search">Name:</label>
							    <input type="search" class="form-control" id="search">
							</div>
							<button type="submit" class="btn btn-default">Buscar</button>
						</form>

						<table id="tableID" class="table">
							<thead>
								<tr>
									<th>Id</th>
									<th>Nome</th>
									<th>Ação</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>

						<ul class = "pagination">
							<li><a href = "#">&laquo;</a></li>
							<li><a href = "#">1</a></li>
							<li><a href = "#">2</a></li>
							<li><a href = "#">3</a></li>
							<li><a href = "#">4</a></li>
							<li><a href = "#">5</a></li>
							<li><a href = "#">&raquo;</a></li>
						</ul>
					
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					</div>
				</div>

			</div>
		</div>


			<script type="text/javascript">				
				$( "form" ).submit(function( event ) {
					event.preventDefault();
					var search = $("#search").val();
					$.get('/teste-ajax/' + search, function (users) {	
						$('#tableID tbody > tr').remove();	 

						$.each(users, function (key, value) {
							$("#tableID").find('tbody')
							.append($('<tr>')
								.append($('<td>')
									.append(value.id)								            
									)
								.append($('<td>')
									.append(value.name)
									)
								.append($('<td>')
									.append('<a href="javascript:selectFromModalTable(\''+value.id+'\',\''+value.name+'\');" class="btn btn-default btn-sm" role="button">Selecionar</a>')
									)								        						          
								);
						});


					});
				});     

				function selectFromModalTable(id, text) {				    	    	  
					$( "#teste" ).val(id);
					$( "#teste1" ).val(text);	
					$( "#myModal" ).modal("hide");				       				        
				} 

			</script>



			@if (isset($user))
				{!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) !!}				
			@else
				{!! Form::open(array('action' => 'UsersController@store')) !!}
			@endif


			<!-- Nome Form Input -->
			<div class="form-group">
			{!! Form::label('teste', 'teste:') !!}
			{!! Form::text('teste', null, ['class'=>'form-control']) !!}
			</div>

			<!-- Nome Form Input -->
			<div class="form-group">
			{!! Form::label('teste1', 'teste:') !!}
			{!! Form::text('teste1', null, ['class'=>'form-control']) !!}
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