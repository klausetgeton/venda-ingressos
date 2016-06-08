@extends('index')

@section('content')

<div class="container">

	@if (session('message') == 'ok')		
	<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			Operação realizada com sucesso.
	</div>
	@endif		

	<h1>Grupos</h1>		
	<a href="{{ route('roles.create') }}" class="btn btn-default">Novo Grupo</a>
	<br />
	<br />

	<table id="dList" class="table table-striped table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nome</th>				
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

	<?php $model = "Role";	 ?>
	function loadTable(){			
		$('#dList').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{!! route('datatables.data', ['model' => $model]) !!}',
			columns: [
			{ data: 'id', name: 'id' },
			{ data: 'name', name: 'name' },			
			{ data: null, render: function ( data, type, row ) {    

				return "<a href=\"/admin/roles/edit/" + data.id +  "\"class=\"btn-sm btn-success\">Editar</a>" + 
				"<a href=\"javascript:showConfirmDeleteDialog(\'/admin/roles/delete/" + data.id + "\')\" class=\"btn-sm btn-danger\">Apagar</a>";
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