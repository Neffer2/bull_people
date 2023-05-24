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
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2 class="text-center">
                                    <b>{{ $oferta->nombre }}</b>
                                </h2>                           
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header bg-deep-orange">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h4 class="text-left">
                                            <b>{{ $oferta->nombre }}</b>
                                            <h6 class="card-inside-title:first-child">{{ $oferta->ubicacion }} - {{ $oferta->fecha }}</h6>
                                            {{-- <p>{{ substr($elem->estado, 0, 100) }}</p> --}}
                                        </h4>
                                    </div>
                                </div> 
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="list-group">
                                            <button type="button" class="list-group-item">
                                                <b>Contrato: </b>{{ $oferta->tipo_contrato}}
                                            </button>
                                            <button type="button" class="list-group-item">
                                                <b>Sueldo: </b>@php echo number_format($oferta->sueldo ,2); @endphp
                                            </button>
                                            {{-- <button type="button" class="list-group-item">
                                                <b>Prioridad: </b>{{ $oferta->prioridad }}
                                            </button> --}}
                                            <button type="button" class="list-group-item">
                                                <b>Fecha: </b>{{ $oferta->fecha }}
                                            </button>
                                            <button type="button" class="list-group-item">
                                                <b>Jornada: </b>{{ $oferta->jornada }}
                                            </button>
                                            <button type="button" class="list-group-item">
                                                <b>Estado: </b>
                                                @if ($oferta->estado == 1)
                                                    <div class="form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input radio-col-deep-orange" type="radio" name="estado" id="inlineRadio1" value="1" checked>
                                                            <label class="form-check-label" for="inlineRadio1">Activa</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input radio-col-deep-orange" type="radio" name="estado" id="inlineRadio2" value="0">
                                                            <label class="form-check-label" for="inlineRadio2">Pausada</label>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input radio-col-deep-orange" type="radio" name="estado" id="inlineRadio1" value="1">
                                                            <label class="form-check-label" for="inlineRadio1">Activa</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input radio-col-deep-orange" type="radio" name="estado" id="inlineRadio2" value="0" checked>
                                                            <label class="form-check-label" for="inlineRadio2">Pausada</label>
                                                        </div>
                                                    </div>                                       
                                                @endif                                            
                                            </button>
                                            <button type="button" class="list-group-item">
                                                <b>Ubicación: </b>{{ $oferta->ubicacion }}
                                            </button>
                                            <button type="button" class="list-group-item">
                                                <b>Fecha: </b>{{ $oferta->fecha }}
                                            </button>
                                            <button type="button" class="list-group-item">
                                                <b>Creada el: </b>{{ $oferta->created_at }}
                                            </button>
                                            <button type="button" class="list-group-item">
                                                <b>Úlima actualización: </b>{{ $oferta->update_at }}
                                            </button>                                    
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <b>
                                            Descripción: 
                                        </b>
                                        @php
                                            echo $oferta->descripcion;                                                
                                        @endphp
                                    </div>
                                    <div class="col-md-12">
                                        <center>
                                            <a class="btn bg-cyan waves-effect" href="/files/{{ $oferta->archivo }}" download="{{ $oferta->archivo_nombre }}">
                                                <i class="material-icons">file_download</i>
                                                <span>Descargar archivo - {{ $oferta->archivo_nombre }}</span>
                                            </a>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
    </section>
    @include('cpanel_adm/recursos_cpanel/footer_js')
</body>
</html>