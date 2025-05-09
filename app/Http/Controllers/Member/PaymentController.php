<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\UserPayment;
use App\Models\PaymentMethod;
use App\Services\PaymentMethodService;
use App\Enums\BaseStatusEnum;

class PaymentController extends Controller
{
    protected $paymentMethodService;

    public function __construct(PaymentMethodService $paymentMethodService) {
        $this->paymentMethodService = $paymentMethodService;
    }
    public function index()
    {
        $user = Auth::user();
        // Phương thức hiện tại (có thể null)
        $currentMethod  = $user->paymentMethods->first();

        // Giá trị đã lưu (mảng) + old input nếu validate fail
        $savedValues    = $currentMethod?->pivot->details ?? [];
        $fieldValues    = old('fields', $savedValues);

        $paymentMethods = $this->paymentMethodService->getAll(['status', '=', BaseStatusEnum::PUBLISHED]);

        return view('backend.member_2.profile.payment', compact(
        'paymentMethods',      // Collection<PaymentMethod>
        'currentMethod',       // PaymentMethod|null
        'fieldValues'          // array
    ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'payment_method' => 'required',
            'fields.*' => 'required|string',
        ],[
            'payment_method.required' => 'Trường "Phương thức thanh toán" là bắt buộc',
            'fields.*' => 'Vui lòng không để trống bắt cứ trường nào',
        ]);

        $user = $request->user();

        if (empty($user->paymentMethod)) {
            $user->paymentMethod()->create(['payment_method_id' => $request->payment_method, 'details' => json_encode($request->fields)]);
        } else {
            $user->paymentMethod->payment_method_id = $request->payment_method;
            $user->paymentMethod->details = json_encode($request->fields);
            $user->paymentMethod->save();
        }

        return redirect()->back()->with('success', 'Cập nhật thanh toán thành công');
    }
}
