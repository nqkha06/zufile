<?php
use Illuminate\Support\Carbon;
use App\Services\SettingService;

if (!function_exists('round_views')) {
    function round_views($views)
    {
        if ($views >= 1000000000) {
            return number_format($views / 1000000000, 1) . 'T';
        } elseif ($views >= 1000000) {
            return number_format($views / 1000000, 1) . 'TR';
        } elseif ($views >= 1000) {
            return number_format($views / 1000, 1) . 'N';
        } else {
            return (string)$views;
        }
    }
}

if (!function_exists('round_revenue')) {
    function round_revenue($number)
    {
        return round($number, 3);
    }
}

if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        return app(SettingService::class)->get($key, $default);
    }
}
if (!function_exists('convertChartData')) {
    function convertChartData($dataChart, $startDate, $endDate)
    {
        $lables = daysBetweenMonths($startDate, $endDate);

        $data['revenue'] = [];
        $data['visits'] = [];
        $data['cpm']= [];

        foreach ($lables as $key=>$val) {
            $_data = $dataChart->firstWhere('date', $val);
            if (!empty($_data)) {
                $revenue = $_data->revenue;
                $visits = $_data->clicks;
                $cpm = $_data->clicks > 0 ? ($_data->revenue / $_data->clicks) * 1000 : 0;
            } else {
                $revenue = 0;
                $visits = 0;
                $cpm = 0;
            }

            $data['revenue'][] = round($revenue, 3);
            $data['visits'][] = (int)$visits;
            $data['cpm'][] = round($cpm, 3);
        }

        return [
            'labels' => $lables,
            'data' => $data
        ];
    }
}
if (!function_exists('convertChartStats')) {
    function convertChartStats($STUStats, $NOTEStats, $startDate, $endDate)
    {
        $merged = $STUStats->concat($NOTEStats)
        ->groupBy('date')
        ->map(function($items, $date) {
            return (object) [
                'date' => $date,
                'clicks' => $items->sum('clicks'),
                'revenue' => $items->sum('revenue'),
            ];
        })->values();

        $lables = daysBetweenMonths($startDate, $endDate);

        $data['revenue'] = [];
        $data['visits'] = [];
        $data['cpm']= [];

        foreach ($lables as $key=>$val) {
            $_data = $STUStats->firstWhere('date', $val);
            if (!empty($_data)) {
                $revenue = $_data->revenue;
                $visits = $_data->clicks;
                $cpm = $_data->clicks > 0 ? ($_data->revenue / $_data->clicks) * 1000 : 0;
            } else {
                $revenue = 0;
                $visits = 0;
                $cpm = 0;
            }

            $data['revenue']['STU'][] = round($revenue, 3);
            $data['visits']['STU'][] = (int)$visits;
            $data['cpm']['STU'][] = round($cpm, 3);
        }
        foreach ($lables as $key=>$val) {
            $_data = $NOTEStats->firstWhere('date', $val);
            if (!empty($_data)) {
                $revenue = $_data->revenue;
                $visits = $_data->clicks;
                $cpm = $_data->clicks > 0 ? ($_data->revenue / $_data->clicks) * 1000 : 0;
            } else {
                $revenue = 0;
                $visits = 0;
                $cpm = 0;
            }

            $data['revenue']['NOTE'][] = round($revenue, 3);
            $data['visits']['NOTE'][] = (int)$visits;
            $data['cpm']['NOTE'][] = round($cpm, 3);
        }

        return [
            'labels' => $lables,
            'data' => $data
        ];
    }
}
if (!function_exists('convertPaginData')) {
    function convertPaginData($dataChart, $startDate, $endDate)
    {
        $lables = daysBetweenMonths($startDate, $endDate);


        foreach ($lables as $key=>$val) {
            $_data = $dataChart->firstWhere('date', $val);
            if (!empty($_data)) {
                $revenue = $_data->revenue;
                $visits = $_data->clicks;
                $cpm = $_data->clicks > 0 ? ($_data->revenue / $_data->clicks) * 1000 : 0;
            } else {
                $revenue = 0;
                $visits = 0;
                $cpm = 0;
            }

            $data[] = [
                'date' => $val,
                'revenue' => round($revenue, 3),
                'views' => (int)$visits,
                'cpm' => round($cpm, 3)
            ];
        
        }
        return $data;
    }
}
if (!function_exists('convertChartAccess')) {
    function convertChartAccess($dataChart)
    {
        dd($dataChart);

    }
}
if (!function_exists('calcDaysBetween')) {
    function calcDaysBetween($startDate, $endDate): int
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        return $start->diffInDays($end);
    }
}
if (!function_exists('daysBetweenMonths')) {
    function daysBetweenMonths(string $startDate, string $endDate, string $dateFormat='Y-m-d'): array
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
        
        if ($start->gt($end)) {
            throw new InvalidArgumentException('Invalid date range: start date must be less than or equal to end date');
        }
        
        $carbonDays = [];
        
        for ($date = $start; $date->lte($end); $date->addDay()) {
            $carbonDays[] = $date->format($dateFormat);
        }
        
        return $carbonDays;
    }
}

