@extends('index')

@section('content')

	<div class="container">

		<ol class="breadcrumb" style="margin-bottom: 5px;">
		    <li><a href='/'>Início</a></li>
		    <li class="active">Descontos</li>
		</ol>

		<h3>Descontos</h3>

		<table id="dList" class="table table-striped table-hover dt-responsive nowrap">
			<thead>
				<tr>
					<th>ID</th>
					<th>Descrição</th>
					<th>Hash</th>
					<th>Quantidade</th>
					<th>Desconto</th>
					<th>ID do Evento</th>
					<th>Evento</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>ID</th>
					<th>Descrição</th>
					<th>Hash</th>
					<th>Quantidade</th>
					<th>Desconto</th>
					<th>ID do Evento</th>
					<th>Evento</th>
				</tr>
			</tfoot>
		</table>
	</div>
@endsection
@section('scripts')
	<script>
		var table;

		<?php $model = "Desconto";	 ?>
		$( document ).ready(function() {
			table = $('#dList').DataTable({
				processing: true,
				serverSide: true,
				dom: 'lBfrtip',
		        buttons: [
		            'copy', 'csv', 'excel', 'pdf', 'print'
        		],
			    ajax: '{!! route('datatables.data', ['model' => $model]) !!}',
				columns: [
				{ data: 'id', name: 'id' },
				{ data: 'descricao', name: 'descricao' },
				{ data: 'hash', name: 'hash' },
				{ data: 'quantidade', name: 'quantidade' },
				{ data: 'porcentagem', name: 'porcentagem' },
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