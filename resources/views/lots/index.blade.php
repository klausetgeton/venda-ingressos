@extends('index')

@section('content')

<meta name="_token" content="{{ csrf_token() }}" />

<div class="container">

	<link rel="stylesheet" href="/css/breadcrumb.css">

	<ol class="progtrckr">
   		<li class="progtrckr-done">Evento</li>		    
   		<li class="progtrckr-done">Patrocinadores</li>
   		<li class="progtrckr-todo">Lotes</li>
	    <li class="progtrckr-todo">Descontos</li>
    </ol>	

	<h1>Lotes</h1>			

	<div id="formErrors" style="visibility: hidden">				
	</div>

	@if (session('message') == 'ok')		
	<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			Operação realizada com sucesso.
	</div>
	@endif		

	{!! Form::open(array('name' => 'lotForm', 'method'=>'POST', 'id' => 'lotForm', 'url' => '')) !!}	
	
		{!! Form::hidden('id', null, ['class'=>'form-control']) !!}
		{!! Form::hidden('eventos_id', session()->get('event_id'), ['class'=>'form-control']) !!}
		
		<div class="form-group">
			{!! Form::label('nome', 'Nome:*') !!}
			{!! Form::text('nome', Input::old('nome'), ['class'=>'form-control']) !!}
		</div>
			
		<div class="form-group">
			{!! Form::label('dt_inicio', 'Data de início das vendas:*') !!}
			{!! Form::date('dt_inicio', Input::old('dt_inicio'), ['class'=>'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('dt_fim', 'Data de fim das vendas:*') !!}
			{!! Form::date('dt_fim', Input::old('dt_fim'), ['class'=>'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('quantidade', 'Quantidade:*') !!}
			{!! Form::number('quantidade', Input::old('quantidade'), ['class'=>'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('valor_masculino', 'Valor do ingresso masculino:*') !!}
			{!! Form::text('valor_masculino', Input::old('valor_masculino'), ['class'=>'form-control']) !!}
		</div>		

		<div class="form-group">
			{!! Form::label('valor_feminino', 'Valor do ingresso feminino:*') !!}
			{!! Form::text('valor_feminino', Input::old('valor_feminino'), ['class'=>'form-control']) !!}
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
				<th>Nome</th>
				<th>Início das vendas</th>
				<th>Fim das vendas</th>
				<th>Quantidade</th>
				<th>Valor do ingresso masculino</th>
				<th>Valor do ingresso feminino</th>
				<th>ID do Evento</th>
				<th>Evento</th>
				<th>Ação</th>
				
			</tr>
		</thead>	
	</table>

	<a class="btn btn-primary" href="{{ route('sponsors.index') }}"><< Etapa Anterior</a>
	<a class="btn btn-primary" href="{{ route('discounts.index') }}">Próxima Etapa >></a>
	</br>
	</br>
</div>


<script src="/js/jquery.maskMoney.min.js" type="text/javascript"></script>
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

	<?php $model = "Lote";	 ?>
	function loadTable(){			
		table = $('#dList').DataTable({
			bFilter: false,
			processing: true,
			serverSide: true,			
		    ajax: {
	            url: '{!! route('datatables.data', ['model' => $model]) !!}',
	            //aditional paramether to the query
	            data: function (query) {
	                query.eventos_id = '{{ session()->get('event_id') }}';
	            }
        	},
			columns: [
				{ data: 'id', name: 'id' },
				{ data: 'nome', name: 'nome' },			
				{ data: 'dt_inicio', name: 'dt_inicio' },
				{ data: 'dt_fim', name: 'dt_fim' },
				{ data: 'quantidade', name: 'quantidade' },
				{ data: 'valor_masculino', name: 'valor_masculino' },			
				{ data: 'valor_feminino', name: 'valor_feminino' },
				{ data: 'eventos_id', name: 'eventos_id' },
				{ data: 'evento.nome', name: 'evento.nome' },	
				{ data: null, render: function ( data, type, row ) {    
					return "<a href=\"javascript:editFromTable(\'" + data.id + "\')\" class='btn-sm btn-success'>Editar</a>"
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
	$( '#lotForm' ).submit(function (evt) 
		{
		evt.preventDefault();

		$.ajaxSetup({
			header:$('meta[name="_token"]').attr('content')
		})
				
		//get form fields data
		var formData = $(this).serializeArray();	

		//replace money format 
		for (index = 0; index < formData.length; ++index) 
		{
		    if (formData[index].name == "valor_masculino" || formData[index].name == "valor_feminino") 
		    {		    	
		    	var formated =  formData[index].value.replace(/\./g, ''); // replace . thousands separator		    	
		    	formated = formated.replace(/\,/g, '\.'); // replace , decimal separator
		    	
		        formData[index].value = formated;			       
    		}
		}

	    $.ajax({
	        type: 'POST',
	        url: '{{route('lots.store')}}',		            
	        data: formData,
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
        		 $.each( errors, function( key, value ) {
            		console.log(value[0]);
        		});
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
		$('#descricao').val("");
		$('input[name="nome"').val("");
		$('input[name="dt_fim"').val("");
		$('input[name="dt_inicio"').val("");
		$('input[name="quantidade"').val("");
		$('input[name="valor_feminino"').val("");
		$('input[name="valor_masculino"').val("");		
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
	        url: 'lots/delete/' + id,	        
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
	        url: 'lots/edit/' + id,
	        dataType: 'json',	
	        data: {_token:$('meta[name="_token"]').attr('content')},       
	        success: function(data)
	        {	         	        
				$('input[name="id"').val(data.id);					
				$('#descricao').val(data.descricao);	
				$('input[name="nome"').val(data.nome);
				$('input[name="dt_fim"').val(data.dt_fim);
				$('input[name="dt_inicio"').val(data.dt_inicio);
				$('input[name="quantidade"').val(data.quantidade);
				$('input[name="valor_feminino"').val(data.valor_feminino);
				$('input[name="valor_masculino"').val(data.valor_masculino);		
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
	
	//some masks
	jQuery(function($){
		$("#valor_masculino").maskMoney({prefix:'R$ ', thousands:'.', decimal:',', affixesStay: false});
		$("#valor_feminino").maskMoney({prefix:'R$ ', thousands:'.', decimal:',', affixesStay: false});
	});


</script>

@endsection