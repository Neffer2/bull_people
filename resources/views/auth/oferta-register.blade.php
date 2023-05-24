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
    <style>
        .card{
            width: auto;
            height: 300px; 
            margin-bottom: 15px;
            border-radius: 2px;
        }
        .avatar{
            position: relative;
        }

        .avatar input[type="file"]{
            display: none;
        }
        .avatar-selector{
            background-color: #009688;
            color: white;
            border-radius: 100%;
            padding: .5em;
            cursor: pointer;
            position: absolute;
            right: 4em;
            bottom: 0.5em;
        }
        .profile{
            text-align: center;
            margin-top: 1em;
            padding-top: 1em;
        }
        .profile .img{
            border-radius: 50%;
            width: 200px;
            height: 200px;
            background-image: url('/img/profiles/default_avatar.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0 auto;
        }
    </style>
</head> 
    <body>
        <!-- Preloader Start -->
        <div id="preloader">
            <div class="loader">
                <span class="inner1"></span>
                <span class="inner2"></span>
                <span class="inner3"></span>
            </div>
        </div>
        @include('layouts/recursos/menu')

        <!-- ***** Hero Area Start ***** -->
        <div class="fancy-breadcumb-area bg-img bg-overlay" style="background-image: url(../img/bg-img/hero-1.jpg);">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <div class="breadcumb-content text-center">
                            <h2>Regístrate Aquí</h2>
                            <p>Registrate y postula tu hoja de vida en nuestras ofertas disponibles.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ***** Hero Area End ***** -->
        <div class="fancy-contact-area section-padding-100">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-4 col-xs-12">
                        <div class="contact-details-area">
                            <div class="section-heading">
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="contact-form-area">
                            <div class="section-heading mb-2">
                                <div class="col-12">
                                    <h2>Regístrate</h2>                                           
                                </div>
                            </div>
                            <div class="contact-form">
                                 @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <p>
                                            <h6 style="color:#721c24;">!Opps ha ocurrido un error</h6>
                                        </p>
                                    </div>
                                @endif            
                                <form method="POST" action="/oferta-register" enctype="multipart/form-data">
                                    @csrf 
                                    <div class="col-12">
                                        <div class="form-group">
                                           <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="{{ __('Nombre completo') }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <input type="text" name="oferta_id" value="{{ $id_oferta }}" hidden>
                                    <div class="col-12"> 
                                        <div class="form-group">
                                           <input id="documento" type="text" class="form-control @error('documento') is-invalid @enderror" name="documento" value="{{ old('documento') }}" required autocomplete="documento" autofocus placeholder="{{ __('Documento de identidad') }}">
                                            @error('documento')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span> 
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('Correo') }}">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('Contraseña') }}">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirma tu contraseña') }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input type="checkbox" name="" required>
                                                <label>
                                                    Estoy de acuerdo con las
                                                    <a href="http://www.bullmarketing.com.co/wp-content/uploads/2022/07/Habeas-Data-BULL-MARKETING-SAS-2022..pdf" target="_blanck">condiciones de servicio, política de privacidad, política de uso aceptable de acuerdo al procesamiento de datos.</a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="card profile">
                                                <h4>Foto de perfil <h6>(Opcional)</h6></h4>
                                                <div class="avatar">
                                                    <input type="file" id="uploader" name="avatar" accept="image/*">
                                                    <div class="img"></div>
                                                    <label for="uploader" class="avatar-selector"> 
                                                        <i class="fa fa-camera"></i>
                                                    </label> 
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-12">            
                                        <button type="submit" class="btn fancy-btn fancy-active hoverPointer">{{ __('Registrar') }}</button>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <span class="text-muted">¿Ya tienes una cuenta? </span><a href="/login">Inicia sesión.</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts/recursos/footer')
        <script>
            (function(){
                document.querySelector('#uploader')
                    .addEventListener('change', function(ev){
                    let files = ev.target.files;
                    let image = files[0];
                    let imageUrl = URL.createObjectURL(image);
                    document.querySelector(".profile .img")
                    .style.backgroundImage = "url('"+imageUrl+"')";
                })
            })() 
        </script>
        <script src="{{ asset('js/jquery/jquery-2.2.4.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/others/plugins.js') }}"></script>
        <script src="{{ asset('js/active.js') }}"></script>
    </body>
</html>