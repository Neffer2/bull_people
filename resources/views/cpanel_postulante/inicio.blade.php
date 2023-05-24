<!DOCTYPE html>
<html lang="en"> 
    @include('cpanel_postulante/recursos_cpanel/head')
<body class="theme-red">
    @include('cpanel_postulante/recursos_cpanel/nav')
    <section>
        @include('cpanel_postulante/recursos_cpanel/menu_vertical')
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
                <div class="card">
                    <div class="header">
                        <h2 class="text-center">
                            <b>TUS POSTULACIONES</b>
                        </h2>                           
                    </div>
                </div>
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
                <div class="col-lg-4 col-md-4 col-sm-7 col-xs-12"> 
                    <div class="info-box-2 bg-green">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">EN PROCESO</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20">{{ $count_proceso }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-7 col-xs-12"> 
                    <div class="info-box-2 bg-cyan">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">ENVIADAS</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20">{{ $count_enviadas }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-7 col-xs-12"> 
                    <div class="info-box-2 bg-red">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">PROCESO FINALIZADO</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20">{{ $count_descartado }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                @foreach ($postulaciones as $elem)
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="card" style="height: 370px;"> 
                            @if ($elem->estado == 1)
                                <div class="header bg-green">
                            @elseif(is_null($elem->estado))
                                <div class="header bg-cyan">                                                    
                            @else
                                <div class="header bg-red">
                            @endif
                                <h2>
                                    {{ $elem->user_info->name }} <small>{{ $elem->oferta->nombre }}</small>
                                </h2> 
                            </div>
                            <div class="body">
                                <div class="user" style="background-image:url('../img/profiles/{{ $elem->user_info->avatar }}');"></div>
                                {{-- <img style="float: right; margin: 0px 0px 15px 20px; border-radius: 50%;" src="../img/profiles/{{ $elem->user_info->avatar }}" width="100" height="100"> --}}
                                <p>{{ substr($elem->descripcion, 0, 250) }}...</p>                                

                                @if ($elem->estado == 1)
                                    <a href="#" class="btn bg-green waves-effect">
                                        <i class="material-icons">donut_small</i>
                                        <span>Oferta en proceso</span>
                                    </a>
                                @elseif(is_null($elem->estado))
                                    <a href="#" class="btn bg-cyan waves-effect">
                                        <i class="material-icons">donut_small</i>
                                        <span>Postulación enviada</span>
                                    </a>                                                 
                                @else
                                <a href="#" class="btn bg-red waves-effect">
                                    <i class="material-icons">donut_small</i>
                                    <span>Proceso finalizado</span>
                                </a> 
                                @endif

                                <a href="{{ route('oferta', $elem->oferta_id)}}" class="btn bg-orange waves-effect">
                                    <i class="material-icons">next_week</i>
                                    <span>Ver oferta</span>
                                </a>
                            </div> 
                        </div>             
                    </div>
                @endforeach
            </div> 
    </section>
    @include('cpanel_postulante/recursos_cpanel/footer_js')
</body>
</html>