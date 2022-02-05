<?php

namespace App\Http\Controllers;

use App\Models\DocumentArchive;
use App\Models\DocumentType;
use App\Models\InputFormat;
use Illuminate\Http\Request;

class ArchiveDocumentController extends Controller
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
        $document_type = DocumentType::all();
        return view('pages.archive.index', compact('document_type'));
    }

    public function showTypeDocument($documentType_id)
    {
        $typeDocument = DocumentType::find($documentType_id);
        $inputFormat = InputFormat::where('document_type_id', $documentType_id)->get();

        $listDocument = [
            "1" => [
                "title1" => "value11",
                "title2" => "value12",
                "title3" => "value13",
                "title4" => "value14",
                "title5" => "value15"
            ],
            "2" => [
                "title1" => "value21",
                "title2" => "value22",
                "title3" => "value23",
                "title4" => "value24",
                "title5" => "value25"
            ],
            "3" => [
                "title1" => "value31",
                "title2" => "value32",
                "title3" => "value33",
                "title4" => "value34",
                "title5" => "value35"
            ]
        ];

        // $query = "SELECT";
        // foreach ($inputFormat as $each) {
        //     $query .= " IF(input_format_id='" . $each['id'] . "', value, NULL)"  . " AS " . strtolower(str_replace(" ", "_", $each->name)) . ",";
        // }
        // $query .= "FROM ";

        $documentArchive = DocumentArchive::where('document_type_id', $documentType_id)->with('documentInfos')->get();

        return view('pages.archive.showTypeDocument', compact(['typeDocument', 'inputFormat', 'documentArchive']));
    }

    public function create($documentType_id)
    {
        $documentType = DocumentType::find($documentType_id);
        $inputFormat = InputFormat::where('document_type_id', $documentType_id)->get();
        return view('pages.archive.createDocument', compact(['documentType', 'inputFormat']));
    }
}
