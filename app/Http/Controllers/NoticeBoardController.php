<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Noticboard;

class NoticeBoardController extends Controller
{
    public function __invoke()
    {
        $lib = Noticboard::query()->paginate(30);
        return response()->json($lib);
    }

}
