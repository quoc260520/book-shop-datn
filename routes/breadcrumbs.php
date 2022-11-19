<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

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

Breadcrumbs::for('admin.slider.list', function ($trail) {
    $trail->push('Quản lý slider', route('admin.slider.list'));
});
Breadcrumbs::for('admin.category.list', function ($trail) {
    $trail->push('Quản lý danh mục', route('admin.category.list'));
});

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
?>