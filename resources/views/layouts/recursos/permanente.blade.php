<!-- Work with us -->
@if ($ofertas)
    <section class="fancy-about-us-area bg-gray" style="padding-top: 50px; padding-bottom: 50px;">
        <div class="container">
            <div class="row">
                @foreach ($ofertas as $elem)
                @if ($elem->tipo_oferta == 2)
                    <div class="col-12 col-lg-6">
                        <div class="about-us-text">
                            <h2>{{ $elem->nombre }}</h2>
                            <p>
                                @php
                                echo substr(strip_tags($elem->descripcion), 0, 280); 
                                @endphp
                            </p>
                            <a href="{{ route('oferta', $elem->id)}}" class="btn fancy-btn fancy-dark">Ver oferta</a>
                        </div>
                    </div>                
                    <div class="col-12 col-lg-6 col-xl-5 ml-xl-auto">
                        <div class="about-us-thumb wow fadeInUp" data-wow-delay="0.5s">
                            <img src="/files/{{ $elem->archivo }}" alt="">
                        </div>
                    </div>                    
                @endif
                @endforeach 
            </div>
        </div>
    </section>
@endif

