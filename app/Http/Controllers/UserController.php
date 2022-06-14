<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function index()
    {
        $users = User::all();
        return view('panel.pages.user.index', compact('users'));
    }

    public function create()
    {
        return view('panel.pages.user.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name'                  => 'required',
            'email'                 => 'required|email|unique:users',
            'phone'                 => 'required|numeric',
            'address'               => 'required',
            'password'              => 'required|confirmed',
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
            'password.confirmed'                 => 'Password dan konfirmasi password tidak sama',
            'password_confirmation.required'     => 'Konfirmasi password tidak boleh kosong',
        ];

        $this->validate($request, $rules, $messages);

        $data          = $request->except('_token', 'password_confirmation');
        $data['password'] = Hash::make($request->password);

        User::insert($data);
        
        return back()->with('success', 'Data Pengguna Berhasil di Tambah');
    }

    public function show($id)
    {
        $user = User::find($id);
        $rentals = Rental::with(['car'])->where('user_id', $id)->paginate(4);
        return view('panel.pages.user.show', compact('user', 'rentals'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('panel.pages.user.edit', compact('user'));
    }

    public function update(Request $request)
    {

        $user = User::find($request->id);

        if($user->email == $request->email){
            $emailRules = 'required|email';
        }else{
            $emailRules = 'required|email|unique:users';
        }

        if($request->password){
            $passwordRules = 'required|confirmed';
            $passwordConfirmationRules = 'required';
        }else{
            $passwordRules = '';
            $passwordConfirmationRules = '';
        }

        $rules = [
            'name'                  => 'required',
            'email'                 => $emailRules,
            'phone'                 => 'required|numeric',
            'address'               => 'required',
            'password'              => $passwordRules,
            'password_confirmation' => $passwordConfirmationRules
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
            'password.confirmed'                 => 'Password dan konfirmasi password tidak sama',
            'password_confirmation.required'     => 'Konfirmasi password tidak boleh kosong',
        ];

        $this->validate($request, $rules, $messages);

        $data          = $request->except('_token', 'password_confirmation');

        $data['password'] = $user->password;
        if($request->password){
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        
        return back()->with('success', 'Data Berhasil di Ubah');
    }

    public function destroy(Request $request)
    {
        User::find($request->id)->delete();
        return redirect()->route('panel.user.index')->with('success', 'Data Pengguna Berhasil di Hapus');
    }
}
