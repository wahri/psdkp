<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\DocumentArchive;
use App\Models\DocumentArchiveInfo;
use App\Models\DocumentType;
use App\Models\InputFormat;
use App\Models\Locker;
use App\Models\Rack;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

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

        // $query = "SELECT";
        // foreach ($inputFormat as $each) {
        //     $query .= " IF(input_format_id='" . $each['id'] . "', value, NULL)"  . " AS " . strtolower(str_replace(" ", "_", $each->name)) . ",";
        // }
        // $query .= "FROM ";

        $documentArchive = DocumentArchive::where('document_type_id', $documentType_id)->with('documentInfos')->get();

        return view('pages.archive.showTypeDocument', compact(['typeDocument', 'inputFormat', 'documentArchive']));
    }

    public function trashDocument($documentType_id)
    {
        $typeDocument = DocumentType::find($documentType_id);
        $inputFormat = InputFormat::where('document_type_id', $documentType_id)->get();

        // $query = "SELECT";
        // foreach ($inputFormat as $each) {
        //     $query .= " IF(input_format_id='" . $each['id'] . "', value, NULL)"  . " AS " . strtolower(str_replace(" ", "_", $each->name)) . ",";
        // }
        // $query .= "FROM ";

        $documentArchive = DocumentArchive::where('document_type_id', $documentType_id)->with('documentInfos')->onlyTrashed()->get();

        // dd($documentArchive);

        return view('pages.archive.showTrashTypeDocument', compact(['typeDocument', 'inputFormat', 'documentArchive']));
    }

    public function create($documentType_id)
    {
        $documentType = DocumentType::find($documentType_id);
        $inputFormat = InputFormat::where('document_type_id', $documentType_id)->get();
        $rooms = Room::all();
        return view('pages.archive.createDocument', compact(['documentType', 'inputFormat', 'rooms']));
    }

    public function storeDocument(Request $request)
    {
        $result = [];
        $result['code'] = 400;

        $data = $request->all();

        $fileDocument = $request->file('fileDocument');
        $fileName = time() . "_" . $fileDocument->getClientOriginalName();

        $uploadFolder = 'fileDocument';
        $fileDocument->move($uploadFolder, $fileName);

        // upload document
        $saveDocument = new DocumentArchive();
        $saveDocument->document_type_id = $data['document_type_id'];
        $saveDocument->room_id = $data['room_id'];
        $saveDocument->locker_id = $data['locker_id'];
        $saveDocument->rack_id = $data['rack_id'];
        $saveDocument->box_id = $data['box_id'];
        $saveDocument->file = $fileName;
        $saveDocument->save();

        // upload info document
        $documentInfo = [];
        for ($i = 0; $i < count($data['input_format_id']); $i++) {
            $getData["document_archive_id"] = $saveDocument->id;
            $getData["input_format_id"] = $data["input_format_id"][$i];
            $getData["value"] = $data["value"][$i];

            array_push($documentInfo, $getData);
        }
        $saveDocumentInfo = DocumentArchiveInfo::insert($documentInfo);

        if ($saveDocument && $saveDocumentInfo) {
            // $result['message'] = "Berhasil mendaftarkan user!";
            // response()->json($result, 200);

            return redirect()->route('dashboard.archive.show.document', ['documentType_id' => $data['document_type_id']]);
        }
    }

    public function edit($documentArchive_id)
    {
        $documentArchive = DocumentArchive::with(['documentInfos', 'documentInfos.inputFormat'])->find($documentArchive_id);

        // dd($documentArchive);
        $documentType = DocumentType::find($documentArchive->document_type_id);
        $inputFormat = InputFormat::where('document_type_id', $documentArchive->document_type_id)->get();

        $rooms = Room::all();
        $lockers = Locker::where('room_id', $documentArchive->room_id)->get();
        $racks = Rack::where('locker_id', $documentArchive->locker_id)->get();
        $boxes = Box::where('rack_id', $documentArchive->rack_id)->get();

        return view('pages.archive.editDocument', compact(['documentType', 'inputFormat', 'rooms', 'lockers', 'racks', 'boxes', 'documentArchive']));
    }

    public function updateDocument(Request $request)
    {
        $result = [];
        $result['code'] = 400;

        $data = $request->all();
        $fileDocument = $request->file('fileDocument');

        $documentArchive = DocumentArchive::findOrFail($data['document_archive_id']);

        // dd($documentArchive);

        if (!empty($fileDocument)) {
            File::delete("fileDocument/" . $documentArchive->file);
            $fileName = time() . "_" . $fileDocument->getClientOriginalName();
            $uploadFolder = 'fileDocument';
            $fileDocument->move($uploadFolder, $fileName);

            $documentArchive->file = $fileName;
        }
        $documentArchive->room_id = $data['room_id'];
        $documentArchive->locker_id = $data['locker_id'];
        $documentArchive->rack_id = $data['rack_id'];
        $documentArchive->box_id = $data['box_id'];
        $documentArchive->save();

        for ($i = 0; $i < count($data['input_format_id']); $i++) {
            $documentArchiveInfo = DocumentArchiveInfo::findOrFail($data['input_format_id'][$i]);
            $documentArchiveInfo->value = $data['value'][$i];
            $documentArchiveInfo->save();
        }


        return redirect()->route('dashboard.archive.show.document', ['documentType_id' => $data['document_type_id']]);
    }

    public function deleteDocument($documentArchive_id)
    {
        $document = DocumentArchive::findOrFail($documentArchive_id);
        $document->delete();

        return redirect()->route('dashboard.archive.show.document', ['documentType_id' => $document->document_type_id]);
    }

    public function getLockersByRoomID($room_id)
    {
        $result = [];
        $result['code'] = 400;
        $result['message'] = "Data tidak di temukan!";

        $lockers = Locker::where('room_id', $room_id)->get();

        if ($lockers->count() > 0) {
            $result['code'] = 200;
            $result['data'] = $lockers;
            $result['messages'] = "Berhasil mengambil data!";

            return response()->json($result, 200);
        }

        return response()->json($result, 400);
    }

    public function getRacksByLockerID($locker_id)
    {
        $result = [];
        $result['code'] = 400;
        $result['message'] = "Data tidak di temukan!";

        $racks = Rack::where('locker_id', $locker_id)->get();

        if ($racks->count() > 0) {
            $result['code'] = 200;
            $result['data'] = $racks;
            $result['messages'] = "Berhasil mengambil data!";

            return response()->json($result, 200);
        }

        return response()->json($result, 400);
    }
    public function getBoxesByRackID($rack_id)
    {
        $result = [];
        $result['code'] = 400;
        $result['message'] = "Data tidak di temukan!";

        $boxes = Box::where('rack_id', $rack_id)->get();

        if ($boxes->count() > 0) {
            $result['code'] = 200;
            $result['data'] = $boxes;
            $result['messages'] = "Berhasil mengambil data!";

            return response()->json($result, 200);
        }

        return response()->json($result, 400);
    }
}
