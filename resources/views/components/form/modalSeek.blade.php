<div class="form-inline">	
	{!! Form::number($form_id_field, $value, ['class'=>'form-control', 'style'=>'width:10%;']) !!}

	{!! Form::label($form_description_field, ' ') !!}
	{!! Form::text($form_description_field, null, ['class'=>'form-control', 'style'=>'width:80%;', 'disabled']) !!}
	<a class="btn btn-info" style="width:9%;" data-toggle="modal" data-target="#searchModal">Procurar</a>
</div>

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
				<table id="resultsTable" class="table table-striped table-bordered table-hover">
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
			ajax: '{!! route('datatables.data', ['model' => $model]) !!}',
			columns: [
				{ data: 'id', name: 'id' },
				{ data: '{!! $description_column !!}', name: '{!! $description_column !!}' },
				{ data: null, render: function ( data, type, row ) {
					return "<a href=\"javascript:selectFromModalTable(\'" +data.id + "\',\'" +data.name+ "\');\" class=\"btn btn-default btn-sm\" role=\"button\">Selecionar</a>"
				}, orderable: false, "bSearchable": false },
			],
			"language": {
				"url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Portuguese-Brasil.json"
			},
			"order": [[ 0, "desc" ]],
		});
	}

	function selectFromModalTable(id, text) {
		//change value
		$( "#{!! $form_id_field !!}" ).val(id);
		$( "#{!! $form_description_field !!}" ).val(text);
		
		//hide modal window
		$( "#searchModal" ).modal("hide");
		
		//aditional calls
		{{$adc_call}}
	}

	$( "#{{$form_id_field}}" ).change(function() {
		var id = $( "#{{$form_id_field}}" ).val();

		if(id != null) {
			$.ajax({
				url: '{{ route('seek.data') }}/{{$model}}/{{$description_column}}/' + id,
				dataType: 'json',
				timeout: 200000,
				success: function (data) {
					if (data.length == 1) {
						$.each(data, function (index, element) {
									selectFromModalTable(element.id, element.name);
								}
						);
					}
					else {
						selectFromModalTable(null, null);
					}
				}
			})
		}

	});

</script>