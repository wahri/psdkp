<?php

namespace App\Http\Controllers;

use App\Models\DocumentArchive;
use App\Models\DocumentArchiveInfo;
use App\Models\DocumentType;
use App\Models\InputFormat;
use Illuminate\Http\Request;
use League\CommonMark\Block\Element\Document;

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
    public function index()
    {
        $documentTypeAll = DocumentType::all();

        if(request()->exists('search')){
            $documentInfoGroup = DocumentArchiveInfo::select('document_archive_id')->where('value', 'like', '%' . request('search') . '%')->groupBy('document_archive_id')->get();
            $documentInfo = DocumentArchiveInfo::select('document_archive_id')->where('value', 'like', '%' . request('search') . '%')->get();

            $arrDocumentId = [];
            foreach($documentInfoGroup as $docInfo){
                $arrDocumentId[] = $docInfo->document_archive_id;
            }
            
            if(request()->exists('kategori') && request('kategori') != "All"){
                $documentArchiveGroup = DocumentArchive::select('document_type_id')->where('document_type_id', request('kategori'))->whereIn('id', $arrDocumentId)->groupBy('document_type_id')->get();
                $documentArchive = DocumentArchive::with('documentInfos')->where('document_type_id', request('kategori'))->whereIn('id', $arrDocumentId)->get();
            }else{
                $documentArchiveGroup = DocumentArchive::select('document_type_id')->whereIn('id', $arrDocumentId)->groupBy('document_type_id')->get();
                $documentArchive = DocumentArchive::with('documentInfos')->whereIn('id', $arrDocumentId)->get();
            }

            $arrDocumentTypeId = [];
            foreach($documentArchiveGroup as $docArchiveInfo){
                $arrDocumentTypeId[] = $docArchiveInfo->document_type_id;
            }
            $getDocumentType = DocumentType::with(['input_format'])->whereIn('id', $arrDocumentTypeId)->get();

            // $documentType = DocumentType::with('document_archives')->get();

            // dd($documentArchive);
            return view('home', compact(['documentTypeAll', 'documentInfo', 'documentArchive', 'getDocumentType']));
        }

        return view('home', compact(['documentTypeAll']));
    }
}
