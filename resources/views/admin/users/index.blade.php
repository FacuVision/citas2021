@extends('adminlte::page')

@section('title', 'Blog 2021')

@section('content_header')
<h1>Menu de Usuarios </h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table id="usuarios" class="table table-striped table-bordered" style="width:100%">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>DNI</th>
                    <th>Email</th>

                    <th style="width:2px;text-align:center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->profile->nombre}}</td>
                    <td>{{$user->profile->apellido}}</td>
                    <td>{{$user->profile->dni}}</td>
                    <td>{{$user->email}}</td>

                    <td style="display:flex ">
                        @can('admin.users.edit')
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-success">Editar</a>
                        @endcan

                        @can('admin.users.destroy')
                        @if (Auth::id() != $user->id)
                        <form action="{{ route('admin.users.destroy', $user) }}" method="post"
                            class="formulario-eliminar">
                            @csrf
                            @method('DELETE')
                            <input type="submit" id="delete" value="Eliminar" class="btn btn-danger"
                                style="margin: 0px 0px 0px 5px;">
                        </form>
                        @endif
                        @endcan

                    </td>
                </tr>
                @endforeach

            </tbody>

        </table>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
@stop

@section('js')

<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('#usuarios').DataTable(
        {
            "responsive":true,
            "auto-with":false,
            "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });

    /* FORMULARIO ELIMINAR USUARIO */
    $('.formulario-eliminar').submit(function(e){
        e.preventDefault();
            Swal.fire({
            title: '??Estas seguro?',
            text: "Se eliminaran todos los registros relacionados a esta informaci??n(perfil, doctor, citas, etc). Esta acci??n es irreversible.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, estoy de acuerdo!',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
            })
    });
</script>
{{-- MENSAJE DESPUES DE ELIMINAR --}}
@if (session("mensaje")=="ok")
<script>
    Swal.fire(
                 'Eliminado!',
                 'El usuario se ha eliminado correctamente.',
                 'success'
                 )
</script>
@endif

@stop
