@extends('index')

@section('content')

	<div class="container">

	 	<ol class="breadcrumb" style="margin-bottom: 5px;">
            <li><a href='/'>Início</a></li>
            <li class="active">Ingressos Vendidos</li>
        </ol>
		<h3>Ingressos Vendidos</h3>

		<table id="dList" class="table table-striped table-hover dt-responsive nowrap">
			<thead>
				<tr>
					<th>ID</th>
					<th>ID do Usuário</th>
					<th>Usuário</th>
					<th>ID do Evento</th>
					<th>Evento</th>
					<th>ID do Lote</th>
					<th>Lote</th>
					<th>Assento</th>
					<th>Valor</th>
					<th>Data da compra</th>
					<th>Data da pagamento</th>
					<th>Data da cancelamento</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>ID</th>
					<th>ID do Usuário</th>
					<th>Usuário</th>
					<th>ID do Evento</th>
					<th>Evento</th>
					<th>ID do Lote</th>
					<th>Lote</th>
					<th>Assento</th>
					<th>Valor</th>
					<th>Data da compra</th>
					<th>Data da pagamento</th>
					<th>Data da cancelamento</th>
				</tr>
			</tfoot>
		</table>
		</div>
@endsection

@section('scripts')
	<script>
		var table;
		<?php $model = 'IngressoVendido';	 ?>
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
					{ data: 'user.id', name: 'user.id' },
					{ data: 'user.name', name: 'user.name' },
					{ data: 'lote.evento.id', name: 'lote.evento.id' },
					{ data: 'lote.evento.nome', name: 'lote.evento.nome' },
					{ data: 'lote.id', name: 'lote.id' },
					{ data: 'lote.nome', name: 'lote.nome' },
					{ data: 'possibilidade_compra.nome', name: 'possibilidade_compra.nome' },
					{ data: 'valor', name: 'valor' },
					{ data: 'data_compra', name: 'data_compra' },
					{ data: 'data_pagamento', name: 'data_pagamento' },
					{ data: 'data_cancelamento', name: 'data_cancelamento' },
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