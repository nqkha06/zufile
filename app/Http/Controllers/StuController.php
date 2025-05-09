<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Arr;
use App\Services\Admin\Interfaces\STUServiceInterface as STUService;
use App\Repositories\Interfaces\STURepositoryInterface as STURepository;
use App\Repositories\Interfaces\STULogReferralRepositoryInterface as STULogReferralRepository;
use App\Repositories\Interfaces\STUAccessRepositoryInterface as STUAccessRepository;
use App\Repositories\Interfaces\STUStatisticRepositoryInterface as STUStatisticRepository;
use App\Services\Interfaces\PostServiceInterface as PostService;

use Illuminate\Support\Facades\Log;
use App\Services\GeoIPService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use App\Facades\Setting;

use App\Models\User;

class StuController extends Controller
{
    protected $STUService;
    protected $STURepository;
    protected $STULogReferralRepository;
    protected $STUAccessRepository;
    protected $STUStatisticRepository;
    protected $geoIPService;
    protected $postService;

    public function __construct(
        STUService $STUService,
        STURepository $STURepository,
        STULogReferralRepository $STULogReferralRepository,
        STUAccessRepository $STUAccessRepository,
        STUStatisticRepository $STUStatisticRepository,
        PostService $postService,
        GeoIPService $geoIPService
    ) {
        $this->STUService = $STUService;
        $this->STURepository = $STURepository;
        $this->STULogReferralRepository = $STULogReferralRepository;
        $this->STUAccessRepository = $STUAccessRepository;
        $this->STUStatisticRepository = $STUStatisticRepository;
        $this->postService = $postService;
        $this->geoIPService = $geoIPService;
    }

