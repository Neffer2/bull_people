<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Empleo - BullMarketing</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('panel/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('panel/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('panel/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="{{ asset('panel/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- Custom Css -->
    <link href="{{ asset('panel/css/style.css') }}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('panel/css/themes/all-themes.css') }}" rel="stylesheet" />
</head>

<body class="theme-red">
    @include('cpanel_adm/recursos_cpanel/nav')
    <section>
        @include('cpanel_adm/recursos_cpanel/menu_vertical')

        @include('cpanel_adm/recursos_cpanel/menu_horizontal')
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
            <!-- #END# Basic Examples -->
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                POSTULADOS
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Documento</th>
                                            <th>Correo</th>
                                            <th>Teléfono</th>
                                            <th>Ciudad</th>
                                            <th>Cargo</th>
                                            <th>Fecha</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Documento</th>
                                            <th>Correo</th>
                                            <th>Teléfono</th>
                                            <th>Ciudad</th>
                                            <th>Cargo</th>
                                            <th>Fecha</th>
                                            <th>Estado</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($oferta->postulaciones as $elem)
                                        <tr>
                                            <td>
                                                <a href="{{ route('postulado', $elem->id) }}" target="_blank">
                                                    {{ $elem->user_info->name }}
                                                </a>
                                            </td>
                                            <td>{{ $elem->user_info->documento }}</td>
                                            <td>{{ $elem->user_info->email }}</td>
                                            <td>{{ $elem->contacto_1 }}</td>
                                            <td>{{ $elem->ciudad }}</td>
                                            <td>{{ $elem->cargo }}</td>
                                            <td>{{ $elem->created_at }}</td>
                                            <td>
                                            @if ($elem->estado == 1) 
                                                <button class="btn btn-success">
                                                    En proceso
                                                </button>
                                            @elseif(is_null($elem->estado))
                                                <p>Sin estado</p>   
                                            @else
                                                <button class="btn btn-danger">
                                                    Descartado
                                                </button>
                                            @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>

    <!-- <section class="content"> 
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
                @foreach ($oferta->postulaciones as $elem)
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="card" style="height: 390px;">
                            @if ($elem->estado == 1)
                                <div class="header bg-green">
                            @elseif(is_null($elem->estado))
                                <div class="header bg-cyan">                                                    
                            @else
                                <div class="header bg-red">
                            @endif
                                <h2>
                                    {{ $elem->user_info->name }} <small>{{ $elem->user_info->email }}</small> <small>{{ $elem->user_info->documento }}</small>
                                </h2>
                            </div>
                            <div class="body">
                                <div class="user" style="background-image:url('../img/profiles/{{ $elem->user_info->avatar }}');"></div>
                                <p>{{ substr($elem->descripcion, 0, 250) }}...</p>

                                <a class="btn bg-cyan waves-effect" href="/files/{{ $elem->hoja_vida }}" download="HV_{{ $elem->user_info->name }}">
                                    <i class="material-icons">file_download</i>
                                    <span>Hoja de vida</span>
                                </a>
                                <a href="{{ route('postulado', $elem->id) }}" class="btn bg-orange waves-effect">
                                    <i class="material-icons">next_week</i>
                                    <span>Administrar</span>
                                </a>
                            </div>
                        </div>             
                    </div>
                @endforeach                  
            </div>                                   
        </div>
    </section> -->
    
    <!-- Desde aquí -->
    <script src="{{ asset('panel/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('panel/plugins/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('panel/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('panel/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('panel/plugins/node-waves/waves.js') }}"></script>

    <script src="{{ asset('panel/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('panel\plugins\jquery-datatable\skin\bootstrap\js\dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('panel\plugins\jquery-datatable\extensions\export\dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('panel\plugins\jquery-datatable\extensions\export\buttons.flash.min.js') }}"></script>
    <script src="{{ asset('panel/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('panel/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('panel/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('panel/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('panel/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
    <!-- Custom js -->
    <script src="{{ asset('panel\js\admin.js') }} "></script>
    <script src="{{ asset('panel\js\pages\tables\jquery-datatable.js') }}"></script>
    <!-- Demo Js -->
    <script src="{{ asset('panel/js/demo.js') }}"></script>
    <!-- hasta aquí -->
</body>
</html> 