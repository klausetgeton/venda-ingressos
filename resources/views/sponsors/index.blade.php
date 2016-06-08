@extends('index')

@section('content')

<meta name="_token" content="{{ csrf_token() }}" />

<div class="container">

	<link rel="stylesheet" href="/css/breadcrumb.css">

	<ol class="progtrckr">
   		<li class="progtrckr-done">Evento</li>		    
   		<li class="progtrckr-todo">Patrocinadores</li>
   		<li class="progtrckr-todo">Lotes</li>
	    <li class="progtrckr-todo">Descontos</li>
    </ol>	

	<h1>Patrocinadores</h1>			

	@if (session('message') == 'ok')		
	<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			Operação realizada com sucesso.
	</div>
	@endif		

	{!! Form::open(array('name' => 'sponsorForm', 'method'=>'POST', 'id' => 'sponsorForm', 'url' => '')) !!}	
	
		{!! Form::hidden('id', null, ['class'=>'form-control']) !!}
		{!! Form::hidden('eventos_id', session()->get('event_id'), ['class'=>'form-control']) !!}
	
		<!-- Nome Form Input -->
		<div class="form-group">
			{!! Form::label('nome', 'Nome:') !!}
			{!! Form::text('nome', Input::old('nome'), ['class'=>'form-control', 'required' => 'true']) !!}
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

	<a class="btn btn-primary" href="{{ route('events.edit', ['id' => session()->get('event_id')]) }}"><< Etapa Anterior</a>
	<a class="btn btn-primary" href="{{ route('lots.index') }}">Próxima Etapa >></a>
	</br>
	</br>

</div>

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

	$(function() {
		try{
			loadTable();			
		}catch(err){	    		
			$.getScript('/js/jquery.dataTables.min.js', function() {
				$.getScript('/js/dataTables.bootstrap.min.js', function() {
					loadTable();
				});
			});
		}
	});

	<?php $model = "Patrocinador";	 ?>
	function loadTable(){			
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
				return "<a href=\"javascript:editFromTable(\'" + data.id + "\' , \'" + data.nome + "\' , \'" + data.descricao + "\' )\" class='btn-sm btn-success'>Editar</a>"
				+ "<a href=\"javascript:showConfirmDeleteDialog(\'" + data.id + "\')\" class=\"btn-sm btn-danger\">Apagar</a>";
			}, orderable: false, "bSearchable": false },			
			],
			"language": {
				"url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Portuguese-Brasil.json"
			},
			"order": [[ 0, "desc" ]],
		});	
	}


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
	         	resetForm();
	         	refreshDataTable();
			},
			error:function(data){ 
	    		console.log("error! " +data);
			}
	    })          	        
	});

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
	        url: 'sponsors/delete/' + id,	        
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
	        url: 'sponsors/edit/' + id,
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