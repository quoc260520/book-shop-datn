@extends('backend.voucher.index')
@section('list-voucher')
    <div class="card m-3">
        <form action="" method="get">
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start">
                <div class="label col-sm-3 col-6">Thời gian bắt đầu</div>
                <input class="form-control col-sm-3 col-6" name="start_time" type="date"
                    value="{{ old('start_time') ?? ($startTime ?? '') }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Thời gian kết thúc</div>
                <input class="form-control col-sm-3 col-6" name="end_time" type="date"
                    value="{{ old('end_time') ?? ($endTime ?? '') }}">
            </div>
            <div class="d-flex flex-row align-items-center justify-content-end mt-3">
                <button class="btn btn-primary btn-xl" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    Tìm kiếm
                </button>
            </div>
        </form>
    </div>

    <div class="card m-3">
        <form action="{{ route('admin.voucher.delete') }}" id="form-delete-voucher" method="post">
            @csrf
            <div class="d-flex flex-row m-3 align-items-center justify-content-end">
                <button class="btn btn-danger btn-xl mr-3" id="delete-voucher" type="button">
                    <i class="fa-solid fa-trash"></i>
                    Xóa
                </button>
                <a class="btn btn-success btn-xl mr-2" href="{{ route('admin.voucher.create') }}" type="button">
                    <i class="fa-solid fa-plus"></i>
                    Thêm
                </a>
            </div>
            <div class="table-responsive">
                <table class="table caption-top">
                    <thead>
                        <tr>
                            <th class="w-5 no-wrap-keep" scope="col"></th>
                            <th class="w-20 no-wrap-keep" scope="col">Mã</th>
                            <th class="w-15 no-wrap-keep" scope="col">Số lượng</th>
                            <th class="w-10 no-wrap-keep" scope="col">Phần trăm giảm</th>
                            <th class="w-15 no-wrap-keep" scope="col">Thời gian bắt đầu</th>
                            <th class="w-20 no-wrap-keep" scope="col">Thời gian kết thúc</th>
                            <th class="w-5 no-wrap-keep" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($vouchers))
                            @foreach ($vouchers ?? [] as $voucher)
                                <tr>
                                    <th scope="row">
                                        @if ($voucher->id != auth()->user()->id)
                                            <input id="" name="delete_voucher[]" type="checkbox"
                                                value="{{ $voucher->id }}">
                                        @endif
                                    </th>
                                    <td>{{ $voucher->code }}</td>
                                    <td>{{ $voucher->amount }}</td>
                                    <td>{{ $voucher->percent }}</td>
                                    <td>{{ $voucher->start_date }}</td>
                                    <td>{{ $voucher->end_date }}</td>
                                    <td>
                                        <div class="d-flex flex-row justify-content-start">
                                            <button class="btn border-0" id="update-author" type="button">
                                                <a
                                                    href="{{ route('admin.voucher.update', [$voucher->id]) }}"class="text-black">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                            </button>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="7">Danh sách trống</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $vouchers->withQueryString()->links() }}
            </div>
        </form>
    </div>

@endsection
