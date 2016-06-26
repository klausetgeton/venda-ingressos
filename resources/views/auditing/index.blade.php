@extends('index')

@section('content')

	<div class="container">

		<ol class="breadcrumb" style="margin-bottom: 5px;">
		    <li><a href='/'>Início</a></li>
		    <li class="active">Auditoria</li>
		</ol>

		<h3>Auditoria</h3>

		<table id="dList" class="table table-striped table-hover dt-responsive nowrap" width="100%">
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
			<tfoot>
				<tr>
					<th>Usuário</th>
					<th>Tabela</th>
					<th>Id do registro</th>
					<th>Operação</th>
					<th>Valor Antigo</th>
					<th>Valor Novo</th>
					<th>Data</th>
				</tr>
			</tfoot>
		</table>
	</div>

@endsection

@section('scripts')
	<script type="text/javascript">
		<?php $model = "Log";	 ?>
		$( document ).ready(function() {
			$('#dList').DataTable({
				processing: true,
				serverSide: true,
				dom: 'lBfrtip',
		        buttons: [
		            'copy', 'csv', 'excel', 'pdf', 'print'
	        	],
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
				initComplete: function () {
		            this.api().columns(['0', '1', '2', '3']).every(function () {
		                var column = this;
		                var input = document.createElement("input");
		                input.className = 'form-control input-sm';
		                $(input).appendTo($(column.footer()).empty())
		                .on('change', function () {
		                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
		                    column.search(val ? val : '', true, false).draw();
		                });
		            });
		        },
			});
		});

	</script>
@endsection