<!DOCTYPE html>
<html lang="en"> 
    @include('cpanel_trabajador/recursos_cpanel/head')
<body class="theme-red">
    @include('cpanel_trabajador/recursos_cpanel/nav')
    <section>
        @include('cpanel_trabajador/recursos_cpanel/menu_vertical')
    </section> 
    <style>
        .responsive-image {
            width: 100%;
            height: auto;
        }
    </style>

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

            <!-- Basic Example | Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>INDUCCIÓN CORPORATIVA</h2>
                            <small>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Pellentesque et augue sed est dictum volutpat. Sed sit amet volutpat nulla,
                                in vulputate neque. Vestibulum ante ipsum primis in faucibus orci luctus et
                                ultrices posuere cubilia curae; Pellentesque finibus, dui at varius
                                pellentesque, mi nisl dapibus ante, eget venenatis tellus justo ut nisl.</small>
                        </div>
                        <div class="body">
                            <div id="wizard_vertical">
                                <h2>Paso 1</h2>
                                <section>
                                    <img src="{{ asset('img/induccion/1.jpg') }}" class="responsive-image" height="590" alt="">
                                </section>
                                
                                <h2>Paso 2</h2>
                                <section> 
                                    <img src="{{ asset('img/induccion/2.jpg') }}" class="responsive-image" height="590" alt="">
                                </section>

                                <h2>Paso 3</h2>
                                <section>
                                    <img src="{{ asset('img/induccion/3.jpg') }}" class="responsive-image" height="590" alt="">
                                </section>
 
                                <h2>Paso 4</h2>
                                <section>
                                    <img src="{{ asset('img/induccion/4.jpg') }}" class="responsive-image" height="590" alt="">
                                </section>

                                <h2>Paso 5</h2>
                                <section>
                                    <form action="">
                                        <div class="demo-checkbox">
                                            <input type="checkbox" id="md_checkbox_30" required>
                                            <label for="md_checkbox_30">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam molestie ut sem eget laoreet. Phasellus porttitor lorem rutrum pharetra interdum. Proin ullamcorper tellus a velit volutpat ultrices. Nulla facilisi. Aliquam tempor lobortis laoreet. Vestibulum lorem felis, auctor a erat nec, malesuada iaculis dui. Nulla mi urna, dictum vel tristique ut, placerat at magna. Vestibulum mollis sed quam eget dictum.</label>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <button style="display: block;margin-left: auto;margin-right: auto;width: 40%;"
                                            type="submit" class="btn btn bg-deep-orange waves-effect">Enviar mi respuesta</button>                                                             
                                        </div>
                                    </form>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Example | Vertical Layout --> 
    </section>
    @include('cpanel_trabajador/recursos_cpanel/footer_2js')  
</body>
</html>