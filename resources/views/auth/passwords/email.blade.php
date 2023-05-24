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
        <div class="fancy-breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/hero-1.jpg);">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <div class="breadcumb-content text-center">
                            <h2>Recupera tu contraseaña</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ***** Hero Area End ***** -->
        <div class="fancy-contact-area section-padding-100">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="contact-details-area">
                            <div class="section-heading">
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="contact-form-area">
                            <div class="section-heading mb-2">
                                <div class="col-12">
                                    <h2>{{ __('Reestablecer contraseña') }}</h2>
                                </div>
                            </div>
                            <div class="contact-form">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                 @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <p>
                                            <h6 style="color:#721c24;">!Opps ha ocurrido un error</h6>
                                        </p>
                                    </div>
                                @endif            
                                <form method="POST" action="{{ route('password.email') }}">
                                @csrf 
                                <div class="col-12">
                                    <div class="form-group">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('Tu correo') }}">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn fancy-btn fancy-active">
                                            {{ __('Reestablecer') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts/recursos/footer')

        <script src="{{ asset('js/jquery/jquery-2.2.4.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/others/plugins.js') }}"></script>
        <script src="{{ asset('js/active.js') }}"></script>
    </body>
</html>