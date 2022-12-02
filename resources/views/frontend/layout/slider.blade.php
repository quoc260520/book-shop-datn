<div class="slide">
    @foreach ($sliders ?? [] as $index => $slider)
        <div class="">
            <a class="{{ $index === 0 ? 'active' : '' }}" href="{{ $slider->link }}">
                <img alt="..." class="d-block w-100" src="{{ get_image_book($slider->image) }}" style="height:560px;">
            </a>
        </div>
    @endforeach
</div>

<style>
    .slick-prev:before,
    .slick-next:before {
        color: #c0b9b9;
    }
    .slick-prev {
        left: 5%;
        z-index: 2;
    }
    .slick-next {
        right: 5%;
    }
    .slick-dots {
        bottom: 5%;
    }
</style>
