@extends('index')

@section('content')

	<div class="container">

		<ol class="breadcrumb" style="margin-bottom: 5px;">
		    <li><a href='/'>Início</a></li>
		    <li class="active">Patrocinadores</li>
		</ol>

		<h3>Patrocinadores</h3>

		<table id="dList" class="table table-striped table-hover dt-responsive nowrap">
			<thead>
				<tr>
					<th>ID</th>
					<th>Nome</th>
					<th>Descrição</th>
					<th>ID do Evento</th>
					<th>Evento</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>ID</th>
					<th>Nome</th>
					<th>Descrição</th>
					<th>ID do Evento</th>
					<th>Evento</th>
				</tr>
			</tfoot>
		</table>

	</div>
@endsection

@section('scripts')
	<script>
		<?php $model = "Patrocinador";	 ?>
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
				{ data: 'id', name: 'id' },
				{ data: 'nome', name: 'nome' },
				{ data: 'descricao', name: 'descricao' },
				{ data: 'evento.id', name: 'evento.id' },
				{ data: 'evento.nome', name: 'evento.nome' },
				],
				"language": {
					"url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Portuguese-Brasil.json"
				},
				"order": [[ 0, "desc" ]],
				initComplete: function () {
	            this.api().columns().every(function () {
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