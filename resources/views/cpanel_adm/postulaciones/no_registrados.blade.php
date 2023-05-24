<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

    <!-- Morris Css -->
    <link href="{{ asset('panel/plugins/morrisjs/morris.css') }}" rel="stylesheet" />

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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Importar datos <small>Puedes insertar nuevos registros utilizando éste <a href="{{ asset('files/formatos/Formato_subida.xlsx') }}">formato.</a></small>
                            </h2>
                        </div>
                        <div class="body">
                            <form action="{{ route('import') }}" enctype="multipart/form-data" method="POST">
                                @method('POST')
                                @csrf 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input name="file" type="file" class="btn btn-default btn-block waves-effect" accept=".xlsx, .xls, .csv">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block btn-lg waves-effect">Subir</button>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button type="reset" class="btn btn-danger btn-block btn-lg waves-effect">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                BASE DE DATOS USUARIOS NO REGISTRADOS
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
                                            <th>Tel</th>
                                            <th>Tel 2</th>
                                            <th>Ciudad</th>
                                            <th>Cargo</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Documento</th>
                                            <th>Correo</th>
                                            <th>Tel</th>
                                            <th>Tel 2</th>
                                            <th>Ciudad</th>
                                            <th>Cargo</th>
                                            <th>Estado</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($data as $elem)
                                        <tr>
                                            <td>
                                                <a href="{{ route('postulado_no_registrado', $elem->id) }}" target="_blank">
                                                    {{ $elem->nombre }}
                                                </a>
                                            </td>
                                            <td>{{ $elem->documento }}</td>
                                            <td>{{ $elem->email }}</td>
                                            <td>{{ $elem->contacto_1 }}</td>
                                            <td>{{ $elem->contacto_2 }}</td>
                                            <td>{{ $elem->ciudad }}</td>
                                            <td>{{ $elem->cargo }}</td> 
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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        Ciudades <small>Número de postulados en cada ciudad</small>
                                    </h2>
                                </div>
                                <div class="body">
                                    <div id="bar_chart" class="graph"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        Cargos <small>Número de postulados en cada cargo</small>
                                    </h2>
                                </div>
                                <div class="body">
                                    <div id="donut_chart" class="graph"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>
    
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

    <!-- Morris Plugin Js -->
    <script src="{{ asset('panel/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('panel/plugins/morrisjs/morris.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('panel/js/pages/charts/morris.js') }}"></script>

    <script type="text/javascript">
        const csrftoken = document.getElementsByName('_token')[0].value;
        var url = '/get_cargos_postulados_nr';
        var data = {};
        fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
            headers:{
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrftoken
            }
            }).then(res => res.json())
            .catch(error => console.error('Error:', error))
            .then(response => {
                let cargos_postulados = response.cargos_postulados

                data_cargos = [];
                for (let i = 0; i < cargos_postulados.length; i++) {
                    if (cargos_postulados[i].cargo != null){
                        data_cargos.push({ label: cargos_postulados[i].cargo, value: cargos_postulados[i].cantidad })
                    }
                }                
                Morris.Donut({ 
                    element: 'donut_chart',
                    data: data_cargos,
                    colors: ['#F05A22', '#333333']
                    // colors: ['#FFEB3B', '#4CAF50', '#F44336', '#2196F3', '#FF5722', '#FFC107', '#CDDC39']
                });
            });
    </script>

    <script type="text/javascript">
        var url = '/get_ciudades_postulados_nr';
        var data = {};
        fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
            headers:{
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrftoken
            }
            }).then(res => res.json())
            .catch(error => console.error('Error:', error))
            .then(response => {
                let ciudades_postulados = response.ciudades_postulados

                data_ciudad = [];
                for (let i = 0; i < ciudades_postulados.length; i++) {
                    if (ciudades_postulados[i].ciudad.length > 1){
                        data_ciudad.push({ team: ciudades_postulados[i].ciudad, nb: ciudades_postulados[i].cantidad })
                    }
                    if (i > 7){
                        break;
                    }
                }
                Morris.Bar({
                    element: 'bar_chart',
                    data: data_ciudad,
                    xkey: 'team',
                    ykeys: ['nb'],
                    labels: ['Postulados'],
                    barColors: ['#F05A22']
                });
            }); 
    </script>
</body>
</html>  