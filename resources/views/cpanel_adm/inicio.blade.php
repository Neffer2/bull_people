<!DOCTYPE html>
<html lang="en">
    {{-- @include('cpanel_adm/recursos_cpanel/head') --}}
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
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

        <!-- Morris Css -->
        <link href="{{ asset('panel/plugins/morrisjs/morris.css') }}" rel="stylesheet" />

        <!-- Custom Css -->
        <link href="{{ asset('panel/css/style.css') }}" rel="stylesheet">

        <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
        <link href="{{ asset('panel/css/themes/all-themes.css') }}" rel="stylesheet" />
        <title>Bull empleos</title>
    </head>
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
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3"> 
                    <div class="info-box-2 bg-deep-orange hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">OFERTAS ACTIVAS</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20">{{ $count_ofertas }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3"> 
                    <div class="info-box-2 hover-zoom-effect" style="background-color: #333333">
                        <div class="icon">
                            <i class="material-icons">contact_mail</i>
                        </div> 
                        <div class="content">
                            <div class="text col-white">POSTUACIONES</div>
                            <div class="number count-to col-white" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">{{ $count_postulaciones }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3"> 
                    <div class="info-box-2 bg-deep-orange hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">face</i>
                        </div> 
                        <div class="content">
                            <div class="text col-white" >TRABAJADORES</div>
                            <div class="number count-to col-white" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">350</div>
                        </div>
                    </div> 
                </div>
                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3"> 
                    <div class="info-box-2 hover-zoom-effect" style="background-color: #333333">
                        <div class="icon">
                            <i class="material-icons">chrome_reader_mode</i>
                        </div> 
                        <div class="content">
                            <div class="text col-white" >REQUISICIONES</div>
                            <div class="number count-to col-white" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">15</div>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Ciudades <small>Número de postulados en cada ciudad</small>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="/postulados_db" class="waves-effect waves-block">Ver detalles</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div id="bar_chart" class="graph"></div>
                        </div>
                    </div>
                </div>                
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Cargos <small>Número de postulados en cada cargo</small>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="/postulados_db" class="waves-effect waves-block">Ver detalles</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div id="donut_chart" class="graph"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="body" style="background-color: #333333">
                            <ul class="dashboard-stat-list" style="margin-top:0px;">
                                <li class="col-white">
                                    HOY
                                    <span class="pull-right col-white"><b>{{ $post_hoy }}</b> <small>POSTULADOS</small></span>
                                </li>
                                <li class="col-white">
                                    AYER
                                    <span class="pull-right col-white"><b>{{ $post_ayer }}</b> <small>POSTULADOS</small></span>
                                </li> 
                                <li class="col-white">
                                    HACE UNA SEMANA
                                    <span class="pull-right col-white"><b>{{ $post_sem }}</b> <small>POSTULADOS</small></span>
                                </li> 
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> 
    {{-- @include('cpanel_adm/recursos_cpanel/footer_js') --}}
    <!-- Jquery Core Js -->
    <script src="{{ asset('panel/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('panel/plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Select Plugin Js -->
    <script src="{{ asset('panel/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('panel/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('panel/plugins/node-waves/waves.js') }}"></script>

    <!-- Morris Plugin Js -->
    <script src="{{ asset('panel/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('panel/plugins/morrisjs/morris.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('panel\js\admin.js') }} "></script>
    <script src="{{ asset('panel/js/pages/charts/morris.js') }}"></script>
    
    <!-- Demo Js -->
    <script src="{{ asset('panel/js/demo.js') }}"></script>
 
    <script type="text/javascript">
        const csrftoken = document.getElementsByName('_token')[0].value;
        var url = '/get_cargos_postulados';
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
                    if (i > 7){
                       break;
                    }
                }
                
                Morris.Donut({ 
                    element: 'donut_chart',
                    data: data_cargos,
                    colors: ['#FF5722', '#333333']
                });
            });
    </script>
 
    <script type="text/javascript">
        var url = '/get_ciudades_postulados';
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
                    if (ciudades_postulados[i].ciudad != ''){
                        data_ciudad.push({ team: ciudades_postulados[i].ciudad, nb: ciudades_postulados[i].cantidad })
                    }
                    if (i > 2){
                       break;
                    }
                }
                Morris.Bar({
                    element: 'bar_chart',
                    data: data_ciudad,
                    xkey: 'team',
                    ykeys: ['nb'],
                    labels: ['Postulados'],
                    barColors: ['#FF5722'],
                    hideHover: true
                });
            });
    </script>
</body>
</html>
