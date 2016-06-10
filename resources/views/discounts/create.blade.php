@extends('index')

@section('content')

	<meta name="_token" content="{{ csrf_token() }}" />

	<div class="container">
		<link rel="stylesheet" href="/css/breadcrumb.css">

		<ol class="progtrckr">
	   		<li class="progtrckr-done">Evento</li>
	   		<li class="progtrckr-done">Patrocinadores</li>
	   		<li class="progtrckr-done">Lotes</li>
		    <li class="progtrckr-todo">Descontos</li>
	    </ol>

		<h1>Descontos</h1>

		<div id="formErrors" style="visibility: hidden ">
		</div>

		@if (session('message') == 'ok')
		<div class="alert alert-success">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				Operação realizada com sucesso.
		</div>
		@endif

		{!! Form::open(array('name' => 'discountForm', 'method'=>'POST', 'id' => 'discountForm', 'url' => '')) !!}

			{!! Form::hidden('id', null, ['class'=>'form-control']) !!}
			{!! Form::hidden('eventos_id', session()->get('event_id'), ['class'=>'form-control']) !!}

			<div class="form-group">
				{!! Form::label('porcentagem', 'Porcentagem do desconto:*') !!}
				{!! Form::number('porcentagem', Input::old('porcentagem'), ['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('quantidade', 'Quantidade:*') !!}
				{!! Form::number('quantidade', Input::old('quantidade'), ['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('hash', 'Hash:*') !!}
				{!! Form::text('hash', Input::old('hash'), ['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('descricao', 'Descrição:') !!}
				{!! Form::textarea('descricao', Input::old('descricao'), ['class'=>'form-control', 'rows'=>'2']) !!}
			</div>

			<div class="form-group">
				{!! Form::submit('Adicionar', ['class'=>'btn btn-primary']) !!}
			</div>
		{!! Form::close() !!}

		<table id="dList" class="table table-striped table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th>Descrição</th>
					<th>Hash</th>
					<th>Quantidade</th>
					<th>Desconto</th>
					<th>ID do Evento</th>
					<th>Evento</th>
					<th>Ação</th>
				</tr>
			</thead>
		</table>

		<a class="btn btn-primary" href="{{ route('discounts.create') }}">
			<i class="fa fa-arrow-left" aria-hidden="true"></i>
			Etapa Anterior
		</a>
		<a class="btn btn-primary" href="{{ route('events.finish', ['id' => session()->get('event_id')]) }}">
			Finalizar
			<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</a>
		</br>
		</br>

	</div>
@endsection
@section('scripts')
	<script>
		var table;

		function showConfirmDeleteDialog(link) {
			swal({
				title: "Deseja apagar o registro?",
				text: "A ação não poderá ser desfeita",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Apagar",
				cancelButtonText: "Cancelar",
				closeOnConfirm: true,
				closeOnCancel: true
			},

			function(isConfirm)
			{
				if (isConfirm)
				{
					ajaxDelete(link);
				}
				else{}
			});
		}



		<?php $model = "Desconto";	 ?>
		$( document ).ready(function() {
			table = $('#dList').DataTable({
				bFilter: false,
				processing: true,
				serverSide: true,
			    ajax: {
		            url: '{!! route('datatables.data', ['model' => $model]) !!}',
		            //aditional paramether to the queryx
		            data: function (query) {
		                query.eventos_id = '{{ session()->get('event_id') }}';
		            }
	        	},
				columns: [
				{ data: 'id', name: 'id' },
				{ data: 'descricao', name: 'descricao' },
				{ data: 'hash', name: 'hash' },
				{ data: 'quantidade', name: 'quantidade' },
				{ data: 'porcentagem', name: 'porcentagem' },
				{ data: 'eventos_id', name: 'eventos_id' },
				{ data: 'evento.nome', name: 'evento.nome' },
				{ data: null, render: function ( data, type, row ) {
					return "<a href=\"javascript:editFromTable(\'" + data.id + "\')\" class='btn-sm btn-success'><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i> Editar</a>"
					+ "<a href=\"javascript:showConfirmDeleteDialog(\'" + data.id + "\')\" class=\"btn-sm btn-danger\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i> Apagar</a>";
				}, orderable: false, "bSearchable": false },
				],
				"language": {
					"url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Portuguese-Brasil.json"
				},
				"order": [[ 0, "desc" ]],
			});
		});


		//ajax request to store the sponsor of this event
		$( '#discountForm' ).submit(function (evt)
			{
			evt.preventDefault();

			$.ajaxSetup({
				header:$('meta[name="_token"]').attr('content')
			})

		    $.ajax({
		        type: 'POST',
		        url: '{{route('discounts.store')}}',
		        data: $(this).serialize(),
		        dataType: 'json',
		        success: function(data)
		        {
		        	$('#formErrors').css('visibility', 'hidden');
		         	resetForm();
		         	refreshDataTable();
				},
				error:function(data){
		    		var errors = data.responseJSON;
		    		apendFormErrors(errors);
				}
		    })
		});

		function apendFormErrors(data)
		{
			errorsHtml = '<div class="alert alert-warning"><ul>';
			var errorsLi = "";

	        $.each( data, function( key, value ) {
	            errorsLi += '<li>' + value[0] + '</li>'; //showing only the first error.
	        });

	        errorsHtml += errorsLi;
	        errorsHtml += '</ul></di>';

	        $('#formErrors').css('visibility', 'visible');
	        $( '#formErrors' ).html( errorsHtml );
		}

		//clear form fields
		function resetForm()
		{
			$('input[name="id"').val("");
			$('textarea[name="descricao"').val("");
			$('input[name="quantidade"').val("");
			$('input[name="porcentagem"').val("");
			$('input[name="hash"').val("");
			$('input[name="eventos_nome"').val("");
		}

		//refresh data on the dable that is using datatables
		function refreshDataTable()
		{
			table.draw();
		}

		//ajax request to delete the sponsor of this event
		function ajaxDelete (id)
		{
			$.ajaxSetup({
				header:$('meta[name="_token"]').attr('content')
			})

		    $.ajax({
		        type: 'POST',
		        url: 'discounts/delete/' + id,
		        dataType: 'json',
		        data: {_token:$('meta[name="_token"]').attr('content')},
		        success: function(data)
		        {
		         	refreshDataTable();
				},
				error:function(data){
		    		var errors = data.responseJSON;
	        		 $.each( errors, function( key, value ) {
	            		console.log(value[0]);
	        		});
				}
		    })
		};

		//edit a object selected from table
		function editFromTable(id)
		{
			//get the values using ajax
			$.ajaxSetup({
				header:$('meta[name="_token"]').attr('content')
			})

		    $.ajax({
		        type: 'POST',
		        url: 'discounts/edit/' + id,
		        dataType: 'json',
		        data: {_token:$('meta[name="_token"]').attr('content')},
		        success: function(data)
		        {
					$('input[name="id"').val(data.id);
					if(data.descricao == "null")
					{
						$("#descricao").val("");
					}else
					{
						$("#descricao").val(data.descricao);
					}
					$('input[name="hash"').val(data.hash);
					$('input[name="porcentagem"').val(data.porcentagem);
					$('input[name="quantidade"').val(data.quantidade);
					$('input[name="eventos_id"').val(data.eventos_id);
				},
				error:function(data){
		    		var errors = data.responseJSON;
	        		 $.each( errors, function( key, value ) {
	            		console.log(value[0]);
	        		});
				}
		    })
		}

	</script>

@endsection