if (!function_exists('generateUniqueIdentifier')) {
    function generateUniqueIdentifier($request)
    {    
        $agent = $request->header('User-Agent');
        $accept = $request->header('Accept');
        $acceptLanguage = $request->header('Accept-Language');
        $acceptLanguage = $request->header('Accept-Encoding');

        $identifierString = $agent . $accept . $acceptLanguage . $acceptLanguage;
        $uniqueIdentifier = md5($identifierString);

        return $uniqueIdentifier;
    }
    if (!function_exists('generate_random_ip')) {
        function generate_random_ip($ip_defaut = null) {
            return $ip_defaut ?? long2ip(rand(0, 4294967295));
        }
    }
}

if (!function_exists('formatDataAccess')) {
    function formatDataAccess($views)
    {
        if ($views >= 1000000000) {
            return number_format($views / 1000000000, 1) . 'T';
        } elseif ($views >= 1000000) {
            return number_format($views / 1000000, 1) . 'TR';
        } elseif ($views >= 1000) {
            return number_format($views / 1000, 1) . 'N';
        } else {
            return (string)$views;
        }
    }
}

if (!function_exists('startOfDay')) {
    function startOfDay($date) {
        try {
            // Sử dụng Carbon để kiểm tra và trả về đầu ngày
            return Carbon::createFromFormat('Y-m-d', $date)->startOfDay()->toDateTimeString();
        } catch (\Exception $e) {
            return false;
        }
    }
}

