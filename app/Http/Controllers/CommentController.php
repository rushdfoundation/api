<?php

namespace App\Http\Controllers;

use App\Helpers\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
                'comment_text'=>'required',
                'lecture_id'=>'required'
            ]);
            $comment = Comment::create([
                'comment_text'=>$request->text,
                'lecture_id'=>$request->lecture_id,
                'user_id'=>Auth::id(),
            ]);
            return response()->json($comment);
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
                'comment_text'=>'required'
            ]);
            $comment = Comment::find($id);
            $comment->update([
                'comment_text'=>$request->text,
            ]);
            return response()->json($comment);
        }catch(Exception $e){
            return ExceptionHelper::handle($e);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
