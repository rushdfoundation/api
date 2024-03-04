<?php
namespace App\Helpers;

use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceHelper{
    static function add($userId){
        return Attendance::create([
            'user_id' => $userId,
            'present' =>true,
            'date' => Carbon::now()
        ]);
    }
    static function remove($id){
        $at = Attendance::find($id);
        $at->delete();
        return $at;
    }
    static function get($id){
        return Attendance::find($id);
    }
}