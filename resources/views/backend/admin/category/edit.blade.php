@extends('layouts.admin')
@section('title', __('Danh mục: '. $category->name))

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.categories.edit', $category) }}
@endsection

@section('content')
<form class="card" action="{{ route('admin.categories.update',  $category->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="card-body">
      <div class="mb-3">
        <label class="form-label required" for="name">Tên</label>
        <input class="form-control" name="name" value="{{ old('name') ?: $category->name }}" id="name" placeholder="Nhập tên danh mục..." required>
      </div>
      <div class="mb-3">
        <label class="form-label required" for="slug">Slug</label>
        <input class="form-control" name="slug" value="{{ old('slug') ?: $category->slug }}" id="slug" placeholder="Nhập slug danh mục..." required>
      </div>
      <div class="mb-3">
        <label class="form-label" for="description">Mô tả</label>
        <textarea class="form-control" name="description" value="{{ old('description') ?: $category->description }}" id="description" rows="5" placeholder="Nhập mô tả danh mục..."></textarea>
      </div>
    </div>
    <div class="card-footer text-end">
      <input value="Cập nhật" type="submit" class="btn btn-primary">
    </div>
</form>
@endsection