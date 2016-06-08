@extends('index')

@section('content')

<div class="container">

	@if (session('message') == 'ok')		
	<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Operação realizada com sucesso.
	</div>
	@endif		

	<h1>Locais</h1>		
	<a href="{{ route('places.create') }}" class="btn btn-default">Novo Local</a>
	<br />
	<br />

	<table id="dList" class="table table-striped  table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nome</th>				
				<th>Descrição</th>											
				<th>Ação</th>
			</tr>
		</thead>	
	</table>
</div>

<script>
	function showConfirmDeleteDialog(link) {
		swal({   
			title: "Deseja apagar o registro?",   
			text: "A ação não poderá ser desfeita",   
			type: "warning",   
			showCancelButton: true,   
			confirmButtonColor: "#DD6B55",   
			confirmButtonText: "Apagar",   
			cancelButtonText: "Cancelar",   
			closeOnConfirm: false,   
			closeOnCancel: true
		}, 

		function(isConfirm)
		{   
			if (isConfirm) 
			{     
				window.location.assign(link);
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

	<?php $model = "Local"; ?>
	function loadTable(){			
		$('#dList').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{!! route('datatables.data', ['model' => $model]) !!}',
			columns: [
			{ data: 'id', name: 'id' },
			{ data: 'nome', name: 'nome' },						
			{ data: 'nome', name: 'nome' },			
			{ data: null, render: function ( data, type, row ) {    
				return "<a href=\"/admin/places/edit/" + data.id +  "\"class=\"btn-sm btn-success\">Editar</a>" + 
				"<a href=\"javascript:showConfirmDeleteDialog(\'/admin/places/delete/" + data.id + "\')\" class=\"btn-sm btn-danger\">Apagar</a>";
			}, orderable: false, "bSearchable": false },			
			],
			"language": {
				"url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Portuguese-Brasil.json"
			},
			"order": [[ 0, "desc" ]],
		});	
	}
</script>

@endsection