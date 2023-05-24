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
                                <b>POSTULACIONES</b>
                            </h2>                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                @foreach ($ofertas as $elem)
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">                       
                        <div class="card">
                            <div class="header bg-deep-orange">
                                <h2>
                                    {{ $elem->nombre }} <small>{{ $elem->ubicacion }} - {{ $elem->fecha }}</small>
                                </h2>
                            </div>
                            <div class="body">                                                                
                                <div role="tabpanel" class="tab-pane fade in active" id="info{{$elem->id}}">
                                    <ul class="list-group">
                                        <li class="list-group-item"><b>Contrato:</b> {{ substr($elem->tipo_contrato, 0, 100) }}</li>
                                        <li class="list-group-item"><b>Sueldo:</b>@php echo " ".number_format($elem->sueldo ,2); @endphp</li>
                                        {{-- <li class="list-group-item"><b>Prioridad:</b> {{ substr($elem->prioridad, 0, 100) }}</li> --}}
                                        <li class="list-group-item"><b>Jornada:</b> {{ substr($elem->jornada, 0, 100) }}</li>                                            
                                    </ul>
                                    <div style="margin: 5px;">                                          
                                        <a href="{{ route('postulados', $elem->id) }}" class="btn bg-blue waves-effect">
                                            <i class="material-icons">group</i>
                                            Postulados
                                            <span class="badge">{{ count($elem->postulaciones) }}</span>
                                        </a>                                                                                
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