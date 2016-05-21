@extends('index')

@section('content')

    <div class="container">
        <h1>Permissões do {{$type == "user" ? "Usuário" : "Grupo"}}</h1>

        @if ($errors->any())
            <ul class="alert alert-warning">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        @if (session('message') == 'ok')
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Operação realizada com sucesso.
            </div>
        @endif

        {!! Form::open(array('action' => array('PermissionsController@store', $type ))) !!}

        <div class="form-group">
            {{ Form::label('o_id', ($type == "user" ? "Usuário" : "Grupo") . ':') }}
            {!! Form::modalSeek((isset($object) ?$object->id :null ), 'o_id', 'o_name', ($type == "user" ? "User" : "Role"), 'name' , 'loadPermissions();', []) !!}
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

    </div>
    <script>
        $( "#o_id" ).change(function() {
            var id = $( "#o_id" ).val();
            var name = $( "#o_name" ).val();

            if(id > 0 && name != '')
            {
                loadPermissions(id);
            }
        });


        function loadPermissions (id)
        {            
            var id = $( "#o_id" ).val();
            var name_length = $("#o_name").val().trim().length;
            
            if(id > 0 && name_length > 0 )
            {
                id = $( "#o_id" ).val();
                window.location.replace("{{route('permissions.edit')}}/{{$type}}/" + id);
            }
        }

        $( document ).ready(function() 
        {
            $( "#o_name" ).val("{{ isset($object) ? $object->name : null }}");
        });
    </script>
@endsection