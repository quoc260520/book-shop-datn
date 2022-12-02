@extends('backend.account.index')
@section('list-account')
    <div class="card m-3">
        <form action="" method="get">
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start">
                <div class="label col-sm-3 col-6">Họ tên</div>
                <input class="form-control col-sm-3 col-6" name="name" placeholder="Họ tên" type="text"
                    value="{{ old('name') ?? ($name ?? '') }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Email</div>
                <input class="form-control col-sm-3 col-6" name="email" placeholder="Email" type="text"
                    value="{{ old('email') ?? ($email ?? '') }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Số điện thoại</div>
                <input class="form-control col-sm-3 col-6" name="phone" placeholder="Số điện thoại" type="text"
                    value="{{ old('phone') ?? ($phone ?? '') }}">
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
        <form action="{{ route('admin.account.post.delete') }}" id="form-delete-account" method="post">
            @csrf
            <div class="d-flex flex-row m-3 align-items-center justify-content-end">
                <button class="btn btn-danger btn-xl mr-3" id="delete-account" type="button">
                    <i class="fa-solid fa-trash"></i>
                    Xóa
                </button>
                <a class="btn btn-success btn-xl mr-2" href="{{ route('admin.account.create') }}" type="button">
                    <i class="fa-solid fa-plus"></i>
                    Thêm
                </a>
            </div>
            <div class="table-responsive">
                <table class="table caption-top">
                    <thead>
                        <tr>
                            <th class="w-5 no-wrap-keep" scope="col"></th>
                            <th class="w-20 no-wrap-keep" scope="col">Họ tên</th>
                            <th class="w-15 no-wrap-keep" scope="col">Email</th>
                            <th class="w-10 no-wrap-keep" scope="col">Số điện thoại</th>
                            <th class="w-15 no-wrap-keep" scope="col">Địa chỉ</th>
                            <th class="w-20 no-wrap-keep" scope="col">Ngày sinh</th>
                            <th class="w-5 no-wrap-keep" scope="col">Trạng thái</th>
                            <th class="w-5 no-wrap-keep" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($accounts))
                            @foreach ($accounts ?? [] as $account)
                                <tr>
                                    <th scope="row">
                                        @if ($account->id != auth()->user()->id)
                                            <input id="" name="delete_account[]" type="checkbox"
                                                value="{{ $account->id }}">
                                        @endif
                                    </th>
                                    <td>{{ $account->first_name . ' ' . $account->last_name }}</td>
                                    <td>{{ $account->email }}</td>
                                    <td>{{ $account->phone }}</td>
                                    <td>{{ $account->address }}</td>
                                    <td>{{ $account->date_of_birth }}</td>
                                    <td>{{ $account->active ? 'Hoạt động' : 'Bị khóa' }}</td>
                                    <td>
                                        <div class="d-flex flex-row justify-content-start">
                                            <button class="btn border-0" id="update-author" type="button">
                                                <a
                                                    href="{{ route('admin.account.update', [$account->id]) }}"class="text-black">
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
                {{ $accounts->withQueryString()->links() }}
            </div>
        </form>
    </div>

@endsection
