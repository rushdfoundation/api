<?php

namespace App\Http\Controllers\Admin\Notices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Noticboard;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{    
    function __construct()
    {
        $this->middleware(['permission:view_lookups'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:create_lookup'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:edit_lookup'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete_lookup'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if($user->hasRole('admin')){
            $data = Noticboard::query()->orderBy('created_at','DESC')->paginate(30);
        }else{
            $data = Noticboard::where('school_id',$user->school_id)->orderBy('created_at','DESC')->paginate(30);
        }
        return response()->json($data);
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
                'title'=> 'required',
                'description'=> 'required',
                'school_id'=>'required'
            ]);
            $data=Noticboard::create($request->all());
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
                'title'=> 'required',
                'description'=>'required',
            ]);
            $notice = Noticboard::find($id);
            $notice->title = $request->title;
            $notice->description = $request->description;
            $notice->link = $request->link;
            $notice->update();
            return response()->json($notice);
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
            $data = Noticboard::find($id);
            $data->delete();
            return response()->json($data);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);
        }
    }
}
