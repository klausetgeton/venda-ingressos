@extends('index')

@section('content')

	
	<div class="container">
		<h1>Auditoria</h1>		
		<br />
		<br />

		<table id="dList" class="table table-striped  table-hover">
			<thead>
				<tr>
					<th>Usuário</th>
					<th>Tabela</th>
					<th>Id do registro</th>
					<th>Operação</th>
					<th>Valor Antigo</th>
					<th>Valor Novo</th>
					<th>Data</th>
				</tr>
			</thead>			
		</table>
	</div>

	<script type="text/javascript">
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

		<?php $model = "Log";	 ?>
		function loadTable(){			
			$('#dList').DataTable({
				processing: true,
				serverSide: true,
				ajax: '{!! route('datatables.data', ['model' => $model]) !!}',
				columns: [
				{ data: 'user.name', name: 'user.name' },
				{ data: 'owner_type', name: 'owner_type' },				
				{ data: 'owner_id', name: 'owner_id' },
				{ data: 'type', name: 'type' },
				{ data: 'old_value',
					render: function ( data ) 
					{
						return JSON.stringify( data );
					}, 
					orderable: false, "bSearchable": false
				},	
				{ data: 'new_value',
				  	render: function ( data ) 
				 	{
				    	return JSON.stringify( data );
					}, 
				  	orderable: false, "bSearchable": false			
				},	
				{ data: 'created_at', name: 'created_at' },							
				],
				"language": {
					"url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Portuguese-Brasil.json"
				},
				"order": [[ 0, "desc" ]],
			});	
		}

	</script>
@endsection