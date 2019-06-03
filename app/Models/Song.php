<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $guarded = ['id'];

    public function addedUser(){
        return $this->belongsTo('App\Models\User', 'added_by');
    }

    public function approvedUser(){
        return $this->belongsTo('App\Models\User', 'added_by');
    }

    public function artists(){
        return $this->belongsToMany('App\Models\Artist', 'song_artists')->withPivot('type');
    }

    public function singers(){
        return $this->artists()->wherePivot('type', '=', '1')->get();
    }

    public function musicians(){
        return $this->artists()->wherePivot('type', '=', '2')->get();
    }


    public function writers(){
        return $this->artists()->wherePivot('type', '=', '3')->get();
    }
}
