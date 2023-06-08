<?php

namespace App\Http\Controllers;

use App\Models\Halaman;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
     
    public function index(){

        $post = Halaman::all();
        // $posts = Halaman::take(3)->latest()->get();

        // dd($post);

        return view('gallery', compact('post'));

    }
}
