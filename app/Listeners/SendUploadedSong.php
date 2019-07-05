<?php

namespace App\Listeners;

use App\Events\SongUploaded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use GuzzleHttp\Client;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

class SendUploadedSong implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SongUploaded  $event
     * @return void
     */
    public function handle(SongUploaded $event)
    {
        $song = $event->song;

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
        $song->remote_file_path = "http://song-upload.osca.lk/storage/".$file_name;

    }
}
