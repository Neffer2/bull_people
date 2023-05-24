<!-- ***** Header Area Start ***** -->
<div id="header-sticky-wrapper" class="sticky-wrapper is-sticky" style="height: 70px;">
    <header class="header_area" id="header" style="position: fixed; top: 0px;">
        <div class="container-fluid h-100">
            <div class="row h-100">
                <div class="col-12 h-100">
                    <nav class="h-100 navbar navbar-expand-lg align-items-center">
                       <a href="/"><h3>Bull Marketing</h3></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#fancyNav" aria-controls="fancyNav" aria-expanded="false" aria-label="Toggle navigation"><span class="ti-menu"></span></button>
                        <div class="collapse navbar-collapse" id="fancyNav">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item active">
                                    @auth
                                        <a class="nav-link" href="/dashboard">Panel</a>
                                    @endauth
                                </li>
                                @auth
                                    <li class="nav-item">
                                        <a class="btn fancy-btn fancy-active" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">Salir</a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>

                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="btnEntrar mr-3" href="{{ route('register') }}">Regístrate</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="btnEntrar" href="{{ route('login') }}">Entra</a>
                                    </li>
                                @endauth

                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header> 
</div>