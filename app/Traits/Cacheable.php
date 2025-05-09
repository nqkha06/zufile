<?php
namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait Cacheable
{
    protected $shouldCache = false;
    protected $cacheKey;
    protected $cacheTime = 1800;

    public function cache(string $cacheKey = null, int $cacheTime = null)
    {
        $this->shouldCache = true;
        if ($cacheKey !== null) {
            $this->cacheKey = $cacheKey;
        }
        if ($cacheTime !== null) {
            $this->cacheTime = $cacheTime;
        }
        return $this;
    }

    protected function cacheRemember(callable $callback)
    {
        if ($this->shouldCache) {
            $key = $this->cacheKey ?? $this->generateCacheKey();
            return Cache::remember($key, $this->cacheTime, $callback);
        }
        return $callback();
    }

    protected function generateCacheKey()
    {
        return md5(get_class($this) . ':' . debug_backtrace()[2]['function']);
    }
}
