<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\PaymentMethodServiceInterface as PaymentMethodService;

class PaymentMethodController extends Controller
{
    protected $paymentMethodService;

    public function __construct(PaymentMethodService $paymentMethodService = null) {
        $this->paymentMethodService = $paymentMethodService;
    }
    

    public function index()
    {
        $methods = $this->paymentMethodService->listAllPaginated([]);
        
        return view('backend.admin.payment-method.index', compact('methods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.payment-method.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'fields.*.name' => 'required|string',
            'fields.*.key' => 'required|string',
            'withdraw_fee' => 'required|numeric|min:0',
            'min_withdraw_amount' => 'required|numeric|min:0',
        ]);
        $created = $this->paymentMethodService->create([
            'name' => $validated['name'],
            'fields' => json_encode($validated['fields']),
            'withdraw_fee' => $validated['withdraw_fee'],
            'min_withdraw_amount' => $validated['min_withdraw_amount'],
        ]);
        if ($created) {
            return redirect()->route('admin.payment-methods.index')->with('success', 'Phương thức thanh toán đã được thêm.');
        }
        return redirect()->route('admin.payment-methods.index')->with('error', 'Thêm phương thức thanh toán thất bại, thử lại sau!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $method = $this->paymentMethodService->findOrFail($id);

        return view('backend.admin.payment-method.edit', compact('method'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'fields.*.name' => 'required|string',
            'fields.*.key' => 'required|string',
            'withdraw_fee' => 'required|numeric|min:0',
            'min_withdraw_amount' => 'required|numeric|min:0',
            'status' => 'required',
        ]);
    
        $updated = $this->paymentMethodService->update($id, [
            'name' => $validated['name'],
            'fields' => json_encode($validated['fields']),
            'withdraw_fee' => $validated['withdraw_fee'],
            'min_withdraw_amount' => $validated['min_withdraw_amount'],
            'status' => $validated['status'],
        ]);

        if ($updated) return redirect(route('admin.payment-methods.index'))->with('success', 'Phương thức <b>'.$request->name.'</b> cập nhật thành công!');
        
        return redirect(route('admin.payment-methods.index'))->with('error', 'Cập nhật thất bại, hãy thử lại sau!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
