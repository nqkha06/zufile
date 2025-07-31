<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserSettingService
{
    public function get(string $key, $default = null, $user = null)
    {
        if ($user instanceof User) {
            $_user = $user;
        } else if (is_numeric($user)) {
            $_user = User::find($user);
        } else {
            $_user = Auth::user();
        }

        // Nếu không tìm thấy user, trả về giá trị mặc định
        if (!$_user) {
            return $default;
        }

        // Lấy cài đặt từ user với key cụ thể
        $setting = $_user->settings()->where('key', $key)->first();

        return $setting ? $setting->value : $default;
    }

    public function get22($user_id, string $key, $default = null)
    {
        $user = $user_id ? User::find($user_id) : request()->user();
        if (!$user) return $default;

        $setting = $user->settings()->where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public function set(string $key, $value, ?User $user = null)
    {
        $user = $user ?? request()->user();
        if (!$user) return false;

        $user->settings()->updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
        return true;
    }
}
