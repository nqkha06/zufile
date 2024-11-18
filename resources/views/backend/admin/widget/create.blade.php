
@extends('layouts.admin')
@section('title', __('Thêm mới Widget'))

@section('content')
    <div class="row">
        <form class="col-12" action="{{ route('admin.widgets.store') }}" method="POST">

            <div class="card rounded-3">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-12 mb-3">
                            <label class="form-label required" for="name">Tên</label>
                            <input class="form-control" name="name" value="{{ old('name') }}" id="name"
                                placeholder="" required>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label" for="description">Mô tả</label>
                            <input class="form-control" name="description" value="{{ old('description') }}" id="description"
                                placeholder="">
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label required" for="canonical">Canonical</label>
                            <input class="form-control" name="canonical" value="{{ old('canonical') }}" id="canonical"
                                placeholder="">
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-12 col-md-12">
                            <label class="form-label required" for="content">Nội dung</label>
                            <textarea style="min-height: 300px" class="form-control" name="content" value="{{ old('content') }}" id="status"
                                placeholder="" required></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="mt-3">
              <input value="Thêm" type="submit" class="btn btn-primary">
            </div>
        </form>
    </div>
@endsection

