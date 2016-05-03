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
				<form class="form-inline" role="form">
					<div class="form-group">
						<label for="search">Nome:</label>
						<input type="search" class="form-control" id="search">
					</div>
					<button type="submit" class="btn btn-default">Buscar</button>
				</form>

				<table id="resultsTable" class="table">
					<thead>
						<tr>
							<th>Id</th>
							<th>Nome</th>
							<th>Ação</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>

				<ul class = "pagination">
					<li><a href = "#">&laquo;</a></li>
					<li><a href = "#">1</a></li>
					<li><a href = "#">2</a></li>
					<li><a href = "#">3</a></li>
					<li><a href = "#">4</a></li>
					<li><a href = "#">5</a></li>
					<li><a href = "#">&raquo;</a></li>
				</ul>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
			</div>
		</div>

	</div>
</div>


<script type="text/javascript">				
	$( "form" ).submit(function( event ) {
		event.preventDefault();
		var search = $("#search").val();
		$.get(`/teste-ajax/{!!$model !!}/{!!$search_column!!}/${search} `, function (users) {	
			$('#resultsTable tbody > tr').remove();	 

			$.each(users, function (key, value) {
				$("#resultsTable").find('tbody')
				.append($('<tr>')
					.append($('<td>')
						.append(value.id)								            
						)
					.append($('<td>')
						.append(value.name)
						)
					.append($('<td>')
						.append('<a href="javascript:selectFromModalTable(\''+value.id+'\',\''+value.name+'\');" class="btn btn-default btn-sm" role="button">Selecionar</a>')
						)								        						          
					);
			});


		});
	});     

	function selectFromModalTable(id, text) {				    	    	  
		$( "#{!! $id_field !!}" ).val(id);
		$( "#{!! $description_field !!}" ).val(text);	
		$( "#searchModal" ).modal("hide");				       				        
	} 

</script>