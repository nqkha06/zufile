<div class="card email-config-item mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <strong>Cấu hình Email #{{ ++$index }}</strong>
        <button type="button" class="btn btn-sm btn-danger remove-config">Xoá</button>
    </div>

    <div class="card-body">

        {{-- Người gửi thư --}}
        <div class="mb-3">
            <label class="form-label">Người gửi thư</label>
            <select class="form-select" name="email_configs[{{ $index }}][email_driver]">
                <option value="">- Lựa chọn -</option>
                <option value="smtp" @selected(($config['email_driver'] ?? '') === 'smtp')>SMTP</option>
                <option value="mailgun" @selected(($config['email_driver'] ?? '') === 'mailgun')>Mailgun</option>
                <option value="ses" @selected(($config['email_driver'] ?? '') === 'ses')>SES</option>
                <option value="sendmail" @selected(($config['email_driver'] ?? '') === 'sendmail')>Sendmail</option>
                <option value="log" @selected(($config['email_driver'] ?? '') === 'log')>Log</option>
            </select>
        </div>

        {{-- === SMTP fields === --}}
        <div class="email-driver-fields" data-driver="smtp" style="display: none">
            <div class="mb-3">
                <label class="form-label">Port</label>
                <input class="form-control" name="email_configs[{{ $index }}][email_port]" type="number"
                       value="{{ $config['email_port'] ?? '' }}" placeholder="587">
            </div>
            <div class="mb-3">
                <label class="form-label">Host</label>
                <input class="form-control" name="email_configs[{{ $index }}][email_host]" type="text"
                       value="{{ $config['email_host'] ?? '' }}" placeholder="smtp.domain.com">
            </div>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input class="form-control" name="email_configs[{{ $index }}][email_username]" type="text"
                       value="{{ $config['email_username'] ?? '' }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input class="form-control" name="email_configs[{{ $index }}][email_password]" type="text"
                       value="{{ $config['email_password'] ?? '' }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Local Domain</label>
                <input class="form-control" name="email_configs[{{ $index }}][email_local_domain]" type="text"
                       value="{{ $config['email_local_domain'] ?? '' }}">
            </div>
        </div>

        {{-- === Mailgun fields === --}}
        <div class="email-driver-fields" data-driver="mailgun" style="display: none">
            <div class="mb-3">
                <label class="form-label">Mailgun Domain</label>
                <input class="form-control" name="email_configs[{{ $index }}][email_mail_gun_domain]" type="text"
                       value="{{ $config['email_mail_gun_domain'] ?? '' }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Mailgun Endpoint</label>
                <input class="form-control" name="email_configs[{{ $index }}][email_mail_gun_endpoint]" type="text"
                       value="{{ $config['email_mail_gun_endpoint'] ?? 'api.mailgun.net' }}">
            </div>
        </div>

        {{-- === SES fields === --}}
        <div class="email-driver-fields" data-driver="ses" style="display: none">
            <div class="mb-3">
                <label class="form-label">SES Key</label>
                <input class="form-control" name="email_configs[{{ $index }}][email_ses_key]" type="text"
                       value="{{ $config['email_ses_key'] ?? '' }}">
            </div>
            <div class="mb-3">
                <label class="form-label">SES Region</label>
                <input class="form-control" name="email_configs[{{ $index }}][email_ses_region]" type="text"
                       value="{{ $config['email_ses_region'] ?? 'us-east-1' }}">
            </div>
        </div>

        {{-- === Sendmail fields === --}}
        <div class="email-driver-fields" data-driver="sendmail" style="display: none">
            <div class="mb-3">
                <label class="form-label">Sendmail Path</label>
                <input class="form-control" name="email_configs[{{ $index }}][email_sendmail_path]" type="text"
                       value="{{ $config['email_sendmail_path'] ?? '/usr/sbin/sendmail -bs -i' }}">
            </div>
        </div>

        {{-- === Log fields === --}}
        <div class="email-driver-fields" data-driver="log" style="display: none">
            <div class="mb-3">
                <label class="form-label">Log Channel</label>
                <select class="form-select" name="email_configs[{{ $index }}][email_log_channel]">
                    @php
                        $channels = ['stack', 'single', 'daily', 'slack', 'stderr', 'syslog', 'errorlog', 'null', 'emergency'];
                    @endphp
                    <option value="">- Lựa chọn -</option>
                    @foreach ($channels as $channel)
                        <option value="{{ $channel }}" @selected(($config['email_log_channel'] ?? '') === $channel)>
                            {{ $channel }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- === Common fields (dùng cho mọi driver) === --}}
        <div class="mb-3">
            <label class="form-label">Tên người gửi</label>
            <input class="form-control" name="email_configs[{{ $index }}][email_from_name]" type="text"
                   value="{{ $config['email_from_name'] ?? '' }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Email người gửi</label>
            <input class="form-control" name="email_configs[{{ $index }}][email_from_address]" type="email"
                   value="{{ $config['email_from_address'] ?? '' }}">
        </div>

        <div class="mb-0">
            <label class="form-label">Loại cấu hình</label>
            <input class="form-control" name="email_configs[{{ $index }}][type]" type="text"
                   value="{{ $config['type'] ?? '' }}" placeholder="auth, withdraw, notify...">
        </div>

    </div>
</div>
