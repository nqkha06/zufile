<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Notifications\SendEmailNotification;
use Illuminate\Support\Facades\Mail;


class SendEmailController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository = null) {
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.admin.send-email.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string',
            'greeting' => 'string',
            'body' =>'required|string',
        ]);

        // $users = $this->userRepository->findMany(['email' => $request->email]);

        // if ($users->count() == 0) {
        //     return redirect()->back()->with('error', 'Email người dùng này không tồn tại trên hệ thống!');
        // }
        
        $subject = $request->subject;
        $greeting = $request->greeting;
        $body = $request->body;

        // foreach ($users as $user) {
        $replacements = [
            '{name}' => 'HThu06',
            '{email}' => 'hongthi2098@gmail.com'
        ];

        // $replacements = [
        //     '{name}' => $user->name,
        //     '{email}' => $user->email
        // ];

        $template = [
            'subject' => strtr($subject, $replacements),
            'greeting' => strtr($greeting, $replacements),
            'body' => strtr($body, $replacements)
        ];

        Mail::to($request->email)->queue(new SendEmailNotification($template));
        // }

        return redirect()->back()->with('success', 'Email đang được gửi...');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
