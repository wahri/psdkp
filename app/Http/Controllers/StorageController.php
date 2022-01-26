<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use App\Models\Room;
use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Store;

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

    public function locker(Room $room, Locker $locker)
    {
        dd($locker);
        return view('pages.storage.locker');
    }
}
