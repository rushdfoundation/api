<?php

namespace App\Http\Controllers\Admin\Library;

use App\Helpers\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\Library;
use Exception;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:view_libraries'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:create_library'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:edit_library'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete_library'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lib = Library::query()->paginate(30);
        return response()->json($lib);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'book_name'=> $request->book_name,
                'book_description'=>$request->book_description,
                'author'=>$request->author,
                'publisher'=>$request->publisher,
                'publish_year'=>$request->publish_year
            ]);
            $data=Library::create($request->all());
            return response()->json($data);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $request->validate([
                'book_name'=> $request->book_name,
                'book_description'=>$request->book_description,
                'author'=>$request->author,
                'publisher'=>$request->publisher,
                'publish_year'=>$request->publish_year
            ]);
            $library = Library::find($id);
            $data=$library->update($request->all());
            return response()->json($data);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $data = Library::find($id);
            $data->delete();
            return response()->json($data);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);
        }
    }
}
