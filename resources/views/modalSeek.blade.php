<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

<!-- Modal -->
<div id="searchModal" class="modal" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Busca</h4>
			</div>
			<div class="modal-body">			
				<table id="resultsTable" class="table">
					<thead>
						<tr>
							<th>Id</th>
							<th>{!! $description_column !!}</th>
							<th>Ação</th>
						</tr>
					</thead>			
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
			</div>
		</div>

	</div>
</div>


<script>	
	$(function() {
		try{
			loadTable();
			console.log("entrou no try");	    	  
		}catch(err){	    		
			$.getScript('/js/jquery.dataTables.min.js', function() {
				$.getScript('/js/dataTables.bootstrap.min.js', function() {
					loadTable();
				});
			});
		}
	});

	function loadTable(){			
		$('#resultsTable').DataTable({
			processing: true,
			serverSide: true,
			ajax: 'datatables.data/{!! $model !!}',
			columns: [
			{ data: 'id', name: 'id' },
			{ data: '{!! $description_column !!}', name: '{!! $description_column !!}' },
			{ data: null, render: function ( data, type, row ) {    
				return "<a href=\"javascript:selectFromModalTable(\'" +data.id + "\',\'" +data.name+ "\');\" class=\"btn btn-default btn-sm\" role=\"button\">Selecionar</a>"	
			}, orderable: false, "bSearchable": false },
			],
			"language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Portuguese-Brasil.json"
            }
		});	
	}

	function selectFromModalTable(id, text) {				    	    	  
		$( "#{!! $form_id_field !!}" ).val(id);
		$( "#{!! $form_description_field !!}" ).val(text);	
		$( "#searchModal" ).modal("hide");				       				        	 		
	} 

</script>