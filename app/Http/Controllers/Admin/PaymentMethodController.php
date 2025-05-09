<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PaymentMethodService;
use App\Http\Requests\PaymentMethod\PaymentMethodFilterRequest;
use App\Http\Requests\PaymentMethod\UpdatePaymentMethodRequest;

class PaymentMethodController extends Controller
{
    protected $paymentMethodService;

    public function __construct(PaymentMethodService $paymentMethodService = null) {
        $this->paymentMethodService = $paymentMethodService;
    }
    

    public function index(PaymentMethodFilterRequest $request)
    {
        $filter = $request->validated();
        $methods = $this->paymentMethodService->getAllPaginated($filter);
        
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
    public function update(UpdatePaymentMethodRequest $request, string $id)
    {
        $request->validated();
        $method = $this->paymentMethodService->findOrFail($id);

        $fields = [];
        
        foreach ($request->fields as $field) {
            $fieldData = [
                'label' => $field['label'],
                'name' => $field['name'],
                'type' => $field['type'],
                'placeholder' => $field['placeholder'] ?? '',
            ];

            if ($field['type'] === 'select') {
                $fieldData['options'] = [];
                $lines = array_map('trim', explode("\n", $field['options']));

                $options = array_map(function($line) {
                    $parts = explode('|', $line, 2);

                    if (count($parts) === 2) {
                        return [
                            'value' => trim($parts[0]),
                            'label' => trim($parts[1]),
                        ];
                    }

                    return null;
                }, $lines);

                // remove null values
                $options = array_filter($options);
                // reset index
                $options = array_values($options);

                $fieldData['options'] = $options;
            }

            $fields[] = $fieldData;
        }

        $method->update([
            'name' => $request->name,
            'withdraw_fee' => $request->withdraw_fee,
            'min_withdraw_amount' => $request->min_withdraw_amount,
            'fields' => $fields,
            'status' => $request->status,
        ]);

        return redirect(route('admin.payment-methods.index'))->with('success', 'Phương thức <b>'.$request->name.'</b> cập nhật thành công!');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
