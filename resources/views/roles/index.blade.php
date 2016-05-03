@extends('index')

@section('content')

	<div class="container">
		<h1>Grupos</h1>		
		<a href="{{ route('roles.create') }}" class="btn btn-default">Novo Grupo</a>
		<br />
		<br />

		@include('roles._rolesList')

	</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>

<script>
	function showConfirmDeleteDialog(link) {
 		 swal({   
			title: "Deseja apagar o registro?",   
			text: "A ação não poderá ser desfeita",   
			type: "warning",   
			showCancelButton: true,   
			confirmButtonColor: "#DD6B55",   
			confirmButtonText: "Apagar",   
			cancelButtonText: "Cancelar",   
			closeOnConfirm: false,   
			closeOnCancel: true

			}, 

			function(isConfirm)
			{   
				if (isConfirm) 
				{     
					window.location.assign(link);
				} 			
				else
				{

			}
		});  		
	}


	$(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else {
                getRoles(page);
            }
        }
    });

    $(document).ready(function() {
        $(document).on('click', '.pagination a', function (e) {
            getRoles($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });
    });

    function getRoles(page) {
        $.ajax({
            url : '?page=' + page,
            dataType: 'json',
        }).done(function (data) {
            $('.container-listagem').html(data);
            location.hash = page;
        }).fail(function () {
            alert('Posts could not be loaded.');
        });
    }
</script>

	@if (isset($message))
		<script>
			swal("Operação concluída com sucesso!", "", "success");
		</script>
	@endif

@endsection