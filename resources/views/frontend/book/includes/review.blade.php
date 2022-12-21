<div class="content-book cart bg-white rounded mt-4 mb-5 p-5">
    <div class="d-flex flex-row align-items-center header-coupon">
        <div class="ml-2 label-coupon">Đánh giá sản phẩm </div>
    </div>
    <div class="d-flex flex-row align-items-start">
        <div class="rating-wrap comment-user col-3 d-flex flex-column align-items-center">
            <div class="point-rating-wrap comment-user d-flex flex-row">
                <div class="point-rating">
                    {{ $avgRate }}
                </div>
                <div class="point">
                    /5
                </div>
            </div>
            <div class="stars">
                @for ($i = 1; $i <= 5; $i++)
                    @if (round($avgRate - 0.25) >= $i)
                        <i class='fa-solid fa-star'></i>
                    @elseif (round($avgRate + 0.25) >= $i)
                        <i class="fa-solid fa-star-half-stroke"></i>
                    @else
                        <i class="fa-regular fa-star"></i>
                    @endif
                @endfor
            </div>
            <div class="total-rating">
                ( {{ $book->reviews->count() ?? 0 }} đánh giá )
            </div>
        </div>
        <div class="list-rating col-9 flex-column align-content-between mt-2">
            <div class="d-flex flex-row flex-row align-items-center">
                <div class="fs-4 text mr-3">5 sao </div>
                <div class="progress">
                    <div aria-valuemax="100" aria-valuemin="0"
                        aria-valuenow="{{ ($arrayRate['5_sao'] / (count($book->reviews) ? count($book->reviews) : 1)) * 100 }}"
                        class="progress-bar bg-warning" role="progressbar"
                        style="width: {{ ($arrayRate['5_sao'] / (count($book->reviews) ? count($book->reviews) : 1)) * 100 }}%"></div>
                </div>
            </div>
            <div class="d-flex flex-row flex-row align-items-center">
                <div class="fs-4 text mr-3">4 sao </div>
                <div class="progress">
                    <div aria-valuemax="100" aria-valuemin="0"
                        aria-valuenow="{{ ($arrayRate['4_sao'] / (count($book->reviews) ? count($book->reviews) : 1)) * 100 }}"
                        class="progress-bar bg-warning" role="progressbar"
                        style="width: {{ ($arrayRate['4_sao'] / (count($book->reviews) ? count($book->reviews) : 1)) * 100 }}%"></div>
                </div>
            </div>
            <div class="d-flex flex-row flex-row align-items-center">
                <div class="fs-4 text mr-3">3 sao </div>
                <div class="progress">
                    <div aria-valuemax="100" aria-valuemin="0"
                        aria-valuenow="{{ ($arrayRate['3_sao'] / (count($book->reviews) ? count($book->reviews) : 1)) * 100 }}"
                        class="progress-bar bg-warning" role="progressbar"
                        style="width: {{ ($arrayRate['3_sao'] / (count($book->reviews) ? count($book->reviews) : 1)) * 100 }}%"></div>
                </div>
            </div>
            <div class="d-flex flex-row flex-row align-items-center">
                <div class="fs-4 text mr-3">2 sao </div>
                <div class="progress">
                    <div aria-valuemax="100" aria-valuemin="0"
                        aria-valuenow="{{ ($arrayRate['2_sao'] / (count($book->reviews) ? count($book->reviews) : 1)) * 100 }}"
                        class="progress-bar bg-warning" role="progressbar"
                        style="width: {{ ($arrayRate['2_sao'] / (count($book->reviews) ? count($book->reviews) : 1)) * 100 }}%"></div>
                </div>
            </div>
            <div class="d-flex flex-row flex-row align-items-center">
                <div class="fs-4 text mr-3">1 sao </div>
                <div class="progress">
                    <div aria-valuemax="100" aria-valuemin="0"
                        aria-valuenow="{{ ($arrayRate['1_sao'] / (count($book->reviews) ? count($book->reviews) : 1)) * 100 }}"
                        class="progress-bar bg-warning" role="progressbar"
                        style="width: {{ ($arrayRate['1_sao'] / (count($book->reviews) ? count($book->reviews) : 1)) * 100 }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex-row align-items-start border-top mt-5 p-4 {{ auth()->user() ? 'd-flex' : 'd-none' }}">
        <div class="rating-wrap comment-user d-flex flex-column border col-12 p-3">
            <div class="label-comment d-flex flex-row">
                <div class="fs-4 text me-3">Chất lượng sách</div>
                <div class="star">
                    <span class="star-ratting star-1" id="star-1"><i class="fa-solid fa-star"></i></span>
                    <span class="star-ratting star-2" id="star-2"><i class="fa-solid fa-star"></i></span>
                    <span class="star-ratting star-3" id="star-3"><i class="fa-solid fa-star"></i></span>
                    <span class="star-ratting star-4" id="star-4"><i class="fa-solid fa-star"></i></span>
                    <span class="star-ratting star-5" id="star-5"><i class="fa-solid fa-star"></i></span>
                </div>
            </div>
            <div class="comment mt-3 col-12">
                <textarea class="col-12 fs-4 text" id="content" maxlength="10000" minlength="20" name="content"
                    placeholder="Để lại nhận xét của bạn..." rows="8">

                </textarea>
            </div>
            <div class="mt-4 col-12 d-flex justify-content-end">
                <button class="btn btn-primary fs-4 mb-2 me-4" id="btn-comment" type="button">Gửi nhận xét</button>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column align-items-start border-top mt-5 p-4">
        @foreach ($book->reviews ?? [] as $review)
            <div class="rating-wrap comment-user d-flex flex-column col-12 p-3">
                <div class="label-comment d-flex flex-row">
                    <div class="fs-4 text me-5 col-1 d-flex justify-content-start p-0">
                        {{ $review->user->first_name || $review->user->last_name ? $review->user->first_name . ' ' . $review->user->last_name : $review->user->user_name }}
                    </div>
                    <div class="star col-11">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="{{ $review->star >= $i ? 'star-ratting-color' : '' }}"><i
                                    class="fa-solid fa-star"></i></span>
                        @endfor
                    </div>
                </div>
                <div class="comment mt-3 col-12 p-0 d-flex flex-row">
                    <div class="fs-4 text me-5 col-1 d-flex justify-content-start p-0">
                        {{ date_format(date_create($review->created_at), 'Y/m/d') }}
                    </div>
                    <div class="content-comment fs-4 text col-11 pe-2">{{ $review->content }}</div>
                </div>
            </div>
        @endforeach
    </div>

</div>
</div>
