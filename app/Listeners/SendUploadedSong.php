<?php

namespace App\Listeners;

use App\Error;
use App\Events\SongUploaded;
use App\Models\Song;
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

        $song_r = new Song($song->toArray());

        $song_r->setConnection('mysql_r');
        $song_r->save();

        $song_r->artists()->attach($artists['singers'], ['type' => 1]);
        $song_r->artists()->attach($artists['music_directors'], ['type' => 2]);

        $song_r->artists()->attach($artists['song_writers'], ['type' => 3]);

        $song_r->artists()->attach($artists['producers'], ['type' => 4]);

        $client = new Client();
//        dd(config('app.radio_server'));
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
        ])->then(
            function (ResponseInterface $res) use ($song){
                $response = $res->getStatusCode();
                $song->hash_status = 3;
                $song->save();
            },
            function (RequestException $e){
                $message = $e->getMessage();
                $method = $e->getRequest()->getMethod();
                $error = new Error;
                $error->message = $message.", METHOD: ".$method;
                $error->save();
            }
        );

        $res = $promise->wait();
        /*$error = new Error;
        $error->message = $res;
        $error->save();*/



        $song->remote_file_path = "http://song-upload.osca.lk/storage/".$file_name;
        $song->save();


        $song_r->remote_file_path = "http://song-upload.osca.lk/storage/".$file_name;
        $song_r->save();

    }
}
