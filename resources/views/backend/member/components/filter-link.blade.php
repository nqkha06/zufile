<style>



.flex {
    display: flex;
}
.auto {
    width: auto;
}
.gap5 {
    gap: 5px
}
.gap10 {
    gap: 10px
}
.mt5 {
    margin-top: 5px; 
}
.mt10 {
    margin-top: 10px; 
}
.center-items {
  align-items: center;
}
.bot-items {
  align-items: flex-end;
}


.btn {
  border-radius: 3px;
  line-height: 1.5
}
.float-e-margins .btn {
  margin-bottom: 5px;
}
.btn-w-m {
  min-width: 100px;
}
.btn-primary.btn-outline {
  color: #1ab394;
}
.btn-success.btn-outline {
  color: #1c84c6;
}
.btn-info.btn-outline {
  color: #23c6c8;
}
.btn-warning.btn-outline {
  color: #f8ac59;
}
.btn-danger.btn-outline {
  color: #ed5565;
}
.btn-primary.btn-outline:hover,
.btn-success.btn-outline:hover,
.btn-info.btn-outline:hover,
.btn-warning.btn-outline:hover,
.btn-danger.btn-outline:hover {
  color: #fff;
}
.btn-primary {
  background-color: #1ab394;
  border-color: #1ab394;
  color: #FFFFFF;
}
.btn-primary:hover,
.btn-primary:focus,
.btn-primary:active,
.btn-primary.active,
.open .dropdown-toggle.btn-primary,
.btn-primary:active:focus,
.btn-primary:active:hover,
.btn-primary.active:hover,
.btn-primary.active:focus {
  background-color: #18a689;
  border-color: #18a689;
  color: #FFFFFF;
}
.btn-primary:active,
.btn-primary.active,
.open .dropdown-toggle.btn-primary {
  background-image: none;
}
.btn-primary.disabled,
.btn-primary.disabled:hover,
.btn-primary.disabled:focus,
.btn-primary.disabled:active,
.btn-primary.disabled.active,
.btn-primary[disabled],
.btn-primary[disabled]:hover,
.btn-primary[disabled]:focus,
.btn-primary[disabled]:active,
.btn-primary.active[disabled],
fieldset[disabled] .btn-primary,
fieldset[disabled] .btn-primary:hover,
fieldset[disabled] .btn-primary:focus,
fieldset[disabled] .btn-primary:active,
fieldset[disabled] .btn-primary.active {
  background-color: #1dc5a3;
  border-color: #1dc5a3;
}
.btn-success {
  background-color: #1c84c6;
  border-color: #1c84c6;
  color: #FFFFFF;
}
.btn-success:hover,
.btn-success:focus,
.btn-success:active,
.btn-success.active,
.open .dropdown-toggle.btn-success,
.btn-success:active:focus,
.btn-success:active:hover,
.btn-success.active:hover,
.btn-success.active:focus {
  background-color: #1a7bb9;
  border-color: #1a7bb9;
  color: #FFFFFF;
}
.btn-success:active,
.btn-success.active,
.open .dropdown-toggle.btn-success {
  background-image: none;
}
.btn-success.disabled,
.btn-success.disabled:hover,
.btn-success.disabled:focus,
.btn-success.disabled:active,
.btn-success.disabled.active,
.btn-success[disabled],
.btn-success[disabled]:hover,
.btn-success[disabled]:focus,
.btn-success[disabled]:active,
.btn-success.active[disabled],
fieldset[disabled] .btn-success,
fieldset[disabled] .btn-success:hover,
fieldset[disabled] .btn-success:focus,
fieldset[disabled] .btn-success:active,
fieldset[disabled] .btn-success.active {
  background-color: #1f90d8;
  border-color: #1f90d8;
}
.btn-info {
  background-color: #23c6c8;
  border-color: #23c6c8;
  color: #FFFFFF;
}
.btn-info:hover,
.btn-info:focus,
.btn-info:active,
.btn-info.active,
.open .dropdown-toggle.btn-info,
.btn-info:active:focus,
.btn-info:active:hover,
.btn-info.active:hover,
.btn-info.active:focus {
  background-color: #21b9bb;
  border-color: #21b9bb;
  color: #FFFFFF;
}
.btn-info:active,
.btn-info.active,
.open .dropdown-toggle.btn-info {
  background-image: none;
}
.btn-info.disabled,
.btn-info.disabled:hover,
.btn-info.disabled:focus,
.btn-info.disabled:active,
.btn-info.disabled.active,
.btn-info[disabled],
.btn-info[disabled]:hover,
.btn-info[disabled]:focus,
.btn-info[disabled]:active,
.btn-info.active[disabled],
fieldset[disabled] .btn-info,
fieldset[disabled] .btn-info:hover,
fieldset[disabled] .btn-info:focus,
fieldset[disabled] .btn-info:active,
fieldset[disabled] .btn-info.active {
  background-color: #26d7d9;
  border-color: #26d7d9;
}
.btn-default {
  color: inherit;
  background: white;
  border: 1px solid #e7eaec;
}
.btn-default:hover,
.btn-default:focus,
.btn-default:active,
.btn-default.active,
.open .dropdown-toggle.btn-default,
.btn-default:active:focus,
.btn-default:active:hover,
.btn-default.active:hover,
.btn-default.active:focus {
  color: inherit;
  border: 1px solid #d2d2d2;
}
.btn-default:active,
.btn-default.active,
.open .dropdown-toggle.btn-default {
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15) inset;
}
.btn-default.disabled,
.btn-default.disabled:hover,
.btn-default.disabled:focus,
.btn-default.disabled:active,
.btn-default.disabled.active,
.btn-default[disabled],
.btn-default[disabled]:hover,
.btn-default[disabled]:focus,
.btn-default[disabled]:active,
.btn-default.active[disabled],
fieldset[disabled] .btn-default,
fieldset[disabled] .btn-default:hover,
fieldset[disabled] .btn-default:focus,
fieldset[disabled] .btn-default:active,
fieldset[disabled] .btn-default.active {
  color: #cacaca;
}
.btn-warning {
  background-color: #f8ac59;
  border-color: #f8ac59;
  color: #FFFFFF;
}
.btn-warning:hover,
.btn-warning:focus,
.btn-warning:active,
.btn-warning.active,
.open .dropdown-toggle.btn-warning,
.btn-warning:active:focus,
.btn-warning:active:hover,
.btn-warning.active:hover,
.btn-warning.active:focus {
  background-color: #f7a54a;
  border-color: #f7a54a;
  color: #FFFFFF;
}
.btn-warning:active,
.btn-warning.active,
.open .dropdown-toggle.btn-warning {
  background-image: none;
}
.btn-warning.disabled,
.btn-warning.disabled:hover,
.btn-warning.disabled:focus,
.btn-warning.disabled:active,
.btn-warning.disabled.active,
.btn-warning[disabled],
.btn-warning[disabled]:hover,
.btn-warning[disabled]:focus,
.btn-warning[disabled]:active,
.btn-warning.active[disabled],
fieldset[disabled] .btn-warning,
fieldset[disabled] .btn-warning:hover,
fieldset[disabled] .btn-warning:focus,
fieldset[disabled] .btn-warning:active,
fieldset[disabled] .btn-warning.active {
  background-color: #f9b66d;
  border-color: #f9b66d;
}
.btn-danger {
  background-color: #ed5565;
  border-color: #ed5565;
  color: #FFFFFF;
}
.btn-danger:hover,
.btn-danger:focus,
.btn-danger:active,
.btn-danger.active,
.open .dropdown-toggle.btn-danger,
.btn-danger:active:focus,
.btn-danger:active:hover,
.btn-danger.active:hover,
.btn-danger.active:focus {
  background-color: #ec4758;
  border-color: #ec4758;
  color: #FFFFFF;
}
.btn-danger:active,
.btn-danger.active,
.open .dropdown-toggle.btn-danger {
  background-image: none;
}
.btn-danger.disabled,
.btn-danger.disabled:hover,
.btn-danger.disabled:focus,
.btn-danger.disabled:active,
.btn-danger.disabled.active,
.btn-danger[disabled],
.btn-danger[disabled]:hover,
.btn-danger[disabled]:focus,
.btn-danger[disabled]:active,
.btn-danger.active[disabled],
fieldset[disabled] .btn-danger,
fieldset[disabled] .btn-danger:hover,
fieldset[disabled] .btn-danger:focus,
fieldset[disabled] .btn-danger:active,
fieldset[disabled] .btn-danger.active {
  background-color: #ef6776;
  border-color: #ef6776;
}
.btn-link {
  color: inherit;
}
.btn-link:hover,
.btn-link:focus,
.btn-link:active,
.btn-link.active,
.open .dropdown-toggle.btn-link {
  color: #1ab394;
  text-decoration: none;
}
.btn-link:active,
.btn-link.active,
.open .dropdown-toggle.btn-link {
  background-image: none;
}
.btn-link.disabled,
.btn-link.disabled:hover,
.btn-link.disabled:focus,
.btn-link.disabled:active,
.btn-link.disabled.active,
.btn-link[disabled],
.btn-link[disabled]:hover,
.btn-link[disabled]:focus,
.btn-link[disabled]:active,
.btn-link.active[disabled],
fieldset[disabled] .btn-link,
fieldset[disabled] .btn-link:hover,
fieldset[disabled] .btn-link:focus,
fieldset[disabled] .btn-link:active,
fieldset[disabled] .btn-link.active {
  color: #cacaca;
}
.btn-white {
  color: inherit;
  background: white;
  border: 1px solid #e7eaec;
}
.btn-white:hover,
.btn-white:focus,
.btn-white:active,
.btn-white.active,
.open .dropdown-toggle.btn-white,
.btn-white:active:focus,
.btn-white:active:hover,
.btn-white.active:hover,
.btn-white.active:focus {
  color: inherit;
  border: 1px solid #d2d2d2;
}
.btn-white:active,
.btn-white.active {
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15) inset;
}
.btn-white:active,
.btn-white.active,
.open .dropdown-toggle.btn-white {
  background-image: none;
}
.btn-white.disabled,
.btn-white.disabled:hover,
.btn-white.disabled:focus,
.btn-white.disabled:active,
.btn-white.disabled.active,
.btn-white[disabled],
.btn-white[disabled]:hover,
.btn-white[disabled]:focus,
.btn-white[disabled]:active,
.btn-white.active[disabled],
fieldset[disabled] .btn-white,
fieldset[disabled] .btn-white:hover,
fieldset[disabled] .btn-white:focus,
fieldset[disabled] .btn-white:active,
fieldset[disabled] .btn-white.active {
  color: #cacaca;
}

