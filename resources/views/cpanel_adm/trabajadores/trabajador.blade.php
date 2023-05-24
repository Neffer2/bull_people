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
            height: 680px;
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
                        <div class="header bg-deep-orange">
                            <h2>  
                                {{ $trabajador->name }} <small>{{ $trabajador->email }}</small>
                            </h2>
                        </div> 
                        <div class="body table-responsive">
                            <div class="row">
                                <div class="col-md-12">
                                    <img style="display: block;
                                    margin-left: auto;
                                    margin-right: auto;" src="../img/profiles/{{ $trabajador->avatar }}" width="100" height="100%">                                    
                                </div>
                                <div class="body ">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center">Usuario</th>
                                                <th style="text-align:center">Documento</th>
                                                <th style="text-align:center">Correo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="text-align:center">{{ $trabajador->name }}</td>
                                                <td style="text-align:center">{{ $trabajador->documento }}</td>
                                                <td style="text-align:center">{{ $trabajador->email }}</td>
                                            </tr>
                                        </tbody>
                                    </table> 
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                    <div class="card">
                                        <div class="body table-responsive">
                                            <h4>Informaci&oacute;n personal</h4>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Primer nombre:</th>
                                                        <td>{{ $trabajador->trabajador_infos[0]->primer_nombre }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Segundo nombre:</th>
                                                        <td>{{ $trabajador->trabajador_infos[0]->segundo_nombre }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Primer apellido:</th>
                                                        <td>{{ $trabajador->trabajador_infos[0]->primer_apellido }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Segundo apellido:</th>
                                                        <td>{{ $trabajador->trabajador_infos[0]->segundo_apellido }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Documento:</th>
                                                        <td>{{ $trabajador->trabajador_infos[0]->documento }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Nacionalidad:</th>
                                                        <td>{{ $trabajador->trabajador_infos[0]->nacionalidad }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Gr&uacute;po sangu&iacute;neo / RH</th>
                                                        <td>{{ $trabajador->trabajador_infos[0]->grupo_sanguineo }}{{ $trabajador->trabajador_infos[0]->rh }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>G&eacute;nero:</th>
                                                        <td>{{ $trabajador->trabajador_infos[0]->genero }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Estado civil:</th>
                                                        <td>{{ $trabajador->trabajador_infos[0]->estado_civil }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Fecha nacimiento:</th>
                                                        <td>{{ $trabajador->trabajador_infos[0]->fecha_nacimiento }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Nivel acad&eacute;mico:</th>
                                                        <td>{{ $trabajador->trabajador_infos[0]->nivel_academico }}</td>
                                                    </tr>
                                                </thead>
                                            </table>
                                            <h4>Informaci&oacute;n de contacto</h4>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>País:</th>
                                                        <td>{{ $trabajador->trabajador_infos[0]->pais_resi->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Departamento:</th>
                                                        <td>{{ $trabajador->trabajador_infos[0]->dep_resi->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Ciudad:</th>
                                                        <td>{{ $trabajador->trabajador_infos[0]->ciu_resi->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Direcci&oacute;n:</th>
                                                        <td>{{ $trabajador->trabajador_infos[0]->direccion }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tel&eacute;fono:</th>
                                                        <td>{{ $trabajador->trabajador_infos[0]->telefono }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Celular:</th>
                                                        <td>{{ $trabajador->trabajador_infos[0]->celular }}</td>
                                                    </tr>
                                                </thead>
                                            </table>
                                            <h4>Informaci&oacute;n corporativa</h4>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Cargo:</th>
                                                        <td>{{ $trabajador->trabajador_infos[0]->cargo }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Fecha contrataci&oacute;n:</th>
                                                        <td>{{ $trabajador->trabajador_infos[0]->fecha_contratacion }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Inducci&oacute;n:</th>
                                                        @if ($trabajador->trabajador_infos[0]->induccion == 1)
                                                            <td>Terminada</td>
                                                        @else
                                                            <td>No terminada</td>
                                                        @endif
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                    <div class="card">
                                        <div class="body table-responsive">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation" class="active">
                                                    <a href="#home_with_icon_title" data-toggle="tab">
                                                        <i class="material-icons">assignment</i> CONTRATO
                                                    </a>
                                                </li>
                                                <li role="presentation">
                                                    <a href="#profile_with_icon_title" data-toggle="tab">
                                                        <i class="material-icons">face</i> HOJA DE VIDA
                                                    </a>
                                                </li>
                                            </ul>        
                                            <!-- Tab panes --> 
                                            <div class="tab-content"> 
                                                <div role="tabpanel" class="tab-pane fade in active" id="home_with_icon_title">
                                                    @if ($trabajador->contrato)
                                                        <div class="iframe_container">
                                                            <iframe class="responsive_iframe" src="{{ asset("/files/contratos/$trabajador->contrato") }}"></iframe>
                                                        </div> 
                                                        <br>
                                                        <object data="myfile.pdf" type="application/pdf" width="100%" height="100%">
                                                            <p>Pantalla completa<a target="_blank" href="{{ asset("/files/contratos/$trabajador->contrato") }}"> Contrato</a></p>
                                                        </object>
                                                        <a class="btn bg-cyan waves-effect" href="{{ asset("/files/contratos/$trabajador->contrato") }}" download="Contrato_{{ $trabajador->name }}">
                                                            <i class="material-icons">file_download</i>
                                                            <span>Descargar</span>
                                                        </a>
                                                    @endif
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">
                                                        @if ($trabajador->hoja_vida)
                                                            <div class="iframe_container">
                                                                <iframe class="responsive_iframe" src="{{ asset("/files/$trabajador->hoja_vida") }}"></iframe>
                                                            </div>
                                                            <br>
                                                            <object data="myfile.pdf" type="application/pdf" width="100%" height="100%">
                                                                <p>Pantalla completa<a target="_blank" href="{{ asset("/files/$trabajador->hoja_vida") }}"> hoja de vida</a></p>
                                                            </object>
                                                            <a class="btn bg-deep-orange waves-effect" href="{{ asset("/files/$trabajador->hoja_vida") }}" download="HV_{{ $trabajador->name }}">
                                                                <i class="material-icons">file_download</i>
                                                                <span>Descargar</span>
                                                            </a> 
                                                        @endif
                                                    </div>
                                            </div> 
                                        </div>
                                    </div>
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