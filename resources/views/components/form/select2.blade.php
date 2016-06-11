<select id="{{$name}}[]" name="{{$name}}[]" multiple class="form-control select2-ajax">
	@foreach ($value as $item)
    	<option value="{{$item->id}}" selected>{{$item->$description_column}}</option>
   	@endforeach
</select>

@section('component-scripts')
	<script type="text/javascript">
		$(".select2-ajax").select2({
			multiple:{{$is_multiple}},
			minimumInputLength: 2,
			ajax: {
				url: '{!! route('select2.data', ['model' => $model, 'column' => $description_column] ) !!}',
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
@endsection