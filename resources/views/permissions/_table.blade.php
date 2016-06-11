<table class="table table-striped table-hover dt-responsive nowrap" width="100%">
    <thead>
        <tr>
            <th>Tabela</th>
            <th>Listar</th>
            <th>Criar</th>
            <th>Editar</th>
            <th>Apagar</th>
        </tr>
    </thead>
    <tbody>

    <?php $models = array("User", "Permission", "Role") ?>

    @foreach ($models as $model)
        <tr>
            <td>
                {{$model}}
            </td>
            @foreach($permissions as $permission)
                @if ($permission->model == $model )
                    <td>
                        {{ Form::checkbox('permissions[]',$permission->id, ( isset($object) ? $object->hasThisP($permission->id) : null), null) }}
                        {{ $permission->name }}
                    </td>
                @endif
            @endforeach
        </tr>
    @endforeach

    </tbody>
</table>

<div class="form-group">
    {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}
</div>