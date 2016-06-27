<table class="table table-striped table-hover dt-responsive nowrap" width="100%">
    <thead>
        <tr>
            <th>Tabela</th>
            <th colspan="4">Permissões</th>
        </tr>
    </thead>
    <tbody>

    <?php $models = array('Usuário', 'Permissão', 'Grupo','Evento', 'Local', 'Ingresso Vendido', 'Desconto', 'Lote', 'Patrocinador', 'Auditoria') ?>

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