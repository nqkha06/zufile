<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\UserWithdraw as Invoice;
use App\Models\Plan;

class HomeController extends Controller
{
public function index(Request $request) {
        $plans = Plan::orderBy('price')->get();


        return view('clients.landing-page', compact('plans'));
    }

    public function paymentProof() {
        $invoices = Invoice::paginate();
        return view('clients.payment-proof', compact('invoices'));
    }


}
