<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request; 
use Carbon\Carbon; 
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('main.pages.index', compact('cars'));
    }

    public function carList(){
        $cars = Car::all();
        return view('main.pages.carList', compact('cars'));
    }

    public function history(){
        $id = auth()->user()->id;
        $rentals = Rental::with(['car'])->where('user_id', $id)->get();
        $cars = Car::all();
        return view('main.pages.history', compact('rentals', 'cars'));
    }

    public function rentalBarProcess(Request $request){
        $rules = [
            'bar_start_date' => 'required',
            'bar_end_date'   => 'required',
            'bar_car_id'     => 'required'
        ];

        $messages = [
            'bar_start_date.required' => 'Tanggal mulai rental tidak boleh kosong',
            'bar_end_date.required'   => 'Tanggal selesai rental tidak boleh kosong',
            'bar_car_id.required'     => 'Mobil wajib dipilih'
        ];

        $this->validate($request, $rules, $messages);

        $id = $request->bar_car_id;
        $startDate = $request->bar_start_date;
        $endDate = $request->bar_end_date;

        return redirect()->route('main.rental', $id)->with(['startDate' => $startDate, 'endDate' => $endDate]);
    }

    public function rental($id){
        $car = Car::find($id);
        $cars = Car::all();
        return view('main.pages.rental', compact('car', 'cars'));
    }

    public function rentalProcess(Request $request){
        $rules = [
            'start_date' => 'required',
            'end_date'   => 'required'
        ];

        $messages = [
            'start_date.required' => 'Tanggal mulai rental tidak boleh kosong',
            'end_date.required'   => 'Tanggal selesai rental tidak boleh kosong'
        ];

        $this->validate($request, $rules, $messages);

        $user = Auth::user();
        $startDate = date('Y-m-d', strtotime($request->start_date));
        $endDate = date('Y-m-d', strtotime($request->end_date));
        Rental::create([
            'start_date' => $startDate,
            'end_date'   => $endDate,
            'car_id'     => $request->car_id,
            'user_id'    => $user->id
        ]);

        return redirect()->route('main.history')->with('success', 'Rental Berhasil. Lakukan pembayaran saat pengambilan mobil');
    }


    public function profil(){
        return view('main.pages.profil');
    }


    public function changePassword(Request $request){

        $rules = [
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ];

        $messages = [
            'password.required'                  => 'Password tidak boleh kosong',
            'password.confirmed'                 => 'Password dan konfirmasi password tidak sama',
            'password.min'                       => 'Minimal 6 karakter',
            'password_confirmation.required'     => 'Konfirmasi password tidak boleh kosong',
        ];

        $this->validate($request, $rules, $messages);

        $data = [
            'password'     => Hash::make($request->password)
        ];

        User::where('id', auth()->user()->id)->update($data);

        return back()->with(['success' => 'Password berhasil diubah']);
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
        return view('main.pages.auth.login');
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
            return redirect()->route('main.index');
        } else {
            return redirect()->back()->with(['error' => 'Email atau password salah!']);
        }
    }

    public function logout()
    {
        session()->flush();
        auth()->logout();
        return redirect()->route('main.login');
    }

    public function register(){
        return view('main.pages.auth.register');
    }

    public function registerProcess(Request $request){

        $rules = [
            'name'                  => 'required',
            'email'                 => 'required|email|unique:users',
            'phone'                 => 'required|numeric',
            'address'               => 'required',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ];

        $messages = [
            'name.required'                      => 'Nama tidak boleh kosong',
            'email.required'                     => 'Email tidak boleh kosong',
            'email.email'                        => 'Email tidak valid',
            'email.unique'                       => 'Email telah terdaftar',
            'phone.required'                     => 'Nomor HP tidak boleh kosong',
            'phone.numeric'                      => 'Nomor HP berupa angka',
            'address.required'                   => 'Alamat tidak boleh kosong',
            'password.required'                  => 'Password tidak boleh kosong',
            'password.min'                       => 'Password minimal 6 karakter',
            'password.confirmed'                 => 'Password dan konfirmasi password tidak sama',
            'password_confirmation.required'     => 'Konfirmasi password tidak boleh kosong',
        ];

        $this->validate($request, $rules, $messages);

        $data          = $request->except('_token', 'password_confirmation');
        $data['password'] = Hash::make($request->password);
        $data['level'] = 'customer';

        $user          = User::insert($data);

        if ($user) {
            return redirect()->route('main.login')->with(['success' => 'Pendaftaran berhasil, silakan login', 'email' => $request->email ]);
        } else {
            return redirect()->back()->withInput()->with(['error' => 'Pendaftaran gagal, silakan hubungi admin']);
        }
    }

    //Forgot/Reset Password Start
    public function forgetPassword()
    {
        return view('main.pages.auth.forgetPassword');
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
        return view('main.pages.auth.resetPassword', ['email' => $email, 'token' => $token]);
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

        return redirect()->route('main.login')->with('success', 'Password berhasil diubah, silakan login');
    }
}
