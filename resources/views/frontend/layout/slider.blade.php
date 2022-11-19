<div class="carousel slide" data-bs-ride="carousel" id="carouselExampleIndicators">
    <div class="carousel-indicators">
        @foreach ($sliders ?? [] as $index => $slider)
            <button aria-current="true" aria-label="Slide 1" class="{{ $index === 0 ? 'active' : ''}}" data-bs-slide-to="{{ $index }}"
                data-bs-target="#carouselExampleIndicators" type="button"></button>
        @endforeach
    </div>
    <div class="carousel-inner">
        @foreach ($sliders ?? [] as $index => $slider)
            <a class="carousel-item {{ $index === 0 ? 'active' : '' }}" data-bs-interval="10000" href="{{ $slider->link }}">
                <img alt="..." class="d-block w-100" src="{{ get_image_book($slider->image) }}"
                    style="height:560px;">
            </a>
        @endforeach
    </div>
    <button class="carousel-control-prev" data-bs-slide="prev" data-bs-target="#carouselExampleIndicators"
        type="button">
        <span aria-hidden="true" class="carousel-control-prev-icon"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" data-bs-slide="next" data-bs-target="#carouselExampleIndicators"
        type="button">
        <span aria-hidden="true" class="carousel-control-next-icon"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
