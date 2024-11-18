
@extends('layouts.admin')
@section('title', __('Thêm cấp độ mới!'))

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.note_levels.create') }}
@endsection

@section('content')

<form class="card" action="{{ route('admin.note_levels.store') }}" method="POST">
  @csrf

  <div class="card-body">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="name" class="form-label">Tên</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" @required(true)/>
        </div>
        <div class="col-md-6 mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select class="form-select" name="status">
                <option value="-1" @selected(true)>[--Chọn--]</option>
                <option value="0" @selected(true)>Riêng tư - Private</option>
                <option value="1" @selected(true)>Công khai - Public</option>
            </select>                        
        </div>
        <div class="col-md-6 mb-3">
            <label for="cpm" class="form-label">Phí trả</label>
            <input type="text" name="click_value" id="cpm" class="form-control" value="{{ old('click_value') }}"/>
        </div>
        <div class="col-md-6 mb-3">
            <label for="limit" class="form-label">Giới hạn</label>
            <input type="number" name="click_limit" id="limit" class="form-control" value="{{ old('click_value') }}"/>
        </div>
        <div class="col-md-6 mb-3">
            <label for="limit" class="form-label">Test link</label>
            <input type="url" name="test_link" id="test_link" class="form-control" value="{{ old('click_value') }}"/>
        </div>
    
      <div class="col-12 col-md-12 mb-3">
          <label for="description" class="form-label">Mô tả</label>
          <textarea class="form-control" placeholder="Nhập mô tả..." name="description" id="description" style="min-height: 300px">{{ old('click_value') }}</textarea>
      </div>
    </div>
    <div class="mb-3 text-start">
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </div>
  </div>

</form>
@endsection