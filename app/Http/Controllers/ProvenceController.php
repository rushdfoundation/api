<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provence;
class ProvenceController extends Controller
{
    public function index()
    {
        // Retrieve all Provence from the database
        $provence = Provence::all();

        // Return the data as a JSON response
        return response()->json($provence);
    }
}
