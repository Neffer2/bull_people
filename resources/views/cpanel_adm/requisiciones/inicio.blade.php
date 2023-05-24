<!DOCTYPE html>
<html lang="en"> 
    @include('cpanel_adm/recursos_cpanel/head')
<body class="theme-red">
    @include('cpanel_adm/recursos_cpanel/nav')
    <section>
        @include('cpanel_adm/recursos_cpanel/menu_vertical')
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
                                Requisiciones
                                <small>Aquí encontrarás la lista de todas las requisiciones recibidas.</small>
                            </h2>
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr> 
                                        <th>#</th>
                                        <th>FECHA</th>
                                        <th>REMITENTE</th>
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
                                            <td>{{ $elem->user_info->name }}</td>
                                            <td><a href="/files/requisicion/{{ $elem->requisicion }}" target="_blank">{{ $elem->requisicion }}</a></td>
                                            <td>
                                                @if ($elem->estado == 0)
                                                    Pendiente
                                                @else
                                                    Revisado
                                                @endif
                                            </td> 
                                            <td>
                                                <button id="collapse_btn" class="btn bg-gray waves-effect m-b-15" type="button" data-toggle="collapse" data-target="#collapse{{$elem->id}}" aria-expanded="false"
                                                        aria-controls="collapseExample" onclick="collapse_icon(this)">
                                                        <i class="material-icons">keyboard_arrow_down</i>
                                                </button>
                                            </td> 
                                        </tr>
                                        <tr>
                                            <td colspan="6"> 
                                                <div class="collapse" id="collapse{{$elem->id}}">
                                                    <div class="well col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <form action="{{ route('requisiciones.update', $elem->id) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-4">
                                                                <select class="form-control show-tick" required name="estado">
                                                                    <option value="">--</option>
                                                                    @if ($elem->estado == 0)
                                                                        <option value="0" selected>Penediente</option>
                                                                        <option value="1">Revisado</option>        
                                                                    @elseif($elem->estado == 1)                                                                       
                                                                        <option value="1" selected>Revisado</option>
                                                                        <option value="0">Penediente</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-8">
                                                                <button type="submit" class="btn btn-primary waves-effect">
                                                                    <i class="material-icons">save</i>
                                                                    <span>Guardar estado</span>
                                                                </button>
                                                        </form> 
                                                            <a href="/files/requisicion/{{ $elem->requisicion }}" download="{{ $elem->requisicion }}" target="_blank" class="btn btn-success waves-effect">
                                                                <i class="material-icons">file_download</i>
                                                                <span>Descargar archivo</span>
                                                            </a>
                                                            <button type="button" class="btn btn-danger waves-effect" data-color="red" data-toggle="modal" data-target="#smallModal{{$elem->id}}">
                                                                <i class="material-icons">delete</i>
                                                                <span>Eliminar</span>
                                                            </button>
                                                        </div>
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
    <script type="text/javascript">
        
        function collapse_icon (elem){
            aux = elem.getElementsByTagName("i")[0].innerHTML;
            if (aux === "keyboard_arrow_down"){
                elem.getElementsByTagName("i")[0].innerHTML = "expand_less";
            }else if (aux === "expand_less"){
                elem.getElementsByTagName("i")[0].innerHTML = "keyboard_arrow_down";
            }
        }
    </script>
    @include('cpanel_adm/recursos_cpanel/footer_js')
</body>
</html>