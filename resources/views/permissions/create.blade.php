@extends('index')

@section('content')

    <meta name="_token" content="{{ csrf_token() }}" />

    <div class="container">

        <ol class="breadcrumb" style="margin-bottom: 5px;">
            <li><a href="/">Início</a></li>
            <li><a href="#">Permissões</a></li>
            <li class="active">Permissões do {{$type == "user" ? "Usuário" : "Grupo"}}</li>
        </ol>

        <h3>Permissões do {{$type == "user" ? "Usuário" : "Grupo"}}</h3>

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

        <div id="tableDiv" name="tableDiv">
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        $( "#o_id" ).change(function() {
            var id = $( "#o_id" ).val();
            var name = $( "#o_name" ).val();

            if(id > 0 && name != '')
            {
                loadPermissions();
            }
        });

        function loadPermissions ()
        {
            var id = $( "#o_id" ).val();
            var name_length = $("#o_name").val().trim().length;

            if(id > 0 && name_length > 0 )
            {
                $.ajaxSetup({
                   header:$('meta[name="_token"]').attr('content')
                })

                $.ajax({
                    type: 'POST',
                    url: '{{route('permissions.table')}}/{{$type}}/' + id,
                    data: { _token : $('meta[name="_token"]').attr('content') },
                    success: function(data)
                    {
                        $('#tableDiv').empty();
                        $('#tableDiv').append(data);
                    },
                    error:function(data){
                        var errors = data.responseJSON;
                        $('#tableDiv').empty();
                        $('#tableDiv').html(data);
                    }
                })
            }
        }

        $( document ).ready(function()
        {
            $( "#o_name" ).val("{{ isset($object) ? $object->name : null }}");
            loadPermissions();
        });
    </script>
@endsection