<?php

namespace App\Services;

use GeoIp2\Database\Reader;

class GeoIPService
{
    protected $reader;
    protected $dbType;

    public function __construct()
    {
        // Đường dẫn đến cơ sở dữ liệu MaxMind
        $dbPath = storage_path('app/geoip/GeoLite2-Country.mmdb'); // Đường dẫn có thể thay đổi
        $this->reader = new Reader($dbPath);

        // Xác định loại cơ sở dữ liệu đang dùng
        $this->dbType = strpos($dbPath, 'City') !== false ? 'city' : 'country';
    }

    public function getCountry($ipAddress)
    {
        try {
            if ($this->dbType === 'city') {
                // Nếu sử dụng GeoLite2-City.mmdb
                $record = $this->reader->city($ipAddress);

                return [
                    'country' => $record->country->name,
                    'iso_code' => $record->country->isoCode,  // Lấy mã quốc gia
                    'city' => $record->city->name,
                    'latitude' => $record->location->latitude,
                    'longitude' => $record->location->longitude,
                ];
            } else {
                // Nếu sử dụng GeoLite2-Country.mmdb
                $record = $this->reader->country($ipAddress);

                return [
                    'ip_address' => $ipAddress,
                    'country' => $record->country->name,
                    'iso_code' => $record->country->isoCode,  // Lấy mã quốc gia
                ];
            }
        } catch (\Exception $e) {
            return null; // Xử lý ngoại lệ nếu có lỗi
        }
    }
}
