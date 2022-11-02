<?php
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

?>