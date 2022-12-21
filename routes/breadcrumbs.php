<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

//Book

Breadcrumbs::for('admin.book.list', function ($trail) {
    $trail->push('Quản lý sách', route('admin.book.list'));
});

Breadcrumbs::for('admin.book.create', function ($trail) {
    $trail->parent('admin.book.list');
    $trail->push('Thêm sách', route('admin.book.create'));
});

Breadcrumbs::for('admin.book.get.update', function ($trail,$book) {
    $trail->parent('admin.book.list');
    $trail->push('Cập nhật sách', route('admin.book.get.update',[$book]));
});

//Slider

Breadcrumbs::for('admin.slider.list', function ($trail) {
    $trail->push('Quản lý slider', route('admin.slider.list'));
});

// Category
Breadcrumbs::for('admin.category.list', function ($trail) {
    $trail->push('Quản lý danh mục', route('admin.category.list'));
});

//Author

Breadcrumbs::for('admin.author.list', function ($trail) {
    $trail->push('Quản lý tác giả', route('admin.author.list'));
});
Breadcrumbs::for('admin.author.create', function ($trail) {
    $trail->parent('admin.author.list');
    $trail->push('Thêm tác giả', route('admin.author.create'));
});

Breadcrumbs::for('admin.author.get.update', function ($trail,$author) {
    $trail->parent('admin.author.list');
    $trail->push('Cập nhật tác giả', route('admin.author.get.update',$author));
});

//Publisher
Breadcrumbs::for('admin.publisher.list', function ($trail) {
    $trail->push('Quản lý nhà xuất bản', route('admin.publisher.list'));
});
Breadcrumbs::for('admin.publisher.create', function ($trail) {
    $trail->parent('admin.publisher.list');
    $trail->push('Thêm nhà xuất bản', route('admin.publisher.create'));
});

Breadcrumbs::for('admin.publisher.update', function ($trail,$publisher) {
    $trail->parent('admin.publisher.list');
    $trail->push('Cập nhật nhà xuất bản', route('admin.publisher.update',$publisher));
});

// Account
Breadcrumbs::for('admin.account.list', function ($trail) {
    $trail->push('Quản lý tài khoản', route('admin.account.list'));
});
Breadcrumbs::for('admin.account.create', function ($trail) {
    $trail->parent('admin.account.list');
    $trail->push('Thêm tài khoản', route('admin.account.create'));
});
Breadcrumbs::for('admin.account.update', function ($trail,$account) {
    $trail->parent('admin.account.list');
    $trail->push('Cập nhật tài khoản', route('admin.account.update',$account));
});

// Voucher
Breadcrumbs::for('admin.voucher.list', function ($trail) {
    $trail->push('Quản lý mã giảm giá', route('admin.voucher.list'));
});
Breadcrumbs::for('admin.voucher.create', function ($trail) {
    $trail->parent('admin.voucher.list');
    $trail->push('Thêm mã giảm giá', route('admin.voucher.create'));
});
Breadcrumbs::for('admin.voucher.update', function ($trail,$voucher) {
    $trail->parent('admin.voucher.list');
    $trail->push('Cập nhật mã giảm giá', route('admin.voucher.update',$voucher));
});

//Order

Breadcrumbs::for('admin.order.list', function ($trail) {
    $trail->push('Quản lý đơn hàng', route('admin.order.list'));
});



// Frontend
Breadcrumbs::for('index', function ($trail) {
    $trail->push('Trang chủ', route('index'));
});

Breadcrumbs::for('book.detail', function ($trail,$book) {
    $trail->parent('index');
    $trail->push('Chi tiết sách', route('book.detail',$book));
});

Breadcrumbs::for('search', function ($trail) {
    $trail->parent('index');
    $trail->push('Tìm kiếm sách', route('search'));
});

?>