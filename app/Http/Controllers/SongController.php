<?php

namespace App\Http\Controllers;

use App\Events\SongUploaded;
use App\Models\Artist;
use App\Models\Song;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

class SongController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        return config('app.radio_username')." ".config('app.radio_password');
        $songs = Song::all();
        return view('songs.index', ['songs' => $songs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $songs = Song::all();
        $artists = Artist::all();
        return view('songs.create', ['songs' => $songs, 'artists' => $artists]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $song = new Song;
        $song->title = $request->input('title');
        $song->details = $request->input('details');
        $song->released_at = $request->input('released_at');
        $song->added_by = auth()->user()->id;
        if (auth()->user()->isAdmin()){
            $song->approved_by = auth()->user()->id;
        }
        $song->save();

        $song->artists()->attach($request->input('singers'), ['type' => 1]);
        $song->artists()->attach($request->input('music_directors'), ['type' => 2]);

        $song->artists()->attach($request->input('song_writers'), ['type' => 3]);

        $song->artists()->attach($request->input('producers'), ['type' => 4]);

        $artists = array();
        $artists['singers'] = $request->input('singers');
        $artists['music_directors'] = $request->input('music_directors');
        $artists['song_writers'] = $request->input('song_writers');
        $artists['producers'] = $request->input('producers');


        if ($request->hasFile('song')){
            $file = $request->file('song');
            $file_name = $song->id.".".$file->getClientOriginalExtension();
            $file->storeAs('songs', $file_name, 'public');

            $song->file_path = "/storage/songs/".$file_name;

            $song->save();

            event(new SongUploaded($song, $file_name, $artists));

            /*$song->setConnection('mysql_r');
            $song->save();*/

            /*$song->artists()->attach($request->input('singers'), ['type' => 1]);
            $song->artists()->attach($request->input('music_directors'), ['type' => 2]);

            $song->artists()->attach($request->input('song_writers'), ['type' => 3]);

            $song->artists()->attach($request->input('producers'), ['type' => 4]);*/

            /*$status = $request->getStatusCode();
            $response = $request->getBody();*/



            return response("Successfully Uploaded the song", 200);
        }





    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function show(Song $song)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function edit(Song $song)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Song $song)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function destroy(Song $song)
    {
        //
    }
}
