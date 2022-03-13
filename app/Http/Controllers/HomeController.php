<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($kategori = "all", $kolom = "all", $keyword = "all")
    {
        if($kategori != "all"){
            $document_type = DocumentType::with("input_format")->find($kategori);
        }else{
            $document_type = DocumentType::all();
        }

        // dd($document_type);

        return view('home', compact(['document_type']));
    }
}
