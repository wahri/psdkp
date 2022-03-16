<?php

namespace App\Http\Controllers;

use App\Models\DocumentArchive;
use App\Models\DocumentType;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $countDocumentType = DocumentType::count();
        $countDocument = DocumentArchive::count();

        return view('pages.dashboard.index', compact('countDocument', 'countDocumentType'));
    }
}
