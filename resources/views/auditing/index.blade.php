@extends('index')

@section('content')

@role('admin')
	
		<div class="container">
		<h1>Auditoria</h1>		
		<br />
		<br />

		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>Id</th>
					<th>Usuário</th>
					<th>Valor Antigo</th>
					<th>Valor Novo</th>
					<th>Tabela</th>
					<th>Data</th>
				</tr>
			</thead>
			<tbody>
				@foreach($logs as $log)
					<tr>
						<td>{{ $log->id }}</td>
						<td>{{ $log->user->id }} - {{ $log->user->name }}</td>
						<td>{{ json_encode($log->old_value) }}</td>
						<td>{{ json_encode($log->new_value) }}</td>
						<td>{{ $log->owner_type }}</td>
						<td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

@else
	<script>
		swal("Acesso Negado!", "", "error");
	</script>
@endrole


@endsection