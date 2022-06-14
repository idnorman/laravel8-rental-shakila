<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rentals = Rental::with(['user', 'car'])->get();
        
        return view('panel.pages.rental.index', compact('rentals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cars = Car::all();
        $users = User::all();
        
        return view('panel.pages.rental.create', compact('cars', 'users' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
          'user_id' => 'required',
          'car_id'  => 'required'
        ];

        $messages = [
            'user_id.required' => 'Kustomer tidak boleh kosong',
            'car_id.required'  => 'Mobil tidak boleh kosong'
        ];

        $this->validate($request, $rules, $messages);
    
        $rentalDate = explode(' - ', $request->rental_date);

        $startDate = date('Y-m-d', strtotime($rentalDate[0]));
        $endDate   = date('Y-m-d', strtotime($rentalDate[1]));
    
        $data = $request->except('_token', 'rental_date');
        $data['start_date'] = $startDate;
        $data['end_date']   = $endDate;
        // dd($data);
        Rental::create($data);
        
        return redirect()->route('panel.rental.index')->with('success', 'Rental berhasil dibuat');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rental = Rental::with(['user', 'car'])->where('id', $id)->first();
        $car = Car::find($rental->car_id);
        return view('panel.pages.rental.show', compact('rental', 'car'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cars = Car::all();
        $users = User::all();
        $rental = Rental::with(['user', 'car'])->where('id', $id)->first();
        
        return view('panel.pages.rental.edit', compact('cars', 'users', 'rental'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = [
            'user_id' => 'required',
            'car_id'  => 'required'
        ];
  
        $messages = [
              'user_id.required' => 'Kustomer tidak boleh kosong',
              'car_id.required'  => 'Mobil tidak boleh kosong'
        ];
  
        $this->validate($request, $rules, $messages);
      
        $rentalDate = explode(' - ', $request->rental_date);
  
          $startDate = formatDate($rentalDate[0], 'Y-m-d');
          $endDate = formatDate($rentalDate[1], 'Y-m-d');
          
          $data = $request->except('_token', '_method', 'rental_date', 'return_date');

          if($request->return_date != '1970-01-01'){
            $data['return_date'] = formatDate($request->return_date, 'Y-m-d');
          }
          
          $data['start_date'] = $startDate;
          $data['end_date']   = $endDate;
          // dd($data);
          Rental::where('id', $request->id)->update($data);
          
          return redirect()->route('panel.rental.index')->with('success', 'Data Rental berhasil diubah');
          
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Rental::find($request->id)->delete();
        return redirect()->route('panel.rental.index')->with('success', 'Data Rental Berhasil di Hapus');
    }

    public function statusUpdate(Request $request){
        
        Rental::where('id', $request->id)->update(['status' => $request->status]);

        return back()->with('success', 'Status berhasil diubah');

    }
    public function returnDateUpdate(Request $request){

        $date = date('Y-m-d', strtotime($request->return_date));
        
        Rental::where('id', $request->id)->update(['return_date' => $date, 'status' => 'success']);

        return back()->with('success', 'Tanggal kembali berhasil diubah');

    }

}
