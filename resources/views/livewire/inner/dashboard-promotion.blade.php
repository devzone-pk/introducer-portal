<div class="bg-white   shadow-sm rounded py-4 px-4 mb-4">
    <h3 class="text-5  d-flex align-items-center   mb-3  ">
        What's New!
    </h3>

    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($promotions as $p)

                <div class="carousel-item {{ $loop->first ? 'active' :'' }}">
                    <img src="{{ env('AWS_URL') }}{{ $p->attachment }}" class="d-block w-100 rounded-2" alt="...">
                </div>

            @endforeach

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

</div>
