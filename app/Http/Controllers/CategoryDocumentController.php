<?php

namespace App\Http\Controllers;

use App\Models\CategoryDocument;
use Illuminate\Http\Request;

class CategoryDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryDocument  $categoryDocument
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryDocument $categoryDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryDocument  $categoryDocument
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryDocument $categoryDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoryDocument  $categoryDocument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryDocument $categoryDocument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryDocument  $categoryDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryDocument $categoryDocument)
    {
        //
    }
}
