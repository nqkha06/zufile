<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\WithdrawRepositoryInterface as WithdrawRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Withdraw\StoreWithdrawRequest;
use App\Enums\InvoiceStatusEnum;
use App\Enums\BaseStatusEnum;
use App\Models\PaymentMethod;

class WithdrawController extends Controller
{
    protected $withdrawRepository;
    protected $userRepository;

    public function __construct(WithdrawRepository $withdrawRepository, UserRepository $userRepository) {
        $this->withdrawRepository = $withdrawRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        // Phương thức hiện tại (có thể null)
        $currentMethod  = $user->paymentMethods->first();

        // Giá trị đã lưu (mảng) + old input nếu validate fail
        $savedValues    = $currentMethod?->pivot->details ?? [];
        $fieldValues    = old('fields', $savedValues);

        $paymentMethods = PaymentMethod::query()
            ->where('status', BaseStatusEnum::PUBLISHED)
            ->get();

        $invoices = $this->withdrawRepository->getAllPaginated(['user_id' => $user->id]);

        $totalPending = $invoices->where('status', InvoiceStatusEnum::PENDING)->sum('amount');
        $totalReviewed = $invoices->where('status', InvoiceStatusEnum::REVIEWED)->sum('amount');
        $totalCompleted = $invoices->where('status', InvoiceStatusEnum::COMPLETED)->sum('amount');

        $invoices = $this->withdrawRepository->getAllPaginated(['user_id' => $user->id]);

        return view('backend.member_2.withdraw', compact('invoices',
     'totalPending', 'totalReviewed', 'totalCompleted',


    'paymentMethods',      // Collection<PaymentMethod>
        'currentMethod',       // PaymentMethod|null
        'fieldValues'
    ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWithdrawRequest $request)
    {
        $request->validated();
        // $type = $validated['type'] === 'fast' ? 1 : 0;
        $type = 0;
        $costs = $type === 1 ? 10 : 0;

        $user = $request->user();

        $paymentMethod = $user->paymentMethods()->first();
        if (!$paymentMethod) {
            return redirect()->back()->withErrors(__('member/message/withdraw.withdraw_need_payment_method'));
        }
        if ($paymentMethod->min_withdraw_amount > $user->balance) {
            return redirect()->back()->withErrors(__('member/message/withdraw.withdraw_min_amount', ['amount' => '$' . $paymentMethod->min_withdraw_amount]));
        }
        $data = [
            'amount' => $user->balance,
            'costs' => $costs,
            'type' => $type,
            'user_id' => $user->id,
            'payment_method' => $paymentMethod->name,
            'payment_details' => $paymentMethod->pivot->details,
        ];

        $withdraw = $this->withdrawRepository->create($data);

        $user->balance -= $user->balance;
        $user->balance = max($user->balance, 0);
        $user->save();

        $admin = $this->userRepository->findFirst(['id' => 2]);

        $templateMailAdmin = [
            'subject' => '[Link4Sub] Có yêu cầu rút tiền mới #'.$withdraw->id,
            'greeting' => 'Xin chào, ' . $admin->name . '!',
            'body' => '
                <p>Có một đơn rút mới, cần bạn xử lý..!</p>
                <p>- ID: '.$withdraw->id.'</p>
                <p>- Người yêu cầu rút: '.$withdraw->user->name.'</p>
                <p>- Số tiền: $'.$withdraw->amount.'</p>
                <p>- Kiểu rút: '.($withdraw->type == 1 ? 'Nhanh' : 'Bình thường').'</p>
                <p>- Ngày rút: '.$withdraw->created_at.'</p>
                <p>- Phương thức thanh toán: '.$withdraw->payment_method.'</p>
                <p>- Tài khoản thanh toán: '.($withdraw->payment_method == 'momo' ? 'Momo' : $withdraw->payment_bank_name).' - '.$withdraw->payment_account_number.' - '.$withdraw->payment_account_name.'</p>
                <p>Xem chi tiết tại <a href="'.url('/admin/invoices/').'" target="_blank">đây</a>.</p>
                <p>Trân trọng!</p>
            '
        ];
        $templateMailMember = [
            'subject' => '[Link4Sub] Yêu cầu rút tiền của bạn đang được xử lý',
            'greeting' => 'Xin chào, ' .$withdraw->user->name. '!',
            'body' => '
                <p>Chúng tôi đã nhận được yêu cầu rút tiền của bạn.</p>
                <p>- ID: '.$withdraw->id.'</p>
                <p>- Số tiền: $'.$withdraw->amount.'</p>
                <p>- Kiểu rút: '.($withdraw->type == 1 ? 'Nhanh' : 'Bình thường').'</p>
                <p>- Ngày rút: '.$withdraw->created_at.'</p>
                <p>- Phương thức thanh toán: '.$withdraw->payment_method.'</p>
                <p>- Tài khoản thanh toán: '.($withdraw->payment_method == 'momo' ? 'Momo' : $withdraw->payment_bank_name).' - '.$withdraw->payment_account_number.' - '.$withdraw->payment_account_name.'</p>
                <p>Link4Sub đang tiến hành xử lý yêu cầu của bạn.</p>
                <p>Trân trọng,</p>
                <p>Link4Sub</p>
            '
        ];

        // Mail::to($admin->email)->queue(new WithdrawNotification($templateMailAdmin));
        // Mail::to($withdraw->user->email)->queue(new WithdrawNotification($templateMailMember));

        return redirect()->back()->with('success', __('member/message/withdraw.withdraw_processing', ['amount' => '$'.$request->amount]));
    }
}
