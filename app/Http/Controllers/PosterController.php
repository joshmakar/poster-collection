<?php

namespace App\Http\Controllers;

use App\Poster;
use Illuminate\Http\Request;
use Auth;

class PosterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posters = Poster::all();

        return view('posters.index')->with(['posters' => $posters]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'width' => 'required',
            'height' => 'required',
            'orientation' => 'required',
            'posterImage' => 'mimes:jpeg,jpg,png|required|max:10000'
        ]);

        if ($request->hasFile('posterImage')) {
            $filenameWithExt = $request->file('posterImage')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
           // Get just ext
            $extension = $request->file('posterImage')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
          // Upload Image
            $path = $request->file('posterImage')-> storeAs('public/poster_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $posterDetails = $request->all();

        $posterDetails['user_id'] = Auth::id();

        $posterDetails['image_url'] = $fileNameToStore;

        $poster = Poster::create($posterDetails);

        return ['redirect' => route('posters.index')];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Poster  $poster
     * @return \Illuminate\Http\Response
     */
    public function show(Poster $poster)
    {
        return view('posters.show')->with(['poster' => $poster]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Poster  $poster
     * @return \Illuminate\Http\Response
     */
    public function edit(Poster $poster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Poster  $poster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poster $poster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Poster  $poster
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poster $poster)
    {
        //
    }
}
