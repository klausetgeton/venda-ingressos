@extends('index')

@section('content')

@role('admin')
	
		<div class="container">
		<h1>Auditoria</h1>		
		<br />
		<br />

		<table id="dList" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>Usuário</th>
					<th>Id do registro</th>
					<th>Valor Antigo</th>
					<th>Valor Novo</th>
					<th>Tabela</th>
					<th>Data</th>
				</tr>
			</thead>			
		</table>
	</div>

@else
	<script>
		swal("Acesso Negado!", "", "error");
	</script>
@endrole


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
			{ data: 'owner_id', name: 'owner_id' },
			{ data: 'old_value', name: 'old_value' },	
			{ data: 'new_value', name: 'new_value' },	
			{ data: 'owner_type', name: 'owner_type' },				
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