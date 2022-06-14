<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Carbon\Carbon; 
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PanelController extends Controller
{
    public function plain()
    {
        return view('panel.pages.plain');
    }
    public function index()
    {
        return view('panel.pages.index');
    }

    public function login()
    {
        if ($user = auth()->user()) {
            if ($user->level == 'admin') {
                return redirect()->intended('admin');
            } elseif ($user->level == 'customer') {
                return redirect()->intended('customer');
            }
        }
        return view('panel.pages.auth.login');
    }

    public function loginProcess(Request $request)
    {
        $rules = [
            'email'      => 'required',
            'password'      => 'required'
        ];

        $messages = [
            'email.required'     => 'Email tidak boleh kosong',
            'password.required'     => 'Password tidak boleh kosong',
        ];

        $this->validate($request, $rules, $messages);

        $remember = $request->has('remember') ? true : false;

        $data = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
        ];

        auth()->attempt($data, $remember);

        if (auth()->check()) {
            if (auth()->user()->level == 'customer') {
                redirect()->route('main.index');
            }
            return redirect()->route('panel.index');
        } else {
            return redirect()->back()->withInput()->withErrors(['error' => 'Email atau password salah!']);
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('panel.login');
    }

    //Forgot/Reset Password Start
    public function forgetPassword()
    {
        return view('panel.pages.auth.forgetPassword');
    }

    public function forgetPasswordProcess(Request $request)
    {
        $rules = [
            'email'      => 'required|email|exists:users',
        ];

        $messages = [
            'email.required'     => 'Email wajib diisi',
            'email.email'        => 'Format email salah',
            'email.exists' => 'Email tidak ditemukan'
        ];

        $this->validate($request, $rules, $messages);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        
        Mail::send('main.pages.auth.resetPasswordMail', ['token' => $token, 'email' => $request->email ], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Kata Sandi');
        });

        return back()->with('success', 'Link reset password telah dikirim ke email anda');
    }

    public function resetPassword($email, $token)
    {
        return view('panel.pages.auth.resetPassword', ['email' => $email, 'token' => $token]);
    }

    public function resetPasswordProcess(Request $request)
    {
        $rules = [
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ];

        $messages = [
            'password.required'     => 'Password tidak boleh kosong',
            'password.min'        => 'Password minimal 6 karakter',
            'password.confirmed' => 'Password tidak sama dengan konfirmasi password',
            'password_confirmation.required' => 'Konfirmasi password tidak boleh kosong'
        ];

        $this->validate($request, $rules, $messages);

        $request->validate([
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
        // dd($request);
        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Token tidak valid!');
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect()->route('panel.login')->with('success', 'Password berhasil diubah, silakan login');
    }
}
