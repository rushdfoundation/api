<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Library;
use App\Models\Teacher;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke()
    {
        $lib = Library::query()->paginate(30);
        return response()->json($lib);
    }
}
