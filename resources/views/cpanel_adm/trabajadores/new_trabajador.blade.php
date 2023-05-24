<!DOCTYPE html>
<html lang="en"> 
    @include('cpanel_adm/recursos_cpanel/head')
<body class="theme-red">
    <style>
        .card_profile{
            width: auto;
            height: 300px;
            /* margin-bottom: 15px;
            border-radius: 2px; */
        }
        .avatar{
            position: relative;
        }

        .avatar input[type="file"]{
            display: none;
        }
        .avatar-selector{
            background-color: #FF5722;
            color: white;
            border-radius: 100%;
            padding: .5em;
            cursor: pointer;
            position: absolute;
            right: .2em;
            bottom: 0.5em;
        }

        .profile{
            text-align: center;
            margin-top: 1em;
            padding-top: 1em;
        }

        .profile .img{
            border-radius: 50%;
            height: 200px;
            /* width: 200px; */
            background-image: url("{{ asset('/img/profiles/default_avatar.png') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0 auto;
        }
    </style>
    @include('cpanel_adm/recursos_cpanel/nav')
    <section>
        @if (auth()->user()->tipo_user == 1)
            @include('cpanel_adm/recursos_cpanel/menu_vertical')
        @elseif(auth()->user()->tipo_user == 3)
            @include('cpanel_trabajador/recursos_cpanel/menu_vertical')
        @else
            @include('cpanel_postulante/recursos_cpanel/menu_vertical')
        @endif
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
                            <h2>  
                                <b> 
                                    GENERACIÓN DE NUEVOS TRABAJDORES
                                </b>
                                <small>Aqu&iacute; podr&aacute;s generar cuentas para trabajadores. Recuerda que las credenciales se env&iacute;an al correo del trabajador.</small>
                                <small> <b>NOTA:</b> Por precauci&oacute;n recuerda copiar la contraseña del trabajador (en caso de que el correo rebote).</small>
                            </h2>
                        </div>  
                        <div class="body">
                            <form action="{{ route('store_trabajador') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="card_profile profile" style="padding-left: 30%; padding-right: 30%;">
                                                <h4>AVATAR</h4>
                                                <div class="avatar">
                                                    <input type="file" id="file-uploader" name="avatar" accept="image/*" value="">
                                                    <div class="img"></div>
                                                    <label for="file-uploader" class="avatar-selector">
                                                        <i class="material-icons">add_a_photo</i>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-sm-6">
                                        <div class="col-sm-12">
                                            <div class="form-group"> 
                                                <label for="nombre">Nombre (*)</label>
                                                <div class="form-line">
                                                    <input name="name" id="nombre" type="text" class="form-control" value="" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="email">Email (*)</label>
                                                <div class="form-line">
                                                    <input name="email" id="email" type="email" class="form-control" value="" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group"> 
                                                <label for="documento">Documento (*)</label>
                                                <div class="form-line"> 
                                                    <input name="documento" id="documento" type="number" class="form-control" value="" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="col-sm-6">
                                            <div class="form-group"> 
                                                <label for="documento">Contrato (Opcional)</label>
                                                <div class="form-line"> 
                                                    <input name="contrato" id="documento" type="file" class="form-control" value=""/>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-sm-6">
                                            <div class="form-group"> 
                                                <label for="documento">Hoja de vida (Opcional)</label>
                                                <div class="form-line"> 
                                                    <input name="hoja_vida" id="documento" type="file" class="form-control" value=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div> 
                        <div class="card">
                            <div class="header">
                                <h2>
                                    <b>
                                        CONTRASEÑA.
                                    </b>
                                </h2>
                            </div>
                            <div class="body"> 
                                    <div class="row clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-line">
                                                <label>Contraseña</label>
                                                <div class="form-line">
                                                    <input id="password" name="password" type="password" class="form-control" value="" required/>
                                                    <button type="button" class="btn bg-cyan waves-effect" onclick="generar()">Generar</button>
                                                    <button type="button" class="btn bg-cyan waves-effect" onclick="copyPassword()">Copiar</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-line">
                                                <label>Contraseña</label>
                                                <input id="password_visor" readonly="readonly" type="text" class="form-control" value="" required/>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-12" style="padding-left: 20%; padding-right: 20%;">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-block btn-lg bg-deep-orange waves-effect">Generar trabajador</button>
                                                </div>
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
    <script>
        let password = document.getElementById("password");

        document.getElementById('password').addEventListener('keypress', function() {
            document.getElementById('password_visor').value = this.value;
        });
        
        function generar() {
            var chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            var passwordLength = 12;
            var password = "";
            for (var i = 0; i <= passwordLength; i++) {
                var randomNumber = Math.floor(Math.random() * chars.length);
                password += chars.substring(randomNumber, randomNumber +1);
            }
            document.getElementById("password").value = password;
            document.getElementById("password_visor").value = password;
        }

        function copyPassword() {
            var copyText = document.getElementById("password_visor");
            copyText.select();
            document.execCommand("copy");
            alert("Contraseñea copiada: " + copyText.value);
        }

        (function(){
            document.querySelector('#file-uploader')
                .addEventListener('change', function(ev){
                let files = ev.target.files;
                let image = files[0];
                let imageUrl = URL.createObjectURL(image);
                console.log(imageUrl);
                document.querySelector(".profile .img")
                .style.backgroundImage = "url('"+imageUrl+"')";
                
            })
        })()
    </script>
</body> 
</html>