.btn-outline {
  color: inherit;
  background-color: transparent;
  transition: all .5s;
}
.btn-rounded {
  border-radius: 50px;
}
</style>
<div class="box">
    <div class="box-container">
        <div class="content">
          <form action="" method="GET">
            <div class="row bot-items">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label" for="keyword">Tìm kiếm</label>
                        <input type="text" id="keyword" name="keyword" value="{{ request('keyword') ?: old('keyword') }}" placeholder="Bí danh (alias).." class="form-control">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="control-label" for="created_at">Ngày tạo</label>
                        <input type="date" id="created_at" name="created_at" value="{{ request('created_at') ?: old('created_at') }}" placeholder="created_at" class="form-control">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="control-label" for="level">Cấp độ</label>
                        <select name="level" id="level" class="form-control">
                            <option value="">[-- Chọn cấp độ --]</option>
                            @foreach ($levels as $level)
                            <option value="{{ $level->id }}" @selected(request('level') == $level->id)>{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4 mt10">
                    <div class="form-group flex gap10">
                        <input type="submit" value="Tìm"  class="button auto flex btn btn-w-m btn-primary">
                        <input type="button" value="Đặt lại"  class="button auto flex btn btn-w-m btn-default" onclick="location.href = location.pathname">
                    </div>
                </div>
            </div>
          </form>
        </div>
    </div>
</div>