if (!function_exists('endOfDay')) {
    function endOfDay($date) {
        try {
            // Sử dụng Carbon để kiểm tra và trả về cuối ngày
            return Carbon::createFromFormat('Y-m-d', $date)->endOfDay()->toDateTimeString();
        } catch (\Exception $e) {
            return false;
        }
    }
}
if (!function_exists('render_article')) {
    function render_article($article)
    {
        return '
        <article class="ntry">
            <div class="pThmb">
                <a class="thmb" href="' . route('blog.show', $article['slug']) . '">
                    <img alt="' . $article['title'] . '" class="imgThm lazy" data-src="' . $article['image'] . '"  >
                    <noscript><img alt="' . $article['title'] . '" class="imgThm" src="' . $article['image'] . '" /></noscript>
                </a>
                ' . (count($article->views) ? '
                <div class="iFxd">
                    <a aria-label="Views" class="cmnt" data-text="' . $article['views']->sum('views') . '" role="button">
                        <svg viewBox="0 0 576 512"><path d="M288 128C217.3 128 160 185.3 160 256s57.33 128 128 128c70.64 0 128-57.32 128-127.9C416 185.4 358.7 128 288 128zM288 352c-52.93 0-96-43.06-96-96s43.07-96 96-96c52.94 0 96 43.02 96 96.01C384 308.9 340.1 352 288 352zM572.5 238.1C518.3 115.5 410.9 32 288 32S57.69 115.6 3.469 238.1C1.563 243.4 0 251 0 256c0 4.977 1.562 12.6 3.469 17.03C57.72 396.5 165.1 480 288 480s230.3-83.58 284.5-206.1C574.4 268.6 576 260.1 576 256C576 251 574.4 243.4 572.5 238.1zM543.2 260.2C492.3 376 394.5 448 288 448c-106.5 0-204.3-71.98-255-187.3C32.58 259.6 32.05 256.9 31.1 256.2c.0547-1.146 .5859-3.783 .7695-4.363C83.68 135.1 181.5 64 288 64c106.5 0 204.3 71.98 255 187.3c.3945 1.08 .9238 3.713 .9785 4.443C543.9 256.9 543.4 259.6 543.2 260.2z"></path></svg>
                    </a>
                </div>
                ' : '') . '
            </div>
            <div class="pCntn">
                ' . (isset($article['category']) && !empty($article['category']) ? '
                <div class="pHdr pSml">
                    <div class="aNm">
                        <div class="pLbls" data-text="in">
                            <a aria-label="' . $article['category']->name . '" data-text="' . $article['category']->name . '" href="/search/category/' . $article['category']->name . '" rel="category"></a>
                        </div>
                    </div>
                </div>
                ' : '') . '
    
                <h2 class="pTtl aTtl">
                    <a data-text="' . $article['title'] . '" href="' . route('blog.show', $article['slug']) . '" rel="bookmark">' . $article['title'] . '</a>
                </h2>
                <div class="pSnpt">' . $article['summary'] . '</div>
                <div class="pInf pSml">
                    <time class="aTtmp pTtmp pbl timeAgo" datetime="' . $article['created_at'] . '"></time>
                    <a aria-label="Read more" class="pJmp" data-text="Keep reading" href="' . route('blog.show', $article['slug']) . '"></a>
                </div>
                <script type="application/ld+json">
                    {
                        "@context": "http://schema.org",
                        "@type": "BlogPosting",
                        "mainEntityOfPage": {
                            "@type": "WebPage",
                            "@id": "' . route('blog.show', $article['slug']) . '"
                        },
                        "headline": "' . $article['title'] . '",
                        "description": "Daftar semua fitur yang tersedia pada template iMagz Kami berusaha membuat template yang memiliki fitur lengkap serta mudah untuk digunakan, setelah pengembangan yang lumayan memakan waktu a&#8230;",
                        "datePublished": "' . $article['created_at'] . '",
                        "dateModified": "2021-11-30T12:22:21+08:00",
                        "image": {
                            "@type": "ImageObject",
                            "url": "' . $article['image'] . '",
                            "height": 630,
                            "width": 1200
                        },
                        "publisher": {
                            "@type": "Organization",
                            "name": "Link4Sub",
                            "logo": {
                                "@type": "ImageObject",
                                "url": "https://1.bp.blogspot.com/-50s1RMWV7jI/X8OaYjJcMiI/AAAAAAAAQK4/sWcpbaP0Sq0hsW473Vnb8AyBvYvdSQEPwCNcBGAsYHQ/s0/jd-logo.png",
                                "width": 297,
                                "height": 45
                            }
                        },
                        "author": {
                            "@type": "Person",
                            "name": "Maki M.",
                            "url": "https://www.blogger.com/profile/08446403296417996016",
                            "image": "//blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgzF9AGWE18_IM-gLFtDK0JRz5yLirqNbTRIlzvV7sAYiOuPRaBqzZxvCH0qPws9Bm6fk63hcq8Ul3vzqXOL6LnCVNiEb0TdcOJPLkbo0wWjeX2weHNfOmkTFUXewBVnw/s113/AGNmyxbI5mHQwE64pM7LeEqCa574TGg6Rb_F3WRXHkgkYmw"
                        }
                    }
                </script>
            </div>
        </article>
        ';
    }
    
}

if (!function_exists('handle_date_range')) {
    function handle_date_range($startParam = null, $endParam = null)
    {
        if (!isset($startParam) || !isset($endParam) || empty($startParam) || empty($endParam)) {
            $startDate = Carbon::now()->firstOfMonth();
            $endDate = Carbon::now();
        } else {
            $startDate = Carbon::parse($startParam)->startOfDay();
            $endDate = Carbon::parse($endParam)->endOfDay();
        }

        return [$startDate, $endDate];
    }
    
}
// app/Helpers/helpers.php
if (!function_exists('sortable_url')) {
    function sortable_url($routeName, $sortBy)
    {
        return route($routeName, array_merge(request()->all(), [
            'sort_by' => $sortBy,
            'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc'
        ]));
    }
}

if (!function_exists('transLang')) {
    function transLang($key, $locale = 'en') {
        return trans($key, [], $locale);
    }
}


?>