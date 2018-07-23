<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'Doctor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =
        [
            'id', 'password','name','lastname','country','user_name','profession','question_id','role','paypal_email'
        ];

    public function questions()
    {
        return $this->hasMany('App\Question');
    }
}
