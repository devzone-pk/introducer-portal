<div>


    @if($promotions->isNotEmpty())
        <div class="section full">

            <div class="carousel-single splide " >
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach($promotions as $p)
                            <li class="splide__slide">
                                <div class="card">
                                    <img src="{{ env('AWS_URL') }}{{ $p->attachment }}" class="card-img-top" style="border-radius: 10px;"
                                         alt="image">
                                </div>
                            </li>
                        @endforeach


                    </ul>
                </div>
            </div>
        </div>
    @endif






</div>
