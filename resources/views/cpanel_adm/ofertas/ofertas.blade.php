<!DOCTYPE html>
<html lang="en">
    @include('cpanel_adm/recursos_cpanel/head')
<body class="theme-red">
    @include('cpanel_adm/recursos_cpanel/nav')
    <section>
        @include('cpanel_adm/recursos_cpanel/menu_vertical')

        @include('cpanel_adm/recursos_cpanel/menu_horizontal')
    </section>

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
                            <h2 class="text-center">
                                <b>TUS OFERTAS LABORALES</b>
                            </h2>                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                @foreach ($ofertas as $elem)
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header bg-deep-orange">
                                <h2>
                                    {{ $elem->nombre }} <small>{{ $elem->ubicacion }} - {{ $elem->fecha }}</small>
                                </h2>
                            </div>
                            <div class="body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                    <li role="presentation" class="active"><a href="#info{{$elem->id}}" data-toggle="tab">INFORMACIÓN</a></li>
                                    <li role="presentation"><a href="#desc{{$elem->id}}" data-toggle="tab">DESCRIPCIÓN</a></li>
                                    <li role="presentation"><a href="#arch{{$elem->id}}" data-toggle="tab">ARCHIVO</a></li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="info{{$elem->id}}">
                                        <ul class="list-group">
                                            <li class="list-group-item"><b>Contrato:</b> {{ substr($elem->tipo_contrato, 0, 100) }}</li>
                                            <li class="list-group-item"><b>Sueldo:</b>@php echo " ".number_format($elem->sueldo ,2); @endphp</li>
                                            {{-- <li class="list-group-item"><b>Prioridad:</b> {{ substr($elem->prioridad, 0, 100) }}</li> --}}
                                            <li class="list-group-item"><b>Jornada:</b> {{ substr($elem->jornada, 0, 100) }}</li>                                            
                                        </ul>
                                        <div style="margin: 5px;">
                                            <a href="{{ route('ofertas.show', $elem->id) }}" type="button" class="btn bg-deep-orange waves-effect">
                                                <i class="material-icons">chevron_right</i>
                                                <span>Mas información</span>
                                            </a>
                                            <a href="{{ route('ofertas.edit', $elem->id) }}" type="button" class="btn bg-primary waves-effect">
                                                <i class="material-icons">mode_edit</i>
                                                <span>Editar</span>
                                            </a> 
                                            <button class="btn btn-danger waves-effect" data-color="red" data-toggle="modal" data-target="#smallModal{{$elem->id}}">
                                                <i class="material-icons">delete</i>
                                                <span>Eliminar</span>
                                            </button>
                                            
                                            {{-- MODAL --}}
                                            <div class="modal fade" id="smallModal{{$elem->id}}" tabindex="-1" role="dialog">
                                                <div class="modal-dialog modal-sm" role="document">
                                                    <div class="modal-content modal-col-deep-orange">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="smallModalLabel">¿Deseas eliminar esta oferta?</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            La oferta: {{ $elem->nombre }}, será completamente eliminada.
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ route('ofertas.destroy', $elem->id) }}" method="POST">
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
                                    <div role="tabpanel" class="tab-pane fade" id="desc{{$elem->id}}">
                                        <b>Descripción</b>
                                        @php
                                            echo substr(strip_tags($elem->descripcion), 0, 350);                                            
                                        @endphp
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="arch{{$elem->id}}">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <a class="btn bg-cyan waves-effect" href="/files/{{ $elem->archivo }}" download="{{ $elem->archivo_nombre }}">
                                                    <i class="material-icons">file_download</i>
                                                    <span>Descargar archivo - {{ $elem->archivo_nombre }}</span>
                                                </a>                                             
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                @endforeach
            </div>                                   
        </div>
    </section>
    @include('cpanel_adm/recursos_cpanel/footer_js')
</body>
</html>