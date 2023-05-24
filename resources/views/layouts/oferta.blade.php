<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Empleo - BullMarketing</title>
    <link rel="icon" href="{{ asset('img/core-img/favicon.ico') }}">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive/responsive.css') }}" rel="stylesheet">
    <!--<link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet"/>-->
    <script src="https://kit.fontawesome.com/15bc5276a1.js" crossorigin="anonymous"></script>
    <style>
        .shadow_description {
            font-family: 'Poppins', sans-serif;
            color: #51545f;
            font-size: 14px;
            line-height: 2;
            font-weight: 400;
        }

        #more {display: none;}
    </style>
</head>
    <body>       
    <div id="app">
        @include('layouts/recursos/menu')

        <section id="ofertas" class="fancy-skills-area section-padding-100">
            <div class="container">
                @if (session('success'))
                    <div class="alert alert alert-warning">
                        <p>
                            <h6>{{ session('success') }} <a href='#formulario-postulacion'>aqu&iacute;.</p></h6>
                        </p>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <p>
                            <h6 class="text-danger">!Opps ha ocurrido un error</h6>
                        </p>
                        <ul>
                            @foreach ($errors->all() as $elem)
                                <li class="text-danger">{{ $elem }}</li>
                            @endforeach 
                        </ul>
                    </div>
                @endif 
                <div class="row">
                    <div class="col-12 col-md-3 col-xl-3 ml-auto mb-3">
                        <div class="skills-content"> 
                            <div class="card mb-0" style="border-radius: 1px; border: 1px solid #ebebeb;">
                                <div class="card-body">
                                    <label><h6>Detalles</h6></label>
                                    <div class="single-widget-area tags-widget">
                                        @if (!is_null($oferta->tipo_contrato))
                                            <a href="#">{{ $oferta->tipo_contrato }}</a>
                                        @endif
                                        @if (!is_null($oferta->sueldo))
                                            <a href="#">{{ number_format($oferta->sueldo ,2) }}</a>
                                        @endif
                                        @if (!is_null($oferta->fecha))
                                            <a href="#">{{ $oferta->fecha }}</a>
                                        @endif
                                        @if (!is_null($oferta->jornada))
                                            <a href="#">{{ $oferta->jornada }}</a>
                                        @endif
                                        @if (!is_null($oferta->ubicacion))
                                            <a href="#">{{ $oferta->ubicacion }}</a>
                                        @endif
                                    </div>
                                    <div class="row">
                                        @if (!is_null($oferta->archivo))
                                            <div class="col 12 col-md-12 col-xl-12 ml-auto mb-12">
                                                <label class="mt-4"><h6>Descargar archivo adjunto</h6></label>
                                                <a class="btn" href="/files/{{ $oferta->archivo }}" download="{{ $oferta->archivo_nombre }}">
                                                    <i class="fa-solid fa-file-pdf"></i>
                                                    <span>{{ substr($oferta->archivo_nombre, 0, 16) }}...</span> 
                                                </a>
                                            </div>                                            
                                        @endif
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>   
                    <div class="col-12 col-md-9 col-xl-9 ml-auto">
                        <div class="skills-content"> 
                            <div class="single-blog-area wow fadeInUp" data-wow-delay="0.5s">            
                                <div class="blog-content">
                                    <a href="#" style="font-size: 15px;">{{ $oferta->nombre }}</a>
                                    <small class="text-muted">
                                        <span class="mr-2"><i class="fa-solid fa-location-dot mr-2"></i>{{ $oferta->ubicacion }}</span>
                                        <span class="mr-2"><i class="fa-solid fa-business-time mr-2"></i>{{ $oferta->jornada }}</span>
                                        <span><i class="fa-solid fa-file-signature mr-2"></i>{{ $oferta->tipo_contrato }}</span>                                
                                    </small>
                                        <div id="shadow-description" class="shadow_description"></div>
                                        @php
                                            $date = strtotime($oferta->fecha);
                                            $remaining = $date - time();

                                            $days_remaining = floor($remaining / 86400);
                                            $hours_remaining = floor(($remaining % 86400) / 3600);
                                        @endphp 
                                    <small class="text-muted">
                                        <span class="mr-2">{{ $oferta->fecha }}</span>
                                        @if ($days_remaining < 0)
                                            <span class="mr-2">{{ "Cierra hoy" }}</span>
                                        @else
                                            <span class="mr-2">{{ "Cierra en $days_remaining días." }}</span>
                                        @endif
                                    </small>
                                    {{-- No eliminar --}}
                                    <div id="formulario-postulacion"></div>
                                    {{--  --}}
                                    @if ($oferta->prioridad == "Urgente.")
                                        <div class="tag dest_urg mr10 mb10">Empleo {{ $oferta->prioridad }}</div>                                                    
                                    @elseif ($oferta->prioridad == "Destacado.")
                                        <div class="tag dest mr10 mb10">Empleo {{ $oferta->prioridad }}</div>
                                    @else
                                                                                                                
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @auth
                        @php
                            $cont = 0;
                        @endphp
                        @foreach ($oferta->postulaciones as $elem)
                            @if (auth()->user()->id == $elem->user_id)
                                @php $cont++; @endphp
                            @endif
                        @endforeach                        
                        @if (auth()->user()->tipo_user == 2)
                            @if ($cont == 0)
                                @if ($oferta->tipo_oferta == 2)
                                    <div class="col-12 col-md-9 col-xl-9 ml-auto">
                                        <div class="form-group">        
                                            <form method="POST" action="{{ route('postular', $oferta->id) }}" enctype="multipart/form-data">
                                                @csrf 
                                                <div class="row col-12">
                                                    <div class="col-12">
                                                        <label class="mt-2"><h5>¿Por qué quieres trabajar con nosotros?</h5></label>
                                                        {{-- <label class="mt-2"><h5>¿Te interesa esta oferta laboral? postula tu hoja de vida!!</h5></label> --}}
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <textarea name="descripcion" class="form-control" id="message" maxlength="335" cols="30" rows="4" placeholder="Describe tu perfil profesional (incluye tu experiencia laboral: Cargos, Empresa y Tiempo laborado)." required=""></textarea>
                                                        </div>
                                                    </div>                                    
                                                </div>
                                                <div class="row col-12">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="ciudad">Número de celular</label>
                                                            <input type="number" name="contacto_1" class="form-control" placeholder="Número de contacto 1." required>
                                                        </div>
                                                    </div> 
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="ciudad">Número de celular de emergencia</label>
                                                            <input type="number" name="contacto_2" class="form-control" placeholder="Número de contacto 2 (opcional).">
                                                        </div>
                                                    </div>                                        
                                                </div>
                                                <div class="row col-12">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="ciudad">Aspiración salarial</label>
                                                            <select name="aspiracion" class="form-control" id="ciudad" required>
                                                                <option value="">Seleccionar</option>
                                                                <option value="1'000.000 - 1'500.000">1'000.000 - 1'500.000</option>
                                                                <option value="2'000.000 - 2'500.000">2'000.000 - 2'500.000</option>
                                                                <option value="3'000.000 - 3'500.000">3'000.000 - 3'500.000</option>
                                                                <option value="4'000.000 - 4'500.000">4'000.000 - 4'500.000</option>
                                                                <option value="Más de 5 millones">Mas de 5 millones</option>
                                                            </select>
                                                            {{-- <input type="number" name="" class="form-control" placeholder="Aspiración salarial." name="" required> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row col-12">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="select_pais">Pais de residencia</label>
                                                            <select name="pais" class="form-control" id="select_pais" required>
                                                                <option value="">Seleccionar</option>
                                                                @foreach ($paises as $elem)
                                                                    <option value="{{ $elem->id }}">{{ $elem->name }}</option>                                              
                                                                @endforeach>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="elem_estado">Departamento de residencia</label>
                                                            <select name="estado" class="form-control" id="elem_estado" required>
                                                                <option value="">Seleccionar</option>                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="elem_ciudad">Ciudad de residencia</label>
                                                            <select name="ciudad" class="form-control" id="elem_ciudad" required>
                                                                <option value="">Seleccionar</option>                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row col-12">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="cargo">Escoge el cargo al que te postulas</label>
                                                            <select name="cargo" class="form-control" id="cargo" required>
                                                                    <option value="">Seleccionar</option>                                              
                                                                @foreach (config('global.cargo') as $elem)
                                                                    <option value="{{ $elem }}">{{ $elem }}</option>                                              
                                                                @endforeach>
                                                            </select>
                                                        </div> 
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>¿Ya haz trabajado con Bull Marketing?</label>
                                                            <select name="ex_bull" class="form-control" required>
                                                                <option value="">Seleccionar</option>                                                                
                                                                <option value="1">Sí</option>                                                                
                                                                <option value="0">No</option>                                                                
                                                            </select>
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="row col-12">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlFile1">Tu hoja de vida actualizada</label>
                                                            <input type="file" accept=".pdf" class="form-control" id="exampleFormControlFile1" required name="hoja_vida">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn fancy-btn fancy-dark bg-transparent">Postular</button>
                                                    </div>
                                                </div>
                                                @guest
                                                    <div class="col-12 mt-3">
                                                        <span class="text-muted">¿No tienes cuenta? necesitas una para postularte</span><br><a href="/oferta-register/{{ $oferta->id }}"> Regístrate aquí</a>
                                                    </div>
                                                @endguest
                                            </form>
                                        </div>
                                    </div>
                                @elseif($oferta->tipo_oferta == 1)
                                    <div class="col-12 col-md-9 col-xl-9 ml-auto">
                                        <div class="form-group">       
                                            <form method="POST" action="{{ route('postular', $oferta->id) }}" enctype="multipart/form-data">
                                                @csrf 
                                                <div class="row col-12">
                                                    <div class="col-12">
                                                        <label class="mt-2"><h5>¿Por qué quieres trabajar con nosotros?</h5></label>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <textarea name="descripcion" class="form-control" id="message" maxlength="335" cols="30" rows="4" placeholder="Describe tu perfil profesional (incluye tu experiencia laboral: Cargos, Empresa y Tiempo laborado)." required=""></textarea>
                                                        </div>
                                                    </div>                                    
                                                </div>
                                                <div class="row col-12">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="ciudad">Número de celular</label>
                                                            <input type="number" name="contacto_1" class="form-control" placeholder="Número de contacto 1." required>
                                                        </div>
                                                    </div> 
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="ciudad">Número de celular de emergencia</label>
                                                            <input type="number" name="contacto_2" class="form-control" placeholder="Número de contacto 2 (opcional).">
                                                        </div>
                                                    </div>                                        
                                                </div>
                                                <div class="row col-12">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="ciudad">Aspiración salarial</label>
                                                            <select name="aspiracion" class="form-control" id="ciudad" required>
                                                                <option value="">Seleccionar</option>
                                                                <option value="1'000.000 - 1'500.000">1'000.000 - 1'500.000</option>
                                                                <option value="1'000.000 - 1'500.000">1'000.000 - 1'500.000</option>
                                                                <option value="2'000.000 - 2'500.000">2'000.000 - 2'500.000</option>
                                                                <option value="3'000.000 - 3'500.000">3'000.000 - 3'500.000</option>
                                                                <option value="4'000.000 - 4'500.000">4'000.000 - 4'500.000</option>
                                                                <option value="Más 5 de millones">Más 5 de millones</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row col-12">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="select_pais">Pais de residencia</label>
                                                            <select name="pais" class="form-control" id="select_pais" required>
                                                                <option value="#">Seleccionar</option>
                                                                @foreach ($paises as $elem)
                                                                    <option value="{{ $elem->id }}">{{ $elem->name }}</option>                                              
                                                                @endforeach>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="elem_estado">Departamento de residencia</label>
                                                            <select name="estado" class="form-control" id="elem_estado" required>
                                                                <option value="#">Seleccionar</option>                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="elem_ciudad">Ciudad de residencia</label>
                                                            <select name="ciudad" class="form-control" id="elem_ciudad" required>
                                                                <option value="">Seleccionar</option>                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row col-12">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>¿Ya haz trabajado con Bull Marketing?</label>
                                                            <select name="ex_bull" class="form-control" required>
                                                                <option value="">Seleccionar</option>                                                                
                                                                <option value="1">Sí</option>                                                                
                                                                <option value="0">No</option>                                                                
                                                            </select>
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="row col-12">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlFile1">Tu hoja de vida actualizada</label>
                                                            <input type="file" accept=".pdf" class="form-control" id="exampleFormControlFile1" required name="hoja_vida">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn fancy-btn fancy-dark bg-transparent">Postular</button>
                                                    </div>
                                                </div>
                                                @guest 
                                                    <div class="col-12 mt-3">
                                                        <span class="text-muted">¿No tienes cuenta? necesitas una para postularte</span><br><a href="/register"> Regístrate aquí</a>
                                                    </div>
                                                @endguest
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            @else 
                                <div class="col-12 col-md-9 col-xl-9 ml-auto">
                                    <h4 style="text-align: center;">Ya te haz postulado en esta oferta...</h4>
                                    <h6 style="text-align: center;"><a href="/">Explora nuevas ofertas</a></h6>
                                </div>     
                            @endif
                        @endif
                    @endauth
                    @guest
                    <div class="col-12 col-md-9 col-xl-9 ml-auto">
                        <div class="col-12 mt-3">
                            <span class="text-muted">¿No tienes cuenta? necesitas una para postularte</span><br><a href="/oferta-register/{{ $oferta->id }}"> Regístrate aquí</a>
                        </div>
                    </div>
                    @endguest
                </div>
        </section> 
        @include('layouts/recursos/footer')
    </div>  
    <script type="text/javascript" src="{{ asset('js/jquery/jquery-2.2.4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/others/plugins.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/active.js') }}"></script>
    <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
    <script type="text/javascript">
        inicio()
        function inicio (){
            const elem = document.getElementById('shadow-description');
            const shadowRoot = elem.attachShadow({mode: 'open'});
            shadowRoot.innerHTML =  `
            <style>
                p img {
                width: 100% !important;
                height: auto !important;
                }
            </style>` + `{!! trim($oferta->descripcion) !!}`;
        }

        const csrftoken = document.getElementsByName('_token')[0].value
        let select_pais = document.getElementById('select_pais')
        let elem_estado = document.getElementById('elem_estado')
        let elem_ciudad = document.getElementById('elem_ciudad')

        select_pais.addEventListener('change', get_estado)
        elem_estado.addEventListener('change', get_ciudad)

        function get_estado (){
                elem_estado.innerHTML = "";
                var url = '/get_estados';
                var data = {id: select_pais.value};
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
                    for (let i in response.estados) {
                        elem_estado.innerHTML += `<option value='${ response.estados[i].id }'>${ response.estados[i].name }</option>`
                    }                 
                });
            }
            
            function get_ciudad (){
                elem_ciudad.innerHTML = "";
                var url = '/get_ciudades';
                var data = {id: elem_estado.value};
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
                    for (let i in response.ciudades) {
                        elem_ciudad.innerHTML += `<option value='${ response.ciudades[i].name }'>${ response.ciudades[i].name }</option>`
                    }                 
                });
            }
    </script>
</body>
</html>
