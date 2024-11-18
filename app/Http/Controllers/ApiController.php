<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiToken;
use App\Models\StuLink;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class ApiController extends Controller
{
    public function index(Request $request)
    {
        $allParam = $request->query();

        if (!empty($allParam['token'])) {
            $dataRt = ApiToken::where('token', $allParam['token'])->first();

            if ($dataRt) {
                $jsonDt = json_decode($dataRt->data, true);

                $lnk = [];

                for ($x = 1; $x <= 5; $x++) {
                    $xL = 'lnk'.$x;
                    $xT = 'lnk'.$x.'t';
                    if (!empty($allParam[$xL])) {
                        $lnk[$xL] = $allParam[$xL];

                        if (!empty($allParam[$xT])) $lnk[$xT] = $allParam[$xT];
                    }
               
                }
                $jsonDt['lnk'] = $lnk;

                dd($jsonDt);
                echo 'Tồn tại token';
            } else {
                echo 'Không tồn tại token'; 
            }

        } else {
            echo 'The API token parameter is required';
        }
    }
    public function create(Request $request)
    {   
        try {
            $data = $request->all();

            $userId = $request->user() ? $request->user()->id : 0;
            if (!$userId) {
                return response()->json(['status' => 'error', 'message' => 'Must be a User']);
            }
            // $alias = Str::random(config('config.alias_​length'));
            
            // do {
            //     $alias = Str::random(config('config.alias_​length'));
            //     $unique = StuLink::where('alias', $alias)->doesntExist();
            // } while (!$unique);

            $name = isset($data['oth']) && isset($data['oth']['napi']) ? base64_decode($data['oth']['napi']) : 'Api-'.Str::random(6);
            $token = Str::uuid()->toString();
            
            ApiToken::create([
                'user_id' => $userId,
                'name' => $name,
                'token' => $token,
                'data' => json_encode($data),
                'status' => 1,
                'created_at' => now()
            ]);
            return response()->json(['status' => 'success', 'token' => $token]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['status' => 'error', 'message' => 'An error occurred while processing your request'], 500);
        }
    }
}
