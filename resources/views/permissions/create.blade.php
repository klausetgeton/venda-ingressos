@extends('index')

@section('content')

    <div class="container">
        <h1>Permissões do {{$type == "user" ? "Usuário" : "Grupo"}}</h1>
        <br/>
        <br/>

        {!! Form::open(array('action' => array('PermissionsController@store', $type ))) !!}


        <div class="form-group">
            {!! Form::label('o_id', 'Usuário:') !!}
            {!! Form::modalSeek((isset($object) ?$object->id :null ), 'o_id', 'o_name', ($type == "user" ? "User" : "Role"), 'name' ,[]) !!}
        </div>

        <table class="table table-striped table-bordered table-hover">
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


            @for ($m = 0; $m < count($models); $m++)
                <tr>
                    <td>
                        {{ $models[$m]}}
                    </td>
                    @for($p = 0; $p < count($permissions); $p++)
                        @if ($permissions[$p]->model == $models[$m] )
                            <td>
                                {{ Form::checkbox('permissions[]',$permissions[$p]->id, ( isset($object) ? $object->hasThisP($permissions[$p]->id) : null), null) }}
                                {{ $permissions[$p]->name }}
                            </td>
                        @endif
                    @endfor
                </tr>
            @endfor

            </tbody>
        </table>

        <div class="form-group">
            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>

    </div>
    <script>
        $( "#o_id" ).change(function() {
            var id = $( "#o_id" ).val();

            if(id > 0)
            {
                window.location.replace("{{route('permissions.edit')}}/{{$type}}/" + id);
            }
        });


        $( "#o_id" ).on('value_changed', function(e){
            console.log('value changed to '+$(this).val());
            window.location.replace("{{route('permissions.edit')}}/{{$type}}/" + id);
        });
    </script>
@endsection

