@extends('backend.voucher.index')
@section('update-voucher')
    <form action="{{ route('admin.voucher.post.update') }}" method="post">
        @csrf
        <input name="id" type="hidden" value="{{ $voucher->id }}">
        <div class="card m-3">
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start">
                <div class="label col-sm-3 col-6">Mã <span class="badge badge-danger">*</span></div>
                <input class="form-control col-sm-3 col-6" name="code" placeholder="ABCXYZ" type="text"
                    value="{{ old('code') ?? $voucher->code }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Số lượng</div>
                <input class="form-control col-sm-3 col-6" name="amount" placeholder="Số lượng" type="number"
                    value="{{ old('amount') ?? $voucher->amount }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Phần trăm giảm <span class="badge badge-danger">*</span></div>
                <input class="form-control col-sm-3 col-6" max="100" min="0" name="percent" placeholder="15%"
                    type="number" value="{{ old('percent') ?? $voucher->percent }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Thời gian bắt đầu <span class="badge badge-danger">*</span></div>
                <input class="form-control col-sm-3 col-6 time-start" name="time_start" type="text"
                    value="{{ old('time_start') ?? $voucher->start_date }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Thời gian kết thúc </div>
                <input class="form-control col-sm-3 col-6 time-end" name="time_end" type="text"
                    value="{{ old('time_end') ?? $voucher->end_date }}">
            </div>

            <div class="d-flex flex-row align-items-center justify-content-end mt-3 col-9">
                <button class="btn btn-warning btn-xl" type="submit">
                    <i class="fa-solid fa-pen-to-square"></i>
                    Cập nhật
                </button>
            </div>
        </div>
    </form>
@endsection
@push('after-scripts')
    <script>
        let startDate = {!! json_encode($voucher->start_date) !!};
        let endDate = {!! json_encode($voucher->end_date) !!};
        console.log(startDate, endDate);

        $(".time-start").daterangepicker({
            timePicker: true,
            minDate: moment(),
            startDate: startDate,
            locale: {
                format: "Y-M-D hh:mm:ss",
            },
            singleDatePicker: true,
        });

        $(".time-end").daterangepicker({
            timePicker: true,
            minDate: moment(),
            startDate: endTime,
            locale: {
                format: "Y-M-D hh:mm:ss",
            },
            singleDatePicker: true,
        });
    </script>
@endpush
