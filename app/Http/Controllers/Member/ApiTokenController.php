<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ApiToken;
use Illuminate\Support\Str;
use App\Enums\ApiToken\StatusEnum;
use Illuminate\Validation\Rules\Enum;

class ApiTokenController extends Controller
{
    public function index(Request $request)
    {
        $tokens = ApiToken::where('user_id', $request->user()->id)
            ->where('status', '!=', StatusEnum::DELETED)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('backend.member_2.api_token', compact('tokens'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'type' => 'required|in:1,2', // 1 = STU, 2 = Note
            'level' => 'required|integer|min:1',
            'description' => 'nullable|string|max:255',
            'status' => ['required', new Enum(StatusEnum::class)]
        ], [
            'type.in' => 'Vui lòng chọn type hợp lệ.',
            'status.in' => 'Vui lòng chọn trạng thái hợp lệ.',
            'level.min' => 'Vui lòng chọn cấp độ hợp lệ.'
        ]);
        $token = new ApiToken();
        $token->user_id = $request->user()->id;
        $token->name = $request->name;
        $token->type = $request->type;
        $token->level_id = $request->level;
        $token->description = $request->description;
        $token->token = Str::uuid()->toString();
        $token->status = $request->status;
        $token->save();

        return redirect()->route('member.api_tokens')->with('success', 'API Token created successfully.');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'level' => 'required|integer|min:1',
            'description' => 'nullable|string|max:255',
            'status' => ['required', new Enum(StatusEnum::class)]
        ]);

        $token = ApiToken::where('user_id', '=', $request->user()->id)->findOrFail($id);
        $token->name = $request->name;
        $token->level_id = $request->level;
        $token->description = $request->description;
        $token->status = StatusEnum::from($request->status);
        $token->save();

        return redirect()->route('member.api_tokens')->with('success', 'API Token updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $token = ApiToken::where('user_id', '=', $request->user()->id)->findOrFail($id);
        $token->status = StatusEnum::DELETED;
        $token->save();

        return redirect()->route('member.api_tokens')->with('success', 'API Token deleted successfully.');
    }
}
