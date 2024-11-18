<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\UserPayment;
use App\Models\PaymentMethod;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentMethods = PaymentMethod::all();

        return view('backend.member.payment.index', compact('paymentMethods'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'payment_method' => 'required',
            'fields.*' => 'required|string',
        ], [
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

        return redirect()->back()->with('success', 'Cập nhật thanh toán thất bại, thử lại sau!');
    }
}
