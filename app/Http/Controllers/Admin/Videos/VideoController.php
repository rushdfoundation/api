<?php

namespace App\Http\Controllers\Admin\Videos;

use App\Http\Controllers\Controller;
use Dawson\Youtube\Facades\Youtube;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class VideoController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:view_videos'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:create_video'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:edit_video'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete_video'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        return view('video');
        // $keywords = "*";
        // $part = 'snippet';
        // $channelId = 'UCP_k-0re1W2lrIY59RW_VpA';
        // $country = 'AF';
        // $apiKey = Config::get('services.youtube.api_key');
        // $endPoint = Config::get('services.youtube.search_endpoint');
        // $maxResults = 12;
        // $type = 'video,playlist,channel';
        // $url = "$endPoint?part=$part&maxResults=$maxResults&channelId=$channelId&regionCode=$country&type=$type&key=$apiKey&q=$keywords";
        // $res = Http::get($url);
        // $results = json_decode($res);
        // return response()->json($results);
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
        $video = Youtube::upload($request->file('video')->getPathName(), [
            'title'       => $request->input('title'),
        ]);
        return view('video');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
