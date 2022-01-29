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

    public function showRoom($id)
    {
        $result = [];
        $result['code'] = 400;
        $result['message'] = "Data tidak di temukan!";


        $roomDetail = Room::getRoomDetail($id);

        if ($roomDetail->count() > 0) {
            $result['code'] = 200;
            $result['data'] = $roomDetail;
            $result['messages'] = "Berhasil mengambil data!";

            return response()->json($result, 200);
        }

        return response()->json($result, 400);
    }

    public function updateRoom(Request $request, $id)
    {
        $result = [];
        $result['code'] = 400;

        $validation = Validator::make($request->all(), Room::$updateRules, Room::$updateMessages);

        if (!$validation->fails()) {
            $saveRoom =  Room::updateRoom($validation->validated(), $id);

            if ($saveRoom) {
                $result['message'] = "Berhasil mengupdate ruangan!";
                return response()->json($result, 200);
            }
        }


        $result['message'] = "{$validation->errors()->first()}";
        return response()->json($result, 400);
    }

    public function destroyRoom($id)
    {
        $room = Room::find($id);
        $room->delete();

        $result['message'] = "Berhasil menghapus akun!";
        return response()->json($result, 200);


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

    public function showLocker($id)
    {
        $result = [];
        $result['code'] = 400;
        $result['message'] = "Data tidak di temukan!";


        $lockerDetail = Locker::getLockerDetail($id);

        if ($lockerDetail->count() > 0) {
            $result['code'] = 200;
            $result['data'] = $lockerDetail;
            $result['messages'] = "Berhasil mengambil data!";

            return response()->json($result, 200);
        }

        return response()->json($result, 400);
    }

    public function updateLocker(Request $request, $id)
    {
        $result = [];
        $result['code'] = 400;

        $validation = Validator::make($request->all(), Locker::$updateRules, Locker::$updateMessages);

        if (!$validation->fails()) {
            $saveLocker =  Locker::updateLocker($validation->validated(), $id);

            if ($saveLocker) {
                $result['message'] = "Berhasil mengupdate Locker!";
                return response()->json($result, 200);
            }
        }


        $result['message'] = "{$validation->errors()->first()}";
        return response()->json($result, 400);
    }

    public function destroyLocker($id)
    {
        $locker = Locker::find($id);
        $locker->delete();

        $result['message'] = "Berhasil menghapus locker!";
        return response()->json($result, 200);


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

    public function showRack($id)
    {
        $result = [];
        $result['code'] = 400;
        $result['message'] = "Data tidak di temukan!";


        $rackDetail = Rack::getRackDetail($id);

        if ($rackDetail->count() > 0) {
            $result['code'] = 200;
            $result['data'] = $rackDetail;
            $result['messages'] = "Berhasil mengambil data!";

            return response()->json($result, 200);
        }

        return response()->json($result, 400);
    }

    public function updateRack(Request $request, $id)
    {
        $result = [];
        $result['code'] = 400;

        $validation = Validator::make($request->all(), Rack::$updateRules, Rack::$updateMessages);

        if (!$validation->fails()) {
            $saveRack =  Rack::updateRack($validation->validated(), $id);

            if ($saveRack) {
                $result['message'] = "Berhasil mengupdate Rack!";
                return response()->json($result, 200);
            }
        }


        $result['message'] = "{$validation->errors()->first()}";
        return response()->json($result, 400);
    }

    public function destroyRack($id)
    {
        $rack = Rack::find($id);
        $rack->delete();

        $result['message'] = "Berhasil menghapus rack!";
        return response()->json($result, 200);


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

    public function showBox($id)
    {
        $result = [];
        $result['code'] = 400;
        $result['message'] = "Data tidak di temukan!";


        $boxDetail = Box::getBoxDetail($id);

        if ($boxDetail->count() > 0) {
            $result['code'] = 200;
            $result['data'] = $boxDetail;
            $result['messages'] = "Berhasil mengambil data!";

            return response()->json($result, 200);
        }

        return response()->json($result, 400);
    }

    public function updateBox(Request $request, $id)
    {
        $result = [];
        $result['code'] = 400;

        $validation = Validator::make($request->all(), Box::$updateRules, Box::$updateMessages);

        if (!$validation->fails()) {
            $saveBox =  Box::updateBox($validation->validated(), $id);

            if ($saveBox) {
                $result['message'] = "Berhasil mengupdate Box!";
                return response()->json($result, 200);
            }
        }


        $result['message'] = "{$validation->errors()->first()}";
        return response()->json($result, 400);
    }

    public function destroyBox($id)
    {
        $box = Box::find($id);
        $box->delete();

        $result['message'] = "Berhasil menghapus box!";
        return response()->json($result, 200);


    }



    public function locker(Room $room, Locker $locker)
    {
        dd($locker);
        return view('pages.storage.locker');
    }
}
