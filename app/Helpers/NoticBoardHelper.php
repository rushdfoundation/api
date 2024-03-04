<?php
namespace App\Helpers;

use App\Models\Noticboard;

class NoticBoardHelper{
    static function add($notice){
        return Noticboard::create([
            'title' => $notice->title,
            'description' => $notice->description,
            'link' => $notice->link,
        ]);
    }
    static function edit($notice,$id){
        $not = Noticboard::find($id);
        $not->update([
            'title' => $notice->title,
            'description' => $notice->description,
            'link' => $notice->link,
        ]);
        return $not;
    }
    static function get($id){
        return Noticboard::find($id);
    }
    static function delete($id){
        $not = Noticboard::find($id);
        $not->delete();
        return $not;
    }
}