    public function create(Request $request)
    {   

        // DB::beginTransaction();
        // try {
            $data = $request->all();

            if (empty($data['lnk'])) {
                return response()->json(['status' => 'error', 'message' => 'Missing data field']);
            }

            $userId = $request->user() ? $request->user()->id : 0;
            $alias = Str::random(4);
            
            do {
                $alias = Str::random(4);
                $unique = $this->STURepository->findLink($alias) ? false : true;
            } while (!$unique);

            $level = isset($data['oth']) && isset($data['oth']['level']) ? base64_decode($data['oth']['level']) : 1;
            $link_1 = urldecode(base64_decode($data['lnk']['lnk1']));
            $get_meta = getMetaFromUrl($link_1);

            $this->STURepository->create([
                'user_id' => $userId,
                'alias' => $alias,
                'data' => json_encode($data),
                'status' => 'active',
                'level_id' => $level,
                'seo_meta' => null
            ]);
            DB::commit();
            return response()->json(['status' => 'success', 'alias' => $alias]);
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     return response()->json(['status' => 'error', 'message' => 'An error occurred while processing your request'], 500);
        // }
    }
    public function update($alias, Request $request)
    {   
        try {
            $data = $request->all();

            if (empty($data['lnk'])) {
                return response()->json(['status' => 'error', 'message' => 'Thiếu liên kết đích..']);
            }
            $link_1 = urldecode(base64_decode($data['lnk']['lnk1']));
            $get_meta = getMetaFromUrl($link_1);

            $level = isset($data['oth']) && isset($data['oth']['level']) ? base64_decode($data['oth']['level']) : 1;

            $payload = [
                'alias' => $alias,
                'data' => json_encode($data),
                'status' => 'active',
                'level_id' => $level,
                'seo_meta' => !isset($get_meta['error']) ? $get_meta : []
            ];

            $data_stu = $this->STUService->getLink($alias);
            $this->authorize('update', $data_stu);

            if ($data_stu->count()) {
                $updated = $this->STUService->updateSTU($data_stu->id, $payload);
                if (!$updated) {
                    return response()->json(['status'=> 'error', 'message'=> 'Update failed']);
                }
            } else {
                return response()->json(['status'=> 'error', 'message'=> 'Link not found']);
            }

            return response()->json(['status' => 'success', 'alias' => $alias]);
            
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e], 500);
        }
    }

    public function redirect(Request $request, $alias)
    {
        $ip_address = generate_random_ip("1.150.113.16");
        
        $cacheKey = "link_STU:{$alias}";

        $link_data = Cache::remember($cacheKey, 60, function () use ($alias) {
            return $this->STURepository
                ->with(['level'])
                ->findLinkActive($alias);
        });

        $SEO = null;
        
        if (!$link_data) {
            return abort(404);
        }
    
        try {
            $get_data_device = $this->getDeviceInfo();
        } catch (\Exception $e) {
            Log::error('Error getting device info: ' . $e->getMessage());
            $get_data_device = [
                'operating_system' => 'unknown',
                'device' => 'unknown',
                'browser' => 'unknown',
            ];
        }
    
        try {
            $data_ip = $this->geoIPService->getCountry($ip_address);
        } catch (\Exception $e) {
            Log::error('Error checking proxy/VPN: ' . $e->getMessage());
            $data_ip = [
                'ip_address' => $ip_address,
                'country' => 'unknown',
                'iso_code' => 'unknown',
            ];
        }
    
        $data_user_agent = [
            'operating_system' => $get_data_device['operating_system'] ?? 'unknown',
            'device' => $get_data_device['device'] ?? 'unknown',
            'browser' => $get_data_device['browser'] ?? 'unknown',
            'country' => $data_ip['iso_code'] ?? 'unknown',
            'referer' => $request->headers->get('referer', 'direct')
        ];
    
        Cache::remember("user_agent:".$ip_address, 60*60, function () use ($data_user_agent) {
            return $data_user_agent;
        });
    
        $data_pageload_configs = json_decode($link_data->level->pageload_config) ?? [];
        $chose_config = $this->getConfig($data_pageload_configs, $data_user_agent);
        if ($chose_config && $chose_config?->link == "[auto]") {
            $data_post_links = $this->postService->getAllPostLinks();
            $pages = $data_post_links;
        } else {
            $pages = $this->getMatchingPages($data_pageload_configs, $data_user_agent);
        }

        if (!empty($pages)) {
            $page_decode = Arr::random($pages);
            Cookie::queue('_stu', '1', 60); 
            if (isset($chose_config->axaj) && !empty($chose_config->axaj) && $chose_config->axaj == "on") {
                Cookie::queue('_stuAxaj', '1', 60); 
            } else {
                Cookie::queue('_stuAxaj', '0', 60); 
            }
            Cookie::queue(Cookie::forget('_note'));

            return response('', 302)
            ->header('Location', route('stu.redirect').
                    "?url=" . base64_encode(urlencode($page_decode . '?a=' . $alias)) .
                    "&SEO=" . base64_encode(json_encode($SEO))
                );
        }
    
        return redirect('/');
    }
    
    private function getMatchingPages($configs, $user_agent)
    {
        foreach ($configs as $config) {
            if ($this->configMatches($config, $user_agent)) {
                return array_filter(array_map('trim', explode(',', $config->link)), 'strlen');
            }
        }
        return [];
    }
    private function getConfig($configs, $user_agent)
    {
        foreach ($configs as $config) {
            if ($this->configMatches($config, $user_agent)) {
                return $config;
            }
        }
        return false;
    }
    private function check($cond, $type, $val) {
        $user_agent = $this->getDeviceInfo();
      
        if ($type == "block") {
            if ($cond == "device") {
                $devices = explode(",", $val);
                if (arrayContains($user_agent['device'], $devices, true)) {
                    return false;
                }
            }
            if ($cond == "operating_system") {
                $operating_systems = explode(",", $val);
                if (arrayContains($user_agent['operating_system'], $operating_systems, true)) {
                    return false;
                }
            }

            if ($cond == "website") {
                $referer = $this->getRefererDomain();
                $websites = explode(",", $val);
                if (arrayContains($referer, $websites, true)) {
                    return false;
                }
            }

        }

        if ($type == "only") {
            if ($cond == "device") {
                $devices = explode(",", $val);
                if (!arrayContains($user_agent['device'], $devices, true)) {
                    return false;
                }
            }
            if ($cond == "operating_system") {
                $operating_systems = explode(",", $val);
                if (!arrayContains($user_agent['operating_system'], $operating_systems, true)) {
                    return false;
                }
            }

            if ($cond == "website") {
                $referer = $this->getRefererDomain();
                $websites = explode(",", $val);
                if (!arrayContains($referer, $websites, true)) {
                    return false;
                }
            }

        }
        
        return true;
    }
    private function configMatches($config, $user_agent)
    {
        if ($config->active !== 'on') {
            return false;
        }
    
        $checks = [
            ['field' => 'country', 'value' => $user_agent['country'], 'all' => '[all]', 'block' => 'block_country'],
            ['field' => 'device', 'value' => $user_agent['device'], 'all' => '[all]', 'block' => 'block_device'],
            ['field' => 'os', 'value' => $user_agent['operating_system'], 'all' => '[all]', 'block' => 'block_os'],
        ];
    
        foreach ($checks as $check) {
            if (!$this->matchesField($config, $check['field'], $check['value'], $check['all'], $check['block'])) {
                return false;
            }
        }
    
        return true;
    }
    
    private function matchesField($config, $field, $value, $all, $block)
    {
        $fieldValues = array_map('strtolower', explode(',', $config->$field));
        $blockValues = array_map('strtolower', explode(',', $config->$block));
    
        return (in_array(strtolower($value), $fieldValues) || $config->$field == $all) &&
               (!in_array(strtolower($value), $blockValues) || $config->$block == '[no]');
    }
    
    public function getDeviceInfo()
    {
        $agent = new Agent();

        $operating_system = $agent->platform(); // lấy hệ điều hành
        $browser = $agent->browser();

        $isMobile = $agent->isMobile();
        $isDesktop = $agent->isDesktop();
        $isTablet = $agent->isTablet();

        return [
            'device' => $isMobile ? 'Mobile' : ($isTablet ? 'Tablet' : 'Desktop'),
            'operating_system' => $operating_system,
            'browser' => $browser,
        ];
    }
    public function count(Request $request, $alias)
    {   
        try {
            $ip_address = $request->ip();
            $ip_address = generate_random_ip("1.150.113.16");

            $invalid_ip = ['0.0.0.0', '127.0.0.1'];

            if (in_array($ip_address, $invalid_ip)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'invalid ip'
                ]);

            }

            $cacheKey = "link_STU:{$alias}";
    
            $link_data = Cache::remember($cacheKey, 60, function () use ($alias) {
                return $this->STURepository
                    ->with(['level'])
                    ->findLinkActive($alias);
            });
            
            if (!$link_data) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid alias'
                ]);
            }
            $loged = Cache::get("user_agent:".$ip_address);

            if (empty($loged)) {
                $loged = (object) [
                    'ip_address' => $ip_address,
                    'referrer_url' => 'danger',
                ];
                // return response()->json([
                //     'status' => 'error',
                //     'message' => 'Invalid authentication'
                // ]);
            }

            if ($link_data->user_id == 0) {
                $accessed = $this->STUAccessRepository->getAccessedByCondition([['ip_address', '=', $ip_address], ['link_id', '=', $link_data->id]], Carbon::today());
            } else {
                $accessed = $this->STUAccessRepository->getAccessedByCondition([['ip_address', '=', $ip_address], ['user_id', '=', $link_data->user_id]], Carbon::today());
            }

            //update stats
            // $this->STUStatisticRepository->updateOrInsertStatsByAttr([
            //     'link_id' => $link_data->id,
            //     'date' => Carbon::today()->toDateString()
            // ], $link_data->level->click_value);

            $checkProxyVPN = checkProxyVPN($ip_address);

            $loged = (array) $loged;

            $rate = $link_data->level->rates()->where("country_code", "=", $loged['country'])->first();
            if (!$rate) {
                $rate = $link_data->level->rates()->where("country_code", "=", "ALL")->first();
            }
            if (isset($loged['device']) && $loged['device'] == "Desktop") {
                $revenue = (float) $rate->rate[0] / 1000;
                $limit = $rate?->daily_limit[0] ?? 1;

            } else {
                $revenue = (float) $rate->rate[1] / 1000;
                $limit = $rate?->daily_limit[1] ?? 1;
            }

            
            if (count($accessed) >= $limit) {
                return response()->json([
                    'status' => 'error',
                    'message'=> 'limited click, '.'clicked today '.count($accessed)
                ]);
            }
            
            $create_data = [
                'user_id' => $link_data->user_id,
                'parent_id' => $link_data->id, //static_id
                'link_id' => $link_data->id, //link_id
                'is_earn' => 1,
                'revenue' => $revenue,
                'reason' => 1,
                'ip_address' => $ip_address,
                'referral' => $loged['referer'],
                'country' => $loged['country'],
                'browser' => $loged['browser'],
                'platform' => $loged['operating_system'],
                'device' => $loged['device'],
                'detection' => $checkProxyVPN['result'],
            ];

            $dataUp = $this->STUAccessRepository->create(
                $create_data
            );

            $user = User::find($link_data->user_id);
            if ($user) {
                $user->increment('balance', $revenue);
            }

            return response()->json([
                'status' => 'success',
                'message'=> 'visits +1, '.'clicked today '.(count($accessed)+1)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message'=> $e->getMessage()    
            ]);
        }  
    }
    public function fetch(Request $request, $alias)
    {

        // try {
            $lang = $request->get('lang') ?? 'vi';
            // Hàm encodeURIComponent và decodeURIComponent
            function encodeURIComponent($str)
            {
                $revert = array('%21' => '!', '%2A' => '*', '%27' => "'", '%28' => '(', '%29' => ')');
                return strtr(rawurlencode($str), $revert);
            }
    
            function decodeURIComponent($str)
            {
                return rawurldecode($str);
            }
    
            // Hàm mã hóa và giải mã
            function ecSTU($text)
            {
                return base64_encode(encodeURIComponent($text));
            }
    
            function dcSTU($encodedText)
            {
                return decodeURIComponent(base64_decode($encodedText));
            }
    
            // Tạo danh sách nút và biểu tượng trực tiếp
            $nameButton = [
                'yt' => ecSTU(transLang('stu.dc.yt', $lang)),
                'ytl' => ecSTU(transLang('stu.dc.ytl', $lang)),
                'ytc' => ecSTU(transLang('stu.dc.ytc', $lang)),
                'ytlc' => ecSTU(transLang('stu.dc.ytlc', $lang)),
                'tg' => ecSTU(transLang('stu.dc.tg', $lang)),
                'tk' => ecSTU(transLang('stu.dc.tk', $lang)),
                'tkl' => ecSTU(transLang('stu.dc.tkl', $lang)),
                'tkc' => ecSTU(transLang('stu.dc.tkc', $lang)),
                'tkr' => ecSTU(transLang('stu.dc.tkr', $lang)),
                'ig' => ecSTU(transLang('stu.dc.ig', $lang)),
                'igl' => ecSTU(transLang('stu.dc.igl', $lang)),
                'fb' => ecSTU(transLang('stu.dc.fb', $lang)),
                'fbl' => ecSTU(transLang('stu.dc.fbl', $lang)),
                'dc' => ecSTU(transLang('stu.dc.dc', $lang)),
                'zl' => ecSTU(transLang('stu.dc.zl', $lang)),
            
                'lnk' => ecSTU(transLang('stu.dc.lnk', $lang))
            ];
            
            $iconButon = [
                'yt' => ecSTU('yt'),
                'ytl' => ecSTU('ytl'),
                'ytc' => ecSTU('ytc'),
                'ytlc' => ecSTU('ytlc'),
                'tg' => ecSTU('tg'),
                'tk' => ecSTU('tk'),
                'tkl' => ecSTU('tkl'),
                'ig' => ecSTU('ig'),
                'igl' => ecSTU('igl'),
                'fb' => ecSTU('fb'),
                'fbl' => ecSTU('fbl'),
                'ct' => ecSTU('ct'),
                'dc' => ecSTU('dc'),
                'lnk' => ecSTU('lnk')
            ];
        
            $result = Cache::remember("link_STU:{$alias}", 60, function () use ($alias) {
                return $this->STURepository
                    ->with(['level'])
                    ->findLinkActive($alias);
            });
            
            if (empty($result)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Link not found',
                    'data' => null
                ], 404);
            }
    
            $user_id = $result->user_id;
            $dtSTU = json_decode($result->data, true);
    
            if (!isset($result->level) && empty($result->level)) {
                return response()->json(['message' => 'Error config']);
            }
    
            $config = json_decode($result->level->config);
            $_config = [];

            foreach ($config as $typeName => $arr) {
                $cnt = 0;
                foreach ($arr as $key => $arr2) {
                    if (isset($arr2->confs) && !empty($arr2->confs)) {
                        $flag = true;

                        if (isset($arr2->conds) && !empty($arr2->conds)) {
                            $conds = $arr2->conds;

                            for ($i = 0; $i < count($conds->cond); $i++) {
                                $cond = $conds->cond[$i];
                                $type = $conds->type[$i];
                                $val = $conds->val[$i];
                                $flag = $this->check($cond, $type, $val);

                                if ($flag == false) break;
                            }

                        }

                        if (isset($arr2->confs->links) && $arr2->confs->links == "[auto]") {
                            $linksArray = $this->postService->getAllPostLinks();
                            $joinedLinks = implode(',', $linksArray);
                            $arr2->confs->links = $joinedLinks;
                        }

                        if ($flag) {
                            $confs = $arr2->confs;
                            $_config[$typeName][$cnt] = $confs;
                            $cnt++;
                        }
                        
                    }
                }

            }

            // Khởi tạo dữ liệu trả về
            $res = [
                'config' => $_config,
                'data' => [
                    'btn' => [],
                    'lnk' => [],
                    'oth' => [],
                    'info' => [
                        'alias' => $alias,
                        'userId' => $user_id,
                        'url_count' => route('stu.count', $alias),
                        'country' => '',
                        'device' => '',
                        'os' => '',
                        'browser' => '',
                        'timestamp' => time()*1000,
                    ],
                    'txt' => [
                        'ft' => [
                            'created_with' => 'Created with',
                            'i_url' => 'https://link4sub.com/images/favicon.png',
                            'url' => 'https://link4sub.com/',
                            'name' => 'Link4Sub'
                        ],
                        'unlock_progress' => transLang('stu.dc.unlock_progress', $lang),
                        'load' => transLang('stu.dc.load', $lang),
                        'done' => transLang('stu.dc.done', $lang),
                        'languages' => transLang('stu.dc.languages', $lang),
                        'password' => transLang('stu.dc.password', $lang),
                        'enter_password' => transLang('stu.dc.enter_password', $lang),
                        'enter_password_war' => transLang('stu.dc.enter_password_war', $lang),
                        'confirm_password' => transLang('stu.dc.confirm_password', $lang),
                        'continue' => transLang('stu.dc.continue', $lang),
                        'next_step' => transLang('stu.dc.next_step', $lang),
                        'verify' => [
                            'title' => transLang('stu.dc.verify.title', $lang),
                            'desc' => transLang('stu.dc.verify.desc', $lang),
                            'btn' => transLang('stu.dc.verify.btn', $lang)
                        ]
                    ],
                    'aApi' => [
                        'userId' => [40, 'user'],
                        'lAPI' => [
                            'https://yeumoney.com/QL_api.php?token=5b539c82581a36409cab82695111565f5df92ee284414b49d4d22ff7990efefb&url='
                        ]
                    ]
                    
                ]
            ];
    
            // Xử lý nút bấm và liên kết
            $text_BTN = [];
            $pattern = '/\d{1}[a-zA-Z]$/';
    
            foreach (['btn' => $dtSTU['btn'] ?? [], 'lnk' => $dtSTU['lnk'] ?? []] as $type => $items) {
                if (!is_array($items)) continue;
    
                foreach ($items as $key => $value) {
                    $key_ = preg_replace('/\d+/', '', $key);
    
                    if (preg_match($pattern, $key)) {
                        $text_BTN[$key] = $value;
                        continue;
                    }
    
                    $res['data'][$type][$key] = [
                        'url' => $value,
                        'ic' => $iconButon[$key_] ?? ecSTU('yt'),
                        'name' => $nameButton[$key_] ?? $text_BTN[$key . 't'] ?? ''
                    ];
                }
            }
    
            // Xử lý dữ liệu khác
            $other = $dtSTU['oth'] ?? [];
            $res['data']['oth'] = [
                'ttl' => $other['ttl'] ?? ecSTU('Unlock Link'),
                'sttl' => $other['sttl'] ?? ecSTU(transLang('stu.dc.sttl_default', $lang)),
                'note' => $other['note'] ?? ecSTU(transLang('stu.dc.note_default', $lang)),
                'lv' => ecSTU($result->level_id),
                'pwd' => $other['pwd'] ?? false,
                'thmb' => $other['thmb'] ?? false,
                'exp' => $other['exp'] ?? false,
                'sty' => $other['sty'] ?? ''
            ];
    
            // Xử lý thông tin người dùng
            $ip_address = $request->ip();
            $ip_address = "1.150.113.16";
            $loged = Cache::get("user_agent:". $ip_address);
            if (!$loged) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Link Expired...'
                ], 200);
            }
    
            $res['data']['info']['country'] = $loged['country'];
            $res['data']['info']['device'] = $loged['device'];
            $res['data']['info']['os'] = $loged['operating_system'];
            $res['data']['info']['browser'] = $loged['browser'];
    
            return response()->json([
                'status' => 'success',
                'message' => 'Link fetched successfully',
                'data' => $res
            ], 200);
    
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => $e,
        //         'data' => null
        //     ], 500);
        // }
    }
    private function getRefererDomain(): string|null
    {
        $referer = request()->headers->get('referer');;
   
        $domain = $referer ? parse_url($referer, PHP_URL_HOST) : null;

        return $domain;
    }

    private function reason(Request $request) {
        $check = [];
        /*check cookie*/
        if (!$request->has('check_cookie')) {
            Cookie::queue(Cookie::make('app_cookie_check', 'test', 1)); // Cookie hết hạn sau 1 phút
        }

        $isCookieDisabled = !$request->cookie('app_cookie_check');

        if ($isCookieDisabled) {
            $check[] = 2;
        }


        return $check;
    }
}