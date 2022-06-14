<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CarController extends Controller
{

    public function index()
    {
        $cars = Car::all();
        return view('panel.pages.car.index', compact('cars'));
    }

    public function create()
    {
        return view('panel.pages.car.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'type'  => 'required',
            'price' => 'required|numeric',
            'total' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg' 
        ];
        
        $messages = [
            'type.required'  => 'Jenis mobil tidak boleh kosong',
            'price.required' => 'Biaya rental tidak boleh kosong',
            'total.required' => 'Jumlah tersedia tidak boleh kosong',
            'price.numeric'  => 'Harga harus berupa angka',
            'total.numeric'  => 'Jumlah harus berupa angka',
            'image.required' => 'Gambar tidak boleh kosong',
            'image.image'    => 'Jenis file harus berupa gambar'
        ];

        $this->validate($request, $rules, $messages);

        $image         = $request->image;
        $imageName     = Str::random(8) . '_' . $image->getClientOriginalName();
        $image         = $image->move(public_path() . '/_images', $imageName);
    
        $data          = $request->except('_token', 'image');
        $data['image'] = $imageName;

        Car::create($data);
        
        return back()->with('success', 'Data Mobil Berhasil di Tambah');
        
    }

    public function show($id)
    {
        $car = Car::find($id);
        $rentals = Rental::with(['user'])->where('car_id', $id)->paginate(4);
        return view('panel.pages.car.show', compact('car', 'rentals'));
    }

    public function edit($id)
    {
        $car = Car::find($id);
        return view('panel.pages.car.edit', compact('car'));
    }

    public function update(Request $request)
    {
        $car = Car::find($request->id);

        $rules = [
            'type'  => 'required',
            'price' => 'required|numeric',
            'total' => 'required|numeric',
            'image' => $car->image == null ? 'required|image|mimes:jpeg,png,jpg,gif,svg' : ''
        ];
        
        $messages = [
            'type.required'  => 'Jenis mobil tidak boleh kosong',
            'price.required' => 'Biaya rental tidak boleh kosong',
            'total.required' => 'Jumlah tersedia tidak boleh kosong',
            'price.numeric'  => 'Harga harus berupa angka',
            'total.numeric'  => 'Jumlah harus berupa angka',
            'image.required' => 'Gambar tidak boleh kosong',
            'image.image'    => 'Jenis file harus berupa gambar'
        ];

        $this->validate($request, $rules, $messages);

        $imageName = $car->image;
        if($request->image){
            $oldImageName  = $imageName;

            $image         = $request->image;
            $imageName     = Str::random(8) . '_' . $image->getClientOriginalName();
            $image         = $image->move(public_path() . '/_images', $imageName);

            $oldImageName  = unlink(public_path('/_images/' . $oldImageName));
        }
        
        $data          = $request->except('_token', 'image');
        $data['image'] = $imageName;

        $car->update($data);
        
        return redirect()->route('panel.car.show', $request->id)->with('success', 'Data Mobil Berhasil di Ubah');
    }

    public function destroy(Request $request)
    {
        Car::find($request->id)->delete();
        return redirect()->route('panel.car.index')->with('success', 'Data Mobil Berhasil di Hapus');
    }

}
