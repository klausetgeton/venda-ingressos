@extends('index')

@section('content')

@role('admin')
	<div class="container">
		<h1>Usuários</h1>		
		<a href="{{ route('users.create') }}" class="btn btn-default">Novo Usuário</a>
		<br />
		<br />

		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th>Nome</th>
					<th>Email</th>
					<th>Ação</th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $role)
					<tr>
						<td>{{ $role->id }}</td>
						<td>{{ $role->name }}</td>
						<td>{{ $role->email }}</td>
						<td>
							<a href="{{ route('users.edit',['id'=>$role->id]) }}" class="btn-sm btn-success">Editar</a>
						<!--	<a href="{{ route('users.edit',['id'=>$role->id]) }}" class="btn-sm btn-danger">Remover</a>	-->				
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	@if (isset($message))
		<script>
			swal("Operação concluída com sucesso!", "", "success");
		</script>
	@endif

@else
	<script>
		swal("Acesso Negado!", "", "error");
	</script>
@endrole


@endsection