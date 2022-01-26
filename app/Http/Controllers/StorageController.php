<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Locker;
use App\Models\Rack;
use App\Models\Room;
use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Validator;

class StorageController extends Controller
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
        $data_ruangan = Room::with('lockers')->get();
        // dd($data_ruangan);
        return view('pages.storage.index', compact("data_ruangan"));
    }

    public function room($room_id)
    {
        $room = Room::find($room_id);
        $locker = Locker::where('room_id', $room_id)->with(['racks', 'racks.boxes'])->get();
        return view('pages.storage.room', compact('locker', 'room'));
    }

    public function StoreRoom(Request $request)
    {
        $result = [];
        $result['code'] = 400;

        $validation = Validator::make($request->all(), Room::$rules, Room::$messages);

        if (!$validation->fails()) {
            $saveRoom = Room::saveRoom($validation->validated());

            if ($saveRoom) {
                $result['message'] = "Berhasil menambahkan ruangan baru!";
                return response()->json($result, 200);
            }
        }


        $result['message'] = "{$validation->errors()->first()}";
        return response()->json($result, 400);

    }

    public function StoreLocker(Request $request, $id)
    {
        $result = [];
        $result['code'] = 400;

        $validation = Validator::make($request->all(), Locker::$rules, Locker::$messages);

        if (!$validation->fails()) {
            $saveLocker = Locker::saveLocker($validation->validated(), $id);

            if ($saveLocker) {
                $result['message'] = "Berhasil menambahkan locker baru!";
                return response()->json($result, 200);
            }
        }


        $result['message'] = "{$validation->errors()->first()}";
        return response()->json($result, 400);

    }

    public function StoreRack(Request $request)
    {
        $result = [];
        $result['code'] = 400;

        $validation = Validator::make($request->all(), Rack::$rules, Rack::$messages);


        if (!$validation->fails()) {
            $saveRack = Rack::saveRack($validation->validated());



            if ($saveRack) {
                $result['message'] = "Berhasil menambahkan rak baru!";
                return response()->json($result, 200);
            }
        }


        $result['message'] = "{$validation->errors()->first()}";
        return response()->json($result, 400);

    }

    public function StoreBox(Request $request)
    {
        $result = [];
        $result['code'] = 400;

        $validation = Validator::make($request->all(), Box::$rules, Box::$messages);


        if (!$validation->fails()) {
            $saveBox = Box::saveBox($validation->validated());



            if ($saveBox) {
                $result['message'] = "Berhasil menambahkan box baru!";
                return response()->json($result, 200);
            }
        }


        $result['message'] = "{$validation->errors()->first()}";
        return response()->json($result, 400);

    }


    public function locker(Room $room, Locker $locker)
    {
        dd($locker);
        return view('pages.storage.locker');
    }
}
