<!DOCTYPE html>
<html lang="en"> 
    @include('cpanel_trabajador/recursos_cpanel/head')
<body class="theme-red">
    @include('cpanel_trabajador/recursos_cpanel/nav')
    <section>
        @include('cpanel_trabajador/recursos_cpanel/menu_vertical')
    </section> 
    <style>
        .user {
            margin: 5px;
            display: inline-block;
            width: 100px; 
            height: 100px; 
            border-radius: 50%;
            float: left;
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
        } 
    </style>

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">                
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <p><strong>!Opp tenemos un problema</strong></p>
                    <ul>
                        @foreach ($errors->all() as $elem)
                            <li>{{ $elem }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif   
                @if (session('success'))
                    <div class="alert bg-green alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Nueva requisición
                                <small>Descarga el formato de requisición <a href="{{ asset('files/requisicion/formato/requisicion_formato.docx') }}" target="_blank">Aquí.</a></small>
                                <small></small>
                            </h2>
                        </div> 
                        <div class="body table-responsive">
                            <form action="{{ route('requisiciones.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf 
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input id="archivo" type="file" accept="application/pdf" name="archivo" required/>
                                            </td>
                                            <td>
                                                <button type="submit" id="submit" class="btn bg-deep-orange waves-effect" style="margin-left: 15px;">
                                                    <i class="material-icons">file_upload</i>
                                                    <span>Enviar requisición</span>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>                            
                        </div> 
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Tus requisiciones
                                <small>Aquí encontrarás la lista de todas las requisiciones que haz realizado.</small>
                            </h2>
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>FECHA</th>
                                        <th>ARCHIVO</th>
                                        <th>ESTADO</th>
                                        <th>ACCION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requisiciones as $key => $elem)
                                        <tr>  
                                            <th scope="row">{{ ($key+1) }}</th>
                                            <td>{{ $elem->created_at }}</td>
                                            <td>
                                                <a href="files/requisicion/{{ $elem->requisicion }}" target="_blank">{{ $elem->requisicion }}</a>
                                            </td>
                                            <td>
                                                @if ($elem->estado == 0)
                                                    Pendiente
                                                @else
                                                    Revisado
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-danger waves-effect" data-color="red" data-toggle="modal" data-target="#smallModal{{$elem->id}}">
                                                    <i class="material-icons">delete</i>
                                                    <span>Eliminar</span>
                                                </button>
                                                {{-- MODAL --}}
                                                <div class="modal fade" id="smallModal{{$elem->id}}" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog modal-sm" role="document">
                                                        <div class="modal-content modal-col-red">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="smallModalLabel">¿Deseas eliminar esta requisición?</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                La requisición del {{ $elem->created_at }} será completamente eliminada.
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('requisiciones.destroy', $elem->id) }}" method="POST">
                                                                    @method('DELETE') 
                                                                    @csrf 
                                                                    <button type="submit" class="btn btn-link waves-effect">Eliminar</button>
                                                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cancelar</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 
    </section>
    @include('cpanel_trabajador/recursos_cpanel/footer_js')
</body>
</html>