<!-- Work with us -->
<section id="ofertas" class="fancy-skills-area section-padding-100">
    <div class="container">
        <div class="col-12 col-md-12 col-xl-12">
            <div class="about-us-text">
                <h2>¿Quieres hacer parte de nuestro equipo?</h2>
                <p>Revisa nuestras ofertas laborales y postula tu hoja de vida.</p>
            </div>
        </div>
        <div class="row"> 
            <div class="col-12 col-md-4 col-xl-4 ml-auto"> 
                <div class="row d-none d-md-block">
                    <div class="col-12 col-md-12 col-xl-12">
                        <div class="skills-content"> 
                            <div class="col-12 col-md-12">
                                <div class="card mb-0 border-bottom-0" style="border-radius: 1px; border: 1px solid #ebebeb; background-color:#fbfbfb;">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect2"><h6>Ordenar por</h6></label>
                                            <select onChange="window.location.href=this.value" class="form-control" id="exampleFormControlSelect2" style="overflow-x: auto">
                                                <option value="#">Seleccionar</option>
                                                <option value="/home/recientes">Más recientes</option>
                                                <option value="/home/antiguas">Más antiguas</option>
                                            </select>
                                          </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                    <div class="col-12 col-md-12 col-xl-12 ml-auto">
                        <div class="skills-content"> 
                            <div class="col-12 col-md-12">
                                <div class="card mb-0 border-bottom-0 border-top-0 bg-gray" style="border-radius: 1px; border: 1px solid #ebebeb; background-color:#fbfbfb;">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect2"><h6>Ubicación</h6></label>
                                            <select onChange="window.location.href=this.value" multiple class="form-control" id="exampleFormControlSelect2" style="overflow-x: auto">
                                                <option value="#">Seleccionar</option>                                            
                                                @foreach ($filtros['ubicaciones'] as $elem)
                                                    @if (!is_null($elem->ubicacion))
                                                        <option value="/home/ubicacion/{{ $elem->ubicacion }}">{{ $elem->ubicacion }} ({{ $elem->conteo }}).</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="card mb-0 border-bottom-0 border-top-0 bg-gray" style="border-radius: 1px; border: 1px solid #ebebeb; background-color:#fbfbfb;">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect2"><h6>Área laboral</h6></label>
                                            <select onChange="window.location.href=this.value" multiple class="form-control" id="exampleFormControlSelect2" style="overflow-x: auto">
                                                <option value="#">Seleccionar</option>                                            
                                                @foreach ($filtros['area'] as $elem)
                                                    @if (!is_null($elem->area)) 
                                                        <option value="/home/area/{{ str_replace(' ', '_', $elem->area) }}">{{ $elem->area }} ({{ $elem->conteo }}).</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="card mb-0 border-bottom-0 border-top-0 bg-gray" style="border-radius: 1px; border: 1px solid #ebebeb; background-color:#fbfbfb;">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect2"><h6>Tipo de jornada</h6></label>
                                            <select onChange="window.location.href=this.value" multiple class="form-control" id="exampleFormControlSelect2" style="overflow-x: auto">
                                                <option value="#">Seleccionar</option>
                                                @foreach ($filtros['jornada'] as $elem)
                                                    @if (!is_null($elem->jornada))
                                                        <option value="/home/jornada/{{ str_replace(' ', '_', $elem->jornada) }}">{{ $elem->jornada }} ({{ $elem->conteo }}).</option>                                            
                                                    @endif
                                                @endforeach>
                                            </select>
                                        </div>
                                    </div>
                                </div> 
                            </div> 
                            <div class="col-12 col-md-12">
                                <div class="card mb-0 border-bottom-0 border-top-0 bg-gray" style="border-radius: 1px; border: 1px solid #ebebeb; background-color:#fbfbfb;">
                                    <div class="card-body">
                                        <div class="form-group"> 
                                            <label for="exampleFormControlSelect2"><h6>Prioridades</h6></label>
                                            <select onChange="window.location.href=this.value" multiple class="form-control" id="exampleFormControlSelect2" style="overflow-x: auto">
                                                <option value="#">Seleccionar</option>
                                                @foreach ($filtros['prioridad'] as $elem)
                                                    @if(!is_null($elem->prioridad))
                                                        <option value="/home/prioridad/{{ str_replace(' ', '_', $elem->prioridad) }}">{{ $elem->prioridad }} ({{ $elem->conteo }}).</option>                                            
                                                    @endif
                                                @endforeach>
                                            </select> 
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="card border-top-0 bg-gray" style="border-radius: 1px; border: 1px solid #ebebeb; background-color:#fbfbfb;">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect2"><h6>Tipo de contrato</h6></label>
                                            <select onChange="window.location.href=this.value" multiple class="form-control" id="exampleFormControlSelect2" style="overflow-x: auto">
                                                <option value="#">Seleccionar</option>
                                                @foreach ($filtros['tipo_contrato'] as $elem)
                                                    @if (!is_null($elem->tipo_contrato))
                                                        <option value="/home/tipo_contrato/{{ str_replace(' ', '_', $elem->tipo_contrato) }}">{{ $elem->tipo_contrato }} ({{ $elem->conteo }}).</option>                                            
                                                    @endif
                                                @endforeach>
                                            </select>
                                        </div> 
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div> 
                </div> 
            </div> 
            <div class="col-12 col-md-8 col-xl-8 ml-auto">
                <div class="row">
                
                    @if ($ofertas)
                        @foreach ($ofertas as $elem)
                            @if ($elem->tipo_oferta == 1)
                                <div class="col-12 col-md-12 col-xl-12 ml-auto">
                                    <div class="skills-content"> 
                                        <div class="col-12 col-md-12"> 
                                            <div class="single-blog-area wow fadeInUp" data-wow-delay="0.5s">            
                                                <div class="blog-content">
                                                    <a href="{{ route('oferta', $elem->id)}}" style="font-size: 15px;">{{ $elem->nombre }}</a>
                                                    <small class="text-muted">
                                                        <span class="mr-2"><i class="fa-solid fa-location-dot mr-2"></i>{{ $elem->ubicacion }}</span>
                                                        <span class="mr-2"><i class="fa-solid fa-business-time mr-2"></i>{{ $elem->jornada }}</span>
                                                        <span><i class="fa-solid fa-file-signature mr-2"></i>{{ $elem->tipo_contrato }}</span>                                
                                                    </small>
                                                    <p>
                                                        @php
                                                            echo substr(strip_tags($elem->descripcion), 0, 280); 
                                                        @endphp
                                                    </p>
                                                    @php
                                                        $date = strtotime($elem->fecha);
                                                        $remaining = $date - time();

                                                        $days_remaining = floor($remaining / 86400);
                                                        $hours_remaining = floor(($remaining % 86400) / 3600);
                                                    @endphp 
                                                    <small class="text-muted">
                                                    <span class="mr-2">{{ $elem->fecha }}</span>
                                                    @if ($days_remaining < 0)
                                                        <span class="mr-2">{{ "Cierra hoy" }}</span>
                                                    @else
                                                        <span class="mr-2">{{ "Cierra en $days_remaining días." }}</span>
                                                    @endif 
                                                    </small> 
                                                    @if ($elem->prioridad == "Urgente.")
                                                        <div class="tag dest_urg mr10 mb10">Empleo {{ $elem->prioridad }}</div>                                                    
                                                    @elseif ($elem->prioridad == "Destacado.")
                                                        <div class="tag dest mr10 mb10">Empleo {{ $elem->prioridad }}</div>
                                                    @else
                                                                                                                            
                                                    @endif
                                                    <a href="{{ route('oferta', $elem->id)}}">Leer más</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                     
                            @endif
                        @endforeach
                    @else
                        <h2>Opps! No tenemos ofertas aquí..</h2>
                    @endif
                </div>            
            </div>
        </div>
    </div>
</section>
