<?php

namespace App\Http\Controllers;

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

        /*return $request->hasFile('song')?"has file":"doesn't have file";
        return $request->file('song')->getClientOriginalName();*/

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


        if ($request->hasFile('song')){
            return response("has file!!!", 200);
            $file = $request->file('song');
            $file_name = $song->id.".".$file->getClientOriginalExtension();
            $file->storeAs('songs', $file_name, 'public');



            $client = new Client();
            $request = $client->post(config('app.radio_server'), [
                'multipart' => [
                    [
                        'name' => 'username',
                        'contents' => config('app.radio_username'),
                    ],
                    [
                        'name' => 'password',
                        'contents' => config('app.radio_password'),
                    ],
                    [
                        'name' => 'id',
                        'contents' => $song->id,
                    ],
                    [
                        'name' => 'song_file',
                        'contents' => fopen(storage_path('app/public/songs/').$file_name, 'r'),
                    ],
                ]
            ]);

            $song->file_path = "/storage/songs/".$file_name;
            $song->remote_file_path = "http://song-upload.osca.lk/storage/".$file_name;
            $song->save();

            $status = $request->getStatusCode();
            $response = $request->getBody();



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
