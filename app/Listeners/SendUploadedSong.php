<?php

namespace App\Listeners;

use App\Error;
use App\Events\SongUploaded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use GuzzleHttp\Client;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

class SendUploadedSong /*implements ShouldQueue*/
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
        $file_name = $event->filename;
        $artists = $event->artists;

        $song->setConnection('mysql_r');
        $song->save();

        $song->artists()->attach($artists['singers'], ['type' => 1]);
        $song->artists()->attach($artists['music_directors'], ['type' => 2]);

        $song->artists()->attach($artists['song_writers'], ['type' => 3]);

        $song->artists()->attach($artists['producers'], ['type' => 4]);

        $client = new Client();
        $promise = $client->postAsync(config('app.radio_server'), [
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

        $promise->then(
            function (ResponseInterface $res) use ($song){
                $response = $res->getStatusCode();
                $song->setConnection('mysql');
                $song->hash_status = 3;
                $song->save();
                $song->setConnection('mysql_r');
            },
            function (RequestException $e){
                $message = $e->getMessage();
                $method = $e->getRequest()->getMethod();
                $error = new Error;
                $error->message = $message.", METHOD: ".$method;
                $error->save();
            }
        );




        $song->remote_file_path = "http://song-upload.osca.lk/storage/".$file_name;
        $song->save();

        $song->setConnection('mysql');
        $song->save();

    }
}
