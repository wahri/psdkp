<?php

namespace Database\Seeders;

use App\Models\Box;
use App\Models\Rack;
use App\Models\Room;
use App\Models\Locker;
use App\Models\Storage;
use Illuminate\Database\Seeder;

class StorageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create superadmin user
        // $storage = new Storage();
        // $storage->ruang = "Ruang 1";
        // $storage->locker = "A01";
        // $storage->rak = "AA01";
        // $storage->box = "BX01";
        // $storage->save();


        for ($i = 1; $i <= 3; $i++) {
            $room = new Room();
            $room->name = "Ruang $i";
            $room->save();
            for ($j = 1; $j <= 4; $j++) {
                $locker = new Locker();
                $locker->code = "LCK0$j";
                $locker->room_id = $room->id;
                $locker->save();
                for ($k = 1; $k <= 4; $k++) {
                    $rack = new Rack();
                    $rack->code = "LCK0{$j}RK0$k";
                    $rack->locker_id = $locker->id;
                    $rack->save();
                    for ($l = 1; $l <= 2; $l++) {
                        $box = new Box();
                        $box->code = "BX0$k";
                        $box->rack_id = $rack->id;
                        $box->save();
                    }
                }
            }
        }
    }
}
