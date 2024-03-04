<?php
namespace App\Helpers;

use App\Models\Activity;

class ActivityHelper{
    static function add($activity){
        return Activity::create([
            'title' => $activity->title,
            'description' => $activity->description,
            'link' => $activity->link,
            'user_id' => $activity->user_id,
            'classroom_id' => $activity->classroom_id,
            'course_id' => $activity->course_id,
        ]);
    }
    static function edit($activity,$id){
        $ac = Activity::find($id);

        $ac->update([
            'title' => $activity->title,
            'description' => $activity->description,
            'link' => $activity->link,
        ]);
        return $ac;
    }
    static function get($id){
        return Activity::find($id);
    }
    static function delete($id){
        $ac = Activity::find($id);
        $ac->delete();
        return $ac;
    }
}