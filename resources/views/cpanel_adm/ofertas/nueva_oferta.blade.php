<!DOCTYPE html>
<html lang="en">
    @include('cpanel_adm/recursos_cpanel/head')
    <style>
        @import url('https://code.getmdl.io/1.1.3/material.indigo-pink.min.css');
        .jst-material-input-file {
            margin-top: 70px;
        }

        .file-upload {
            margin: 0 10px 0 25px;
        }
        .file-upload input.upload {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            z-index: 10;
            font-size: 20px;
            cursor: pointer;
            height: 36px;
            opacity: 0;
            filter: alpha(opacity=0);
            background-color: #FF5722 !important;
        }
        .mdl-button--accent.mdl-button--accent.mdl-button--raised, .mdl-button--accent.mdl-button--accent.mdl-button--fab
        {
            background-color: #FF5722 !important;

        }

        #fileuploadurl{
            border: none;
            font-size: 12px;
            padding-left: 0;
            width: 250px;
        }
    </style>
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
                                <b>REGISTRAR UNA OFERTA LABORAL</b>
                            </h2>                           
                        </div> 
                            
                        <form class="form-signin" action="{{ route('ofertas.store') }}" method="POST" enctype="multipart/form-data" >
                            @csrf                         
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-md-8">
                                        <label for="email_address">Nombre de la oferta</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="nombre" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <p><b>Tipo</b></p>
                                        <select class="form-control show-tick" name="tipo_oferta">                                           
                                            @foreach ($tipo_oferta as $elem)
                                                <option value="{{ $elem->id }}">{{ $elem->descripcion }}</option>                                              
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <p><b>Área</b></p>
                                        <select class="form-control show-tick" name="area">
                                            <option selected value="">Seleccionar</option>
                                            @foreach (config('global.area') as $elem)
                                                <option value="{{ $elem }}">{{ $elem }}</option>                                              
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row clearfix"> 
                                    <div class="col-md-4">
                                        <p><b>Prioridad de la oferta</b></p>
                                        <select class="form-control show-tick" name="prioridad">
                                            <option selected>Seleccionar</option>
                                            @foreach (config('global.prioridades') as $elem)
                                                <option value="{{ $elem }}">{{ $elem }}</option>                                              
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <p><b>Tipo de contrato</b></p>
                                        <select class="form-control show-tick" name="tipo_contrato">
                                            <option selected value="">Seleccionar</option>
                                            @foreach (config('global.tipo_contrato') as $elem)
                                                <option value="{{ $elem }}">{{ $elem }}</option>                                              
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <p><b>Sueldo mensual</b></p>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="number" class="form-control" name="sueldo">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <p><b>Fecha de cierre</b></p>
                                        <div class="input-group"> 
                                            <div class="form-line">
                                                <input type="date" class="form-control date" required name="fecha">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <p><b>Lugar de trabajo</b></p>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select name="ubicacion" class="form-control">
                                                    <option value="">Seleccionar</option>
                                                    @foreach (config('global.ubicacion') as $elem)
                                                        <option value="{{ $elem }}">{{ $elem }}</option>                                              
                                                    @endforeach> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <p><b>Jornada laboral</b></p>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select class="form-control show-tick" name="jornada">
                                                    <option selected value="">Seleccionar</option>
                                                    @foreach (config('global.jornada_laboral') as $elem)
                                                        <option value="{{ $elem }}">{{ $elem }}</option>                                              
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>                         
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <p><b>Estado</b></p>
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
                                    </div>
                                    <div class="col-md-4">
                                        <p><b>Subir archivo (Opcional)</b></p>
                                        <div class="file-upload mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                                            <span>Click aquí</span>
                                            <input type="file" name="archivo" id="FileAttachment" class="upload"/>
                                        </div>
                                        <input type="text" id="fileuploadurl" readonly placeholder="">
                                    </div>
                                </div> 
                                <div class="row clearfix">
                                    <div class="body">
                                        <p><b>Describe los detalles de la oferta</b></p>
                                        <!-- CKEditor -->
                                        <div class="row clearfix">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="body">
                                                    <textarea id="ckeditor" name="descripcion" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row clearfix mb-5 text-center border">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-block btn-lg bg-deep-orange waves-effect">
                                            <i class="material-icons">add_circle_outline</i>
                                            <span>Registrar Oferta</span>
                                        </button>
                                    </div>                                    
                                </div>                            
                            </div>
                        </form>
                    </div>
                </div>        
            </div>
        </div>        
    </section> 
    @include('cpanel_adm/recursos_cpanel/footer_js')
    <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <script>
        document.getElementById("FileAttachment").onchange = function () {
            document.getElementById("fileuploadurl").value = this.value.replace(/C:\\fakepath\\/i, '');
        };
    </script>
</body>
</html>