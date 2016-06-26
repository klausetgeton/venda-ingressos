@extends('index')

@section('content')

	<meta name="_token" content="{{ csrf_token() }}" />

	<div class="container">

		<link rel="stylesheet" href="/css/breadcrumb.css">

		<ol class="progtrckr">
	   		<li class="progtrckr-done">Evento</li>
	   		<li class="progtrckr-todo">Patrocinadores</li>
		    <li class="progtrckr-todo">Descontos</li>
	   		<li class="progtrckr-todo">Lotes</li>
	    </ol>

		<h3>Patrocinadores</h3>

		<div id="formErrors" style="visibility: hidden ">
		</div>

		{!! Form::open(array('name' => 'sponsorForm', 'method'=>'POST', 'id' => 'sponsorForm', 'url' => '')) !!}

			{!! Form::hidden('id', null, ['class'=>'form-control']) !!}
			{!! Form::hidden('eventos_id', session()->get('event_id'), ['class'=>'form-control']) !!}

			<!-- Nome Form Input -->
			<div class="form-group">
				{!! Form::label('nome', 'Nome:*') !!}
				{!! Form::text('nome', Input::old('nome'), ['class'=>'form-control']) !!}
			</div>

			<!-- descricao Form Input -->
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
					<th>Nome</th>
					<th>Descrição</th>
					<th>Ação</th>
				</tr>
			</thead>
		</table>

		<a class="btn btn-primary" href="{{ route('events.edit', ['id' => session()->get('event_id')]) }}">
			<i class="fa fa-arrow-left" aria-hidden="true"></i>
			Etapa Anterior
		</a>
		<a class="btn btn-primary" href="{{ route('discounts.create') }}">
			Próxima Etapa
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
				else
				{

				}
			});
		}

		<?php $model = "Patrocinador";	 ?>
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
				{ data: 'nome', name: 'nome' },
				{ data: 'descricao', name: 'descricao' },
				{ data: null, render: function ( data, type, row ) {
					return "<a href=\"javascript:editFromTable(\'" + data.id + "\' , \'" + data.nome + "\' , \'" + data.descricao + "\' )\" class='btn-sm btn-success'><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i> Editar</a>"
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
		$( '#sponsorForm' ).submit(function (evt)
			{
			evt.preventDefault();

			$.ajaxSetup({
				header:$('meta[name="_token"]').attr('content')
			})

		    $.ajax({
		        type: 'POST',
		        url: '{{route('sponsors.store')}}',
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
			$('input[name="nome"').val("");
			$('textarea[name="descricao"').val("");
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
		        url: '/admin/sponsors/delete/' + id,
		        dataType: 'json',
		        data: {_token:$('meta[name="_token"]').attr('content')},
		        success: function(data)
		        {
		         	refreshDataTable();
				},
				error:function(data){
		    		console.log("error! " +data);
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
		        url: '/admin/sponsors/edit/' + id,
		        dataType: 'json',
		        data: {_token:$('meta[name="_token"]').attr('content')},
		        success: function(data)
		        {
					$('input[name="id"').val(data.id);
					$("#nome").val(data.nome);
					if(data.descricao == "null")
					{
						$("#descricao").val("");
					}else
					{
						$("#descricao").val(data.descricao);
					}
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