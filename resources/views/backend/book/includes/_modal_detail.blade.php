<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Chi tiết sách</h5>
            <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table caption-top">
                    <tbody>
                        <tr>
                            <td>Tên sách</td>
                            <td>{{ $book->book_name ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Tác giả</td>
                            <td>{{ $book->author->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Nhà xuất bản</td>
                            <td>{{ $book->publisher->publisher_name ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Năm xuất bản</td>
                            <td>{{ $book->year_publish ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Thể loại</td>
                            <td>{{ $book->category->category_name ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Số lượng</td>
                            <td>{{ $book->amount ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Giá bán</td>
                            <td>{{ $book->author->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Trạng thái</td>
                            <td>{{ ( $book->status ?? false ) ? 'Còn hàng' : 'Hết hàng' }}</td>
                        </tr>
                        <tr>
                            <td>Giảm giá</td>
                            <td>{{ $book->percent ?? 'Không' }}</td>
                        </tr>
                        <tr>
                            <td>Hình ảnh</td>
                            <td>{{ count($book->image ?? []) }}</td>
                        </tr>
                        <tr>
                            <td>Mô tả</td>
                            <td>{!! $book->describe ?? '...' !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
        </div>
    </div>
</div>
