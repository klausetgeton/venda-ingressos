<script type="text/javascript">
	$(".select2-ajax").select2({
		multiple:true,
		minimumInputLength: 2,		
		ajax: {
			url: '{!! route('select2.data', ['model' => 'User', 'column' => 'name'] ) !!}',
			dataType: 'json',
			delay: 250,	    			   
			data: function (params) {
				return {
					q: params.term, // search term
					page: params.page
				};
			},
			processResults: function (data, params) {		      
				params.page = params.page || 1;

				return {
					results: $.map(data, function (item) {
						return {
							text: item.name,
							id: item.id
						}
					})
				};
			},
			cache: true
		},
		escapeMarkup: function (markup) { 
			return markup; 
		} 
	});
</script>