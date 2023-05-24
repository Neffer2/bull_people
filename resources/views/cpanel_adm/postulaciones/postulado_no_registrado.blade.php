<!DOCTYPE html>
<html lang="en">
    @include('cpanel_adm/recursos_cpanel/head')
<body class="theme-red">
    @include('cpanel_adm/recursos_cpanel/nav')
    <section>
        @include('cpanel_adm/recursos_cpanel/menu_vertical')

        @include('cpanel_adm/recursos_cpanel/menu_horizontal')
    </section>
    <style>
        .iframe_container {
            position: relative;
            width: 100%;
            overflow: hidden;
            padding-top: 56.25%; /* 16:9 Aspect Ratio */
        }
        
        .responsive_iframe {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 100%;
            border: none;
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
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">��</span></button>
                        {{ session('success') }}
                    </div>
                @endif
            </div>                 
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        @if ($postulado->estado == 1)
                            <div class="header bg-green">
                        @elseif(is_null($postulado->estado))
                            <div class="header bg-cyan">                                                    
                        @else
                            <div class="header bg-red">
                        @endif
                        <h2> 
                            {{ $postulado->name }} <small>{{ $postulado->email }}</small>
                        </h2>
                        </div> 
                        <div class="body">
                            <div class="row">
                                <div class="col-md-12">
                                    <img style="display: block;
                                    margin-left: auto;
                                    margin-right: auto;" src="../img/profiles/default_avatar.png" width="100" height="100%">                                    
                                </div>
                            </div>
                        </div> 
                        <div class="body">
                            {{ $postulado->descripcion }}
                            <br>
                            <div class="body table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Documento</th>
                                            <th>Contacto 1</th>
                                            <th>Contacto 2</th>
                                            <th>Ciudad</th>
                                            <th>Cargo</th>
                                            <th>Aspiración salarial</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr> 
                                            <th scope="row">1</th>
                                            <td>{{ $postulado->nombre }}</td>
                                            <td>{{ $postulado->documento }}</td>
                                            <td>{{ $postulado->contacto_1 }}</td>
                                            <td>{{ $postulado->contacto_2 }}</td>
                                            <td>{{ $postulado->ciudad }}</td>
                                            <td>{{ $postulado->cargo }}</td>
                                            <td>{{ $postulado->aspiracion }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="body">
                            <div class="iframe_container">
                                <iframe class="responsive_iframe" src="{{ $postulado->hoja_vida }}"></iframe>
                            </div>
                            <br>
                            <object data="myfile.pdf" type="application/pdf" width="100%" height="100%">
                                <p>Pantalla completa<a target="_blank" href="{{ asset("/files/$postulado->hoja_vida") }}"> hoja de vida</a></p>
                            </object>
                            <a class="btn bg-cyan waves-effect" href="{{ $postulado->hoja_vida }}" download="HV_{{ $postulado->nombre }}">
                                <i class="material-icons">file_download</i>
                                <span>Hoja de vida</span>
                            </a>
                        </div>
                        {{-- <div class="body">
                            <form action="{{ route('cambio_estado', $postulado->id) }}" method="POST">
                                @csrf
                                <div class="row"> 
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4>Elige el estado del postulado</h4>
                                            </div>
                                            <div class="col-md-6">
                                                <textarea name="descripcion_estado" id="" class="form-control" cols="30" rows="3" placeholder="Comentario de decisión" required>{{ $postulado->descripcion_estado }}</textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="demo-radio-button">
                                                    @if ($postulado->estado == 1)
                                                        <input name="group5" type="radio" id="radio_30" class="with-gap radio-col-red" value="0"/>
                                                        <label for="radio_30">Descartado</label>
                                                        <input name="group5" type="radio" id="radio_36" class="with-gap radio-col-light-blue" value="1" checked/>
                                                        <label for="radio_36">En proceso</label>
                                                    @elseif(is_null($postulado->estado))
                                                        <input name="group5" type="radio" id="radio_30" class="with-gap radio-col-red" value="0"/>
                                                        <label for="radio_30">Descartado</label>
                                                        <input name="group5" type="radio" id="radio_36" class="with-gap radio-col-light-blue" value="1"/>
                                                        <label for="radio_36">En proceso</label>                                                        
                                                    @else
                                                    <input name="group5" type="radio" id="radio_30" class="with-gap radio-col-red" value="0" checked/>
                                                        <label for="radio_30">Descartado</label>
                                                        <input name="group5" type="radio" id="radio_36" class="with-gap radio-col-light-blue" value="1"/>
                                                        <label for="radio_36">En proceso</label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-block btn-success waves-effect">Guardar cambios</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div> --}}
                    </div>            
                </div>
            </div>                                   
        </div>
    </section>
    @include('cpanel_adm/recursos_cpanel/footer_js')
</body>
</html>