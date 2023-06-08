<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use App\Models\Bank;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PesanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Tiket::get();
        $payment = Bank::get();

        // dd($post);

        return view('pesan', compact('post', 'payment'));

    }

    public function tampil()
    {
        $data = Penjualan::latest()->limit(3)->get();
        $data2 = Tiket::latest()->get();
        $data3 = Bank::latest()->get();

        // dd($post);

        return response()->json(['data' => $data,'data2' => $data2, 'data3' => $data3 ]);


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    
     
     $create  =  Penjualan::create([
            'email_pelanggan'     => $request->email_pelanggan,
            'nama_pelanggan'     => $request->nama_pelanggan,
            'hp_pelanggan'     => $request->hp_pelanggan,
            'tiket_id'     => $request->tiket_id,
            'kuantiti'     => $request->kuantiti,
            'bank_id'     => $request->bank_id,
        ]);

        if($create){
            Session::flash('sukses', 'Pembelian tiket berhasil .');
        }else{
            echo"Pemesanan Gagal";
        }
        
        return redirect()->route('pesan');
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
