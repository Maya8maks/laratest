<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{


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
