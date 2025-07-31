<?php
use app\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class MailConfigServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Setting::where('key', 'like', 'mailer_%')->get()
            ->each(function ($row) {
                $name = Str::after($row->key, 'mailer_');   // default, marketing…
                $c    = $row->value;                        // mảng đã giải mã

                config([
                    "mail.mailers.$name" => [
                        'transport'  => 'smtp',
                        'host'       => $c['host'],
                        'port'       => $c['port'],
                        'encryption' => $c['encryption'],
                        'username'   => $c['username'],
                        'password'   => $c['password'],
                        'timeout'    => null,
                    ],
                ]);
            });

        // Mặc định xài mailer_default, đổi sau này tuỳ thích
        config(['mail.default' => 'default']);
    }
}
