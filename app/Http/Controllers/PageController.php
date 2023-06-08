<?php

namespace App\Http\Controllers;

use App\Models\Halaman;
use Illuminate\Http\Request;

class PageController extends Controller
{
    
    public function index(){

        $post = Halaman::all();

        // dd($post);

        return view('page', compact('post'));

    }

    public function edit($id)
    {
        $data = Halaman::where('id', $id)->first();
        return response()->json(['result' => $data]);
    }


}
