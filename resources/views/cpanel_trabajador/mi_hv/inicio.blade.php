<!DOCTYPE html>
<html lang="en"> 
    @include('cpanel_trabajador/recursos_cpanel/head')
<body class="theme-red">
    @include('cpanel_trabajador/recursos_cpanel/nav')
    <section>
        @include('cpanel_trabajador/recursos_cpanel/menu_vertical') 
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
                <div class="card">
                    <div class="header">
                        <h2> 
                            MI HOJA DE VIDA
                            <small>Manten tus datos actualizados.</small>
                        </h2>                        
                    </div>
                    <div class="body">
                        <form action="{{ route('validate_hoja_vida', Auth::user()->id) }}" method="POST">
                            @csrf
                            <h2 class="card-inside-title">DATOS BÁSICOS</h2>
                            <div class="row clearfix"> 
                                <div class="col-sm-3">
                                    <div class="form-group"> 
                                        <label for="primer_nombre">Primer nombre: *</label>
                                        <div class="form-line">
                                            @isset($hoja_vida)
                                                <input name="primer_nombre" id="primer_nombre" type="text" class="form-control" value="{{ $hoja_vida->primer_nombre }}" required/>
                                            @else
                                                <input name="primer_nombre" id="primer_nombre" type="text" class="form-control" value="" required/>
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="segundo_nombre">Segundo nombre:</label>
                                        <div class="form-line">
                                            @isset($hoja_vida)
                                                <input name="segundo_nombre" id="segundo_nombre" type="text" class="form-control" value="{{ $hoja_vida->segundo_nombre }}"/>
                                            @else
                                                <input name="segundo_nombre" id="segundo_nombre" type="text" class="form-control"/>
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="primer_apellido">Primer apellido: *</label>
                                        <div class="form-line">
                                            @isset($hoja_vida)
                                                <input name="primer_apellido" id="primer_apellido" type="text" class="form-control" value="{{ $hoja_vida->primer_apellido }}" required/>
                                            @else
                                                <input name="primer_apellido" id="primer_apellido" type="text" class="form-control" required/>
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="segundo_apellido">Segundo apellido:</label>
                                        <div class="form-line">
                                            @isset($hoja_vida)
                                                <input name="segundo_apellido" id="segundo_apellido" type="text" class="form-control" value="{{ $hoja_vida->segundo_apellido }}" />
                                            @else
                                                <input name="segundo_apellido" id="segundo_apellido" type="text" class="form-control" />
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            
                            
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="tipo_documento">Tipo de documento *</label>
                                        <div class="form-line">
                                            <select name="tipo_documento" id="tipo_documento" class="form-control show-tick" name="area" required>
                                                <option value="">Seleccionar</option>
                                                @foreach ($tipos_documentos as $elem)
                                                    @isset($hoja_vida)
                                                        @if ($hoja_vida->tipo_documento == $elem->id)
                                                            <option selected value="{{ $elem->id }}">{{ $elem->descripcion }}</option> 
                                                        @else
                                                            <option value="{{ $elem->id }}">{{ $elem->descripcion }}</option>
                                                        @endif
                                                    @else
                                                        <option value="{{ $elem->id }}">{{ $elem->descripcion }}</option>
                                                    @endisset
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="numero_documento">Número de documento *</label>
                                        <div class="form-line">
                                            @isset($hoja_vida)
                                                <input name="documento" id="numero_documento" type="text" class="form-control" value="{{ $hoja_vida->documento }}" required/>
                                            @else
                                                <input name="documento" id="numero_documento" type="text" class="form-control" required/> 
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- País documento --}}
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="select_pais_documento">País de identificación *</label>
                                        <div class="form-line">
                                            <select id="select_pais_documento" name="pais_documento" class="form-control show-tick" name="area" required>
                                                <option value="">Seleccionar</option>                                         
                                                @foreach ($paises as $elem)
                                                    @isset($hoja_vida)
                                                        @if ($hoja_vida->pais_documento == $elem->id)
                                                            <option selected value="{{ $elem->id }}">{{ $elem->name }}</option>
                                                        @else
                                                            <option value="{{ $elem->id }}">{{ $elem->name }}</option>
                                                        @endif
                                                    @else
                                                        <option value="{{ $elem->id }}">{{ $elem->name }}</option>
                                                    @endisset
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="select_estado">Departamento de identificación</label>
                                        <div id="loader-elem_estado_documento" class="preloader pl-size-xs" style="display: none">
                                            <div class="spinner-layer pl-green">
                                                <div class="circle-clipper left">
                                                    <div class="circle"></div>
                                                </div>
                                                <div class="circle-clipper right">
                                                    <div class="circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="elem_estado_documento" class="form-line">
                                            <select name="dep_documento" class="form-control show-tick"> 
                                                @isset($hoja_vida)
                                                    <option selected value="{{ $hoja_vida->dep_documento }}">{{ $hoja_vida->dep_doc->name }}</option> 
                                                @else
                                                    <option selected value="">---</option>
                                                @endisset
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4"> 
                                    <div class="form-group">
                                        <label for="ciudad_identificacion">Ciudad de identificación</label>
                                        <div id="loader-elem_ciudad_documento" class="preloader pl-size-xs" style="display: none">
                                            <div class="spinner-layer pl-green">
                                                <div class="circle-clipper left">
                                                    <div class="circle"></div>
                                                </div>
                                                <div class="circle-clipper right">
                                                    <div class="circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="elem_ciudad_documento" class="form-line">
                                            <select name="ciu_documento" class="form-control show-tick">
                                                @isset($hoja_vida)
                                                    <option selected value="{{ $hoja_vida->ciu_documento }}">{{ $hoja_vida->ciu_doc->name }}</option>
                                                @else
                                                    <option selected value="">---</option>
                                                @endisset                                    
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- País nacimiento --}}
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="select_pais_nacimiento">País de nacimiento *</label>
                                        <div class="form-line">
                                            <select name="pais_nacimiento" id="select_pais_nacimiento" class="form-control show-tick" required>
                                                <option selected value="">Seleccionar</option>
                                                @foreach ($paises as $elem)
                                                    @isset($hoja_vida)
                                                        @if ($hoja_vida->pais_nacimiento == $elem->id)
                                                            <option selected value="{{ $elem->id }}">{{ $elem->name }}</option>
                                                        @else
                                                            <option value="{{ $elem->id }}">{{ $elem->name }}</option>
                                                        @endif
                                                    @else
                                                        <option value="{{ $elem->id }}">{{ $elem->name }}</option>
                                                    @endisset
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="dep_nacimiento">Departamento de nacimiento</label>
                                        <div id="loader-elem_estado_nacimiento" class="preloader pl-size-xs" style="display: none">
                                            <div class="spinner-layer pl-green">
                                                <div class="circle-clipper left">
                                                    <div class="circle"></div>
                                                </div>
                                                <div class="circle-clipper right">
                                                    <div class="circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="elem_estado_nacimiento" class="form-line">
                                            <select id="dep_nacimiento" name="dep_nacimiento" class="form-control show-tick" name="area">
                                                @isset($hoja_vida)
                                                    <option selected value="{{ $hoja_vida->dep_nacimiento }}">{{ $hoja_vida->dep_naci->name }}</option>
                                                @else
                                                    <option selected value="">---</option>
                                                @endisset                                   
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="ciudad_nacimiento">Ciudad de nacimiento</label>
                                        <div id="loader-elem_ciudad_nacimiento" class="preloader pl-size-xs" style="display: none">
                                            <div class="spinner-layer pl-green">
                                                <div class="circle-clipper left">
                                                    <div class="circle"></div>
                                                </div>
                                                <div class="circle-clipper right">
                                                    <div class="circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="elem_ciudad_nacimiento" class="form-line">
                                            <select name="ciu_nacimiento" id="ciudad_nacimiento" class="form-control show-tick">
                                                @isset($hoja_vida)
                                                    <option selected value="{{ $hoja_vida->ciu_nacimiento }}">{{ $hoja_vida->ciu_naci->name }}</option>
                                                @else
                                                    <option selected value="">---</option>
                                                @endisset                                   
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="fecha_nacimiento">Fecha de nacimiento *</label>
                                        <div class="form-line">
                                            @isset($hoja_vida)
                                                <input name="fecha_nacimiento" id="fecha_nacimiento" type="date" class="form-control" value="{{ $hoja_vida->fecha_nacimiento }}"/>
                                            @else
                                                <input name="fecha_nacimiento" id="fecha_nacimiento" type="date" class="form-control"/>
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="genero">Género *</label>
                                        <div class="form-line">
                                            <select name="genero" id="genero" class="form-control show-tick">
                                                <option selected value="">Seleccionar</option>
                                                @isset($hoja_vida)
                                                    @foreach (config('global.genero') as $elem)
                                                        @if ($hoja_vida->genero == $elem)
                                                            <option selected value="{{ $elem }}">{{ $elem }}</option>
                                                        @else
                                                            <option value="{{ $elem }}">{{ $elem }}</option>
                                                        @endif
                                                    @endforeach                             
                                                @else
                                                    @foreach (config('global.genero') as $elem)
                                                        <option value="{{ $elem }}">{{ $elem }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="estado_civil">Estado civil *</label>
                                        <div class="form-line">
                                            <select name="estado_civil" id="estado_civil" class="form-control show-tick">
                                                @isset($hoja_vida)
                                                    @foreach (config('global.estado_civil') as $elem)
                                                        @if ($hoja_vida->estado_civil == $elem)
                                                            <option selected value="{{ $elem }}">{{ $elem }}</option>
                                                        @else
                                                            <option value="{{ $elem }}">{{ $elem }}</option>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <option value="">Seleccionar</option>
                                                    @foreach (config('global.estado_civil') as $elem)
                                                        <option value="{{ $elem }}">{{ $elem }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="nacionalidad">Nacionalidad *</label>
                                        <div class="form-line">
                                            <select name="nacionalidad" id="nacionalidad" class="form-control show-tick" name="area" required>
                                                <option value="">Seleccionar</option>
                                                @isset($hoja_vida)
                                                    @foreach (config('global.nacionalidad') as $elem)
                                                        @if ($hoja_vida->nacionalidad == $elem)
                                                            <option selected value="{{ $elem }}">{{ $elem }}</option>
                                                        @else
                                                            <option value="{{ $elem }}">{{ $elem }}</option>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    @foreach (config('global.nacionalidad') as $elem)
                                                        <option value="{{ $elem }}">{{ $elem }}</option>
                                                    @endforeach
                                                @endisset                                     
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="grupo_sanguineo">Grupo sanguíneo *</label>
                                        <div class="form-line">
                                            <select name="grupo_sanguineo" id="grupo_sanguineo" class="form-control show-tick" name="area" required>
                                                <option value="">Seleccionar</option>                                              
                                                @isset($hoja_vida)
                                                    @foreach (config('global.grupo_sanguineo') as $elem)
                                                        @if ($hoja_vida->grupo_sanguineo == $elem)
                                                            <option selected value="{{ $elem }}">{{ $elem }}</option>
                                                        @else
                                                            <option value="{{ $elem }}">{{ $elem }}</option>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    @foreach (config('global.grupo_sanguineo') as $elem)
                                                        <option value="{{ $elem }}">{{ $elem }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="rh">Factor RH: *</label>
                                        <div class="form-line">
                                            <select name="rh" id="rh" required>
                                                <option value="">Seleccionar</option> 
                                                @isset($hoja_vida)
                                                    @if ($hoja_vida->rh == "+")
                                                        <option selected value="+">+</option>                                           
                                                        <option value="-">-</option>
                                                    @else    
                                                        <option value="+">+</option>                                           
                                                        <option selected value="-">-</option>
                                                    @endif                                
                                                @else
                                                    <option value="+">+</option>                                           
                                                    <option value="-">-</option>                                                                                                  
                                                @endif                                            
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                                        
                            <h2 class="card-inside-title" >VIVIENDA Y CONTACTO</h2>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="nacionalidad">Email *</label>
                                        <div class="form-line">
                                            @isset($hoja_vida)
                                                <input name="email" id="fecha_nacimiento" type="email" class="form-control" required value="{{ $hoja_vida->email }}"/>
                                            @else
                                                <input name="email" id="fecha_nacimiento" type="email" class="form-control" required/>
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="grupo_sanguineo">Email alternativo</label>
                                        <div class="form-line">
                                            @isset($hoja_vida)
                                                <input name="email_alternativo" id="fecha_nacimiento" type="email" class="form-control" value="{{ $hoja_vida->email_alternativo }}"/>
                                            @else
                                                <input name="email_alternativo" id="fecha_nacimiento" type="email" class="form-control"/>
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                        
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="select_pais_residensia">País donde reside *</label>
                                        <div class="form-line">
                                            <select name="pais_recidencia" id="select_pais_residensia" class="form-control show-tick" required>
                                                <option value="">Seleccionar</option>                                         
                                                @foreach ($paises as $elem)
                                                    @isset($hoja_vida)
                                                        @if ($hoja_vida->pais_recidencia == $elem->id)
                                                            <option selected value="{{ $elem->id }}">{{ $elem->name }}</option>
                                                        @else
                                                            <option value="{{ $elem->id }}">{{ $elem->name }}</option>
                                                        @endif
                                                    @else
                                                        <option value="{{ $elem->id }}">{{ $elem->name }}</option>
                                                    @endisset
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="dep_recidencia">Departamento donde reside</label>
                                        <div id="loader-elem_estado_residensia" class="preloader pl-size-xs" style="display: none">
                                            <div class="spinner-layer pl-green">
                                                <div class="circle-clipper left">
                                                    <div class="circle"></div>
                                                </div>
                                                <div class="circle-clipper right">
                                                    <div class="circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="elem_estado_residensia" class="form-line">
                                            <select id="dep_recidencia" name="dep_recidencia" class="form-control show-tick" name="area">
                                                @isset($hoja_vida)
                                                    <option selected value="{{ $hoja_vida->dep_recidencia }}">{{ $hoja_vida->dep_resi->name }}</option>
                                                @else
                                                    <option selected value="">---</option>
                                                @endisset
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="ciu_recidencia">Ciudad donde reside</label>
                                        <div id="loader-elem_ciudad_residensia" class="preloader pl-size-xs" style="display: none">
                                            <div class="spinner-layer pl-green">
                                                <div class="circle-clipper left">
                                                    <div class="circle"></div>
                                                </div>
                                                <div class="circle-clipper right">
                                                    <div class="circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="elem_ciudad_residensia" class="form-line">
                                            <select id="ciu_recidencia" name="ciu_recidencia" class="form-control show-tick" name="area">
                                                @isset($hoja_vida)
                                                    <option selected value="{{ $hoja_vida->ciu_recidencia }}">{{ $hoja_vida->ciu_resi->name }}</option>
                                                @else
                                                    <option selected value="">---</option>
                                                @endisset                              
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="direccion">Direccion *</label>
                                        <div class="form-line">
                                            @isset($hoja_vida)
                                                <input name="direccion" id="direccion" type="text" class="form-control" required value="{{ $hoja_vida->direccion }}"/>
                                            @else
                                                <input name="direccion" id="direccion" type="text" class="form-control" required/>
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="celular">Celular *</label>
                                        <div class="form-line">
                                            @isset($hoja_vida)
                                                <input name="celular" id="celular" type="number" class="form-control" required value="{{ $hoja_vida->celular }}"/>
                                            @else
                                                <input name="celular" id="celular" type="number" class="form-control" required/>
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="telefono">Teléfono</label>
                                        <div class="form-line">
                                            @isset($hoja_vida)
                                                <input name="telefono" id="telefono" type="number" class="form-control" value="{{ $hoja_vida->telefono }}"/>
                                            @else
                                                <input name="telefono" id="telefono" type="number" class="form-control"/>
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            </div>            
                        
                            <h2 class="card-inside-title">FORMACIÓN</h2>
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="nivel_academico">Nivel academico</label>
                                            <div class="form-line">
                                                <select name="nivel_academico" id="nivel_academico" class="form-control show-tick" name="area" required>
                                                    <option selected value="">Seleccionar</option>
                                                    @isset($hoja_vida)
                                                        @foreach (config('global.educacion') as $elem)
                                                            @if ($hoja_vida->nivel_academico == $elem)
                                                                <option selected value="{{ $elem }}">{{ $elem }}</option>
                                                            @else
                                                                <option value="{{ $elem }}">{{ $elem }}</option>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        @foreach (config('global.educacion') as $elem)
                                                            <option value="{{ $elem }}">{{ $elem }}</option>
                                                        @endforeach
                                                    @endisset
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="nivel_academico">Cargo</label>
                                                <div class="form-line">
                                                    <select name="cargo" id="nivel_academico" class="form-control show-tick" required>
                                                        <option selected value="">Seleccionar</option>
                                                        @isset($hoja_vida)
                                                            @foreach (config('global.cargo') as $elem) 
                                                                @if ($hoja_vida->cargo == $elem)
                                                                    <option selected value="{{ $elem }}">{{ $elem }}</option>
                                                                @else
                                                                    <option value="{{ $elem }}">{{ $elem }}</option>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            @foreach (config('global.cargo') as $elem)
                                                                <option value="{{ $elem }}">{{ $elem }}</option>
                                                            @endforeach
                                                        @endisset
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12" style="padding-left: 100px; padding-right: 100px;">
                                            <button type="submit" class="btn btn-block btn-lg bg-deep-orange waves-effect">
                                                <i class="material-icons">save</i>
                                                <span>GUARDAR</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>                        
                    </div>
                </div>
            </div> 
        </section>
        <script>
            const csrftoken = document.getElementsByName('_token')[0].value;

            /* Documento */
            let select_pais_documento = document.getElementById('select_pais_documento');
            let elem_estado_documento = document.getElementById('elem_estado_documento');
            let elem_ciudad_documento = document.getElementById('elem_ciudad_documento');

            /* Nacimiento */
            let select_pais_nacimiento = document.getElementById('select_pais_nacimiento');
            let elem_estado_nacimiento = document.getElementById('elem_estado_nacimiento');
            let elem_ciudad_nacimiento = document.getElementById('elem_ciudad_nacimiento');

            /* Residensia */
            let select_pais_residensia = document.getElementById('select_pais_residensia');
            let elem_estado_residensia = document.getElementById('elem_estado_residensia');
            let elem_ciudad_residensia = document.getElementById('elem_ciudad_residensia');

            /*-----------------------------------------------------------------------------*/

            /* Documento */
            select_pais_documento.addEventListener('change', get_estado_documento)
            /* Nacimiento */
            select_pais_nacimiento.addEventListener('change', get_estado_nacimiento)
            /* Residensia */
            select_pais_residensia.addEventListener('change', get_estado_residensia)
            
            /* Residensia */
            function get_estado_residensia (){
                document.getElementById('loader-elem_estado_residensia').style.display = 'block'
                document.getElementById('elem_estado_residensia').style.display = 'none'
                
                elem_estado_residensia.innerHTML = "";
                let select_estado_residensia = document.createElement("select");
                select_estado_residensia.setAttribute("id", "select_estado_residensia");
                select_estado_residensia.setAttribute("name", "dep_recidencia");
                select_estado_residensia.setAttribute("class", "form-control show-tick");
                
                // Evento para estado
                select_estado_residensia.addEventListener('change', get_ciudad_residensia)               

                var url = '/get_estados';
                var data = {id: select_pais_residensia.value};
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
                    select_estado_residensia.innerHTML = "<option value=''>Seleccionar</option>"
                    for (let i in response.estados) {
                        select_estado_residensia.innerHTML += `<option value='${ response.estados[i].id }'>${ response.estados[i].name }</option>`
                    }
                    elem_estado_residensia.appendChild(select_estado_residensia);
                    document.getElementById('loader-elem_estado_residensia').style.display = 'none'
                    document.getElementById('elem_estado_residensia').style.display = 'block'                 
                });
            }
            
            /* Residensia */
            function get_ciudad_residensia (){
                document.getElementById('loader-elem_ciudad_residensia').style.display = 'block'
                document.getElementById('elem_ciudad_residensia').style.display = 'none'

                elem_ciudad_residensia.innerHTML = "";
                let select_ciudad_residensia = document.createElement("select");
                select_ciudad_residensia.setAttribute("id", "select_ciudad");
                select_ciudad_residensia.setAttribute("name", "ciu_recidencia");
                select_ciudad_residensia.setAttribute("class", "form-control show-tick");

                var url = '/get_ciudades';
                var data = {id: select_estado_residensia.value};
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
                    select_ciudad_residensia.innerHTML = "<option value=''>Seleccionar</option>"
                    for (let i in response.ciudades) {
                        select_ciudad_residensia.innerHTML += `<option value='${ response.ciudades[i].id }'>${ response.ciudades[i].name }</option>`
                    }
                    elem_ciudad_residensia.appendChild(select_ciudad_residensia);
                    document.getElementById('loader-elem_ciudad_residensia').style.display = 'none'
                    document.getElementById('elem_ciudad_residensia').style.display = 'block'
                });
            }

            /* Nacimineto */
            function get_estado_nacimiento (){
                document.getElementById('loader-elem_estado_nacimiento').style.display = 'block'
                document.getElementById('elem_estado_nacimiento').style.display = 'none'
                
                elem_estado_nacimiento.innerHTML = "";
                let select_estado_nacimiento = document.createElement("select");
                select_estado_nacimiento.setAttribute("id", "select_estado_nacimiento");
                select_estado_nacimiento.setAttribute("name", "dep_nacimiento");
                select_estado_nacimiento.setAttribute("class", "form-control show-tick");
                
                // Evento para estado
                select_estado_nacimiento.addEventListener('change', get_ciudad_nacimiento)               

                var url = '/get_estados';
                var data = {id: select_pais_nacimiento.value};
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
                    select_estado_nacimiento.innerHTML = "<option value=''>Seleccionar</option>"
                    for (let i in response.estados) {
                        select_estado_nacimiento.innerHTML += `<option value='${ response.estados[i].id }'>${ response.estados[i].name }</option>`
                    }
                    elem_estado_nacimiento.appendChild(select_estado_nacimiento);
                    document.getElementById('loader-elem_estado_nacimiento').style.display = 'none'
                    document.getElementById('elem_estado_nacimiento').style.display = 'block'                 
                });
            }
            
            /* Nacimineto */
            function get_ciudad_nacimiento (){
                document.getElementById('loader-elem_ciudad_nacimiento').style.display = 'block'
                document.getElementById('elem_ciudad_nacimiento').style.display = 'none'

                elem_ciudad_nacimiento.innerHTML = "";
                let select_ciudad_nacimiento = document.createElement("select");
                select_ciudad_nacimiento.setAttribute("id", "select_ciudad");
                select_ciudad_nacimiento.setAttribute("name", "ciu_nacimiento");
                select_ciudad_nacimiento.setAttribute("class", "form-control show-tick");

                var url = '/get_ciudades';
                var data = {id: select_estado_nacimiento.value};
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
                    select_ciudad_nacimiento.innerHTML = "<option value=''>Seleccionar</option>"
                    for (let i in response.ciudades) {
                        select_ciudad_nacimiento.innerHTML += `<option value='${ response.ciudades[i].id }'>${ response.ciudades[i].name }</option>`
                    }
                    elem_ciudad_nacimiento.appendChild(select_ciudad_nacimiento);
                    document.getElementById('loader-elem_ciudad_nacimiento').style.display = 'none'
                    document.getElementById('elem_ciudad_nacimiento').style.display = 'block'
                });
            }

             /* Documento */
             function get_estado_documento (){
                document.getElementById('loader-elem_estado_documento').style.display = 'block'
                document.getElementById('elem_estado_documento').style.display = 'none'
                
                elem_estado_documento.innerHTML = "";
                let select_estado_documento = document.createElement("select");
                select_estado_documento.setAttribute("id", "select_estado_documento");
                select_estado_documento.setAttribute("name", "dep_documento");
                select_estado_documento.setAttribute("class", "form-control show-tick");
                
                // Evento para estado
                select_estado_documento.addEventListener('change', get_ciudad_documento)               

                var url = '/get_estados';
                var data = {id: select_pais_documento.value};
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
                    select_estado_documento.innerHTML = "<option value=''>Seleccionar</option>"
                    for (let i in response.estados) {
                        select_estado_documento.innerHTML += `<option value='${ response.estados[i].id }'>${ response.estados[i].name }</option>`
                    }
                    elem_estado_documento.appendChild(select_estado_documento);
                    document.getElementById('loader-elem_estado_documento').style.display = 'none'
                    document.getElementById('elem_estado_documento').style.display = 'block'                 
                });
            }
            
            /* Documento */
            function get_ciudad_documento (){
                document.getElementById('loader-elem_ciudad_documento').style.display = 'block'
                document.getElementById('elem_ciudad_documento').style.display = 'none'

                elem_ciudad_documento.innerHTML = "";
                let select_ciudad_documento = document.createElement("select");
                select_ciudad_documento.setAttribute("id", "select_ciudad");
                select_ciudad_documento.setAttribute("name", "ciu_documento");
                select_ciudad_documento.setAttribute("class", "form-control show-tick");

                var url = '/get_ciudades';
                var data = {id: select_estado_documento.value};
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
                    select_ciudad_documento.innerHTML = "<option value=''>Seleccionar</option>"
                    for (let i in response.ciudades) {
                        select_ciudad_documento.innerHTML += `<option value='${ response.ciudades[i].id }'>${ response.ciudades[i].name }</option>`
                    }
                    elem_ciudad_documento.appendChild(select_ciudad_documento);
                    document.getElementById('loader-elem_ciudad_documento').style.display = 'none'
                    document.getElementById('elem_ciudad_documento').style.display = 'block'
                });
            }
        </script>
        @include('cpanel_trabajador/recursos_cpanel/footer_js')
    </body>
    </html>