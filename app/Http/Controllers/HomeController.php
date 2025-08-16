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

    public function reportStore(Request $request) {
        $request->validate([
            'url' => 'required|url|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);
        $alias = basename(parse_url($request->url, PHP_URL_PATH));

        $check = \App\Models\File::where('alias', $alias)->first();
        if (!$check) {
            return redirect()->route('report')->withErrors(__('File not found.'));
        }
        $report = new \App\Models\Report();
        $report->file_id = $check->id;
        $report->name = $request->name;
        $report->email = $request->email;
        $report->message = $request->message;
        $report->save();

        return redirect()->route('report')->with('success', __('Report submitted successfully.'));
    }

}
