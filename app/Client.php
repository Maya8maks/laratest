<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'Client';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =
        [
            'id', 'name','lastname','email','nickname','facebook_id','github_id','google_id','twitter_id','linkedin_id'
        ];
}
