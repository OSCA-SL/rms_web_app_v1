<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function songs(){
        return $this->belongsToMany('App\Models\Artist', 'song_artists')->withPivot('type');
    }

    public function sang()
    {
        return $this->songs()->wherePivot('type', '=', '1')->get();
    }

    public function music()
    {
        return $this->songs()->wherePivot('type', '=', '2')->get();
    }

    public function wrote()
    {
        return $this->songs()->wherePivot('type', '=', '3')->get();
    }


}
