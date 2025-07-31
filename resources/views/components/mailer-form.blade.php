@props(['action','method'=>'POST','mailer'=>null])

<form action="{{ $action }}" method="POST" class="row g-3">
  @csrf @if($method !== 'POST') @method($method) @endif

  <div class="col-md-4">
    <label class="form-label">Tên mailer</label>
    <input name="name" class="form-control" required
           value="{{ old('name', $mailer->name ?? '') }}">
  </div>

  <div class="col-md-4">
    <label class="form-label">Host</label>
    <input name="host" class="form-control" required
           value="{{ old('host', $mailer->host ?? 'smtp.gmail.com') }}">
  </div>

  <div class="col-md-4">
    <label class="form-label">Port</label>
    <input type="number" name="port" class="form-control" required
           value="{{ old('port', $mailer->port ?? 465) }}">
  </div>

  <div class="col-md-4">
    <label class="form-label">Encryption</label>
    <select name="encryption" class="form-select" required>
      <option value="ssl"
        @selected(old('encryption',$mailer->encryption ?? '')==='ssl')>ssl</option>
      <option value="tls"
        @selected(old('encryption',$mailer->encryption ?? '')==='tls')>tls</option>
    </select>
  </div>

  <div class="col-md-4">
    <label class="form-label">Username</label>
    <input name="username" class="form-control" required
           value="{{ old('username', $mailer->username ?? '') }}">
  </div>

  <div class="col-md-4">
    <label class="form-label">App Password</label>
    <input type="password" name="password" class="form-control" required
           value="{{ old('password', $mailer->password ?? '') }}">
  </div>

  <div class="col-md-6">
    <label class="form-label">From Address</label>
    <input type="email" name="from_address" class="form-control" required
           value="{{ old('from_address', $mailer->from_address ?? '') }}">
  </div>

  <div class="col-md-6">
    <label class="form-label">From Name</label>
    <input name="from_name" class="form-control" required
           value="{{ old('from_name', $mailer->from_name ?? '') }}">
  </div>

  <div class="col-12 text-end">
    <button class="btn btn-primary">{{ $mailer ? 'Cập nhật' : 'Thêm mới' }}</button>
  </div>
</form>
