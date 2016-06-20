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

		<table id="dList" class="table table-striped table-hover dt-responsive nowrap">
			<thead>
				<tr>
					<th>ID</th>
					<th>Nome</th>				
					<th>Ação</th>
				</tr>
			</thead>	
			<tfoot>
				<tr>
					<th>ID</th>
					<th>Nome</th>				
					<th>Ação</th>
				</tr>
			</tfoot>
		</table>
	</div>
@endsection

@section('scripts')
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
		
		<?php $model = "Role";	 ?>
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
				{ data: 'name', name: 'name' },			
				{ data: null, render: function ( data, type, row ) {    
					return "<a href=\"/admin/roles/edit/" + data.id +  "\"class=\"btn-sm btn-success\"><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i> Editar</a>" + 
					"<a href=\"javascript:showConfirmDeleteDialog(\'/admin/roles/delete/" + data.id + "\')\" class=\"btn-sm btn-danger\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i> Apagar</a>";
				}, orderable: false, "bSearchable": false },			
				],
				"language": {
					"url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Portuguese-Brasil.json"
				},
				"order": [[ 0, "desc" ]],
				initComplete: function () {
		            this.api().columns(['0', '1']).every(function () {
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