<div class="container-listagem">
	<table class="table table-striped table-bordered table-hover listagem-roles">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nome amigável</th>
				<th>Nome identificador</th>
				<th>Ação</th>
			</tr>
		</thead>
		<tbody>
			@foreach($roles as $role)
				<tr>
					<td>{{ $role->id }}</td>
					<td>{{ $role->name }}</td>
					<td>{{ $role->slug }}</td>
					<td>
						<a href="{{ route('roles.edit',['id'=>$role->id]) }}" class="btn-sm btn-success">Editar</a>
						<a href="javascript:showConfirmDeleteDialog(' {{ route('roles.delete',['id'=>$role->id]) }} ');" class="btn-sm btn-danger">Remover</a>			
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	{{ $roles->render() }}	
</div>