<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'Answer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =
        [
            'id','question_id','answer'
        ];



    public function question()
    {
    return $this->hasOne('App\Question');
    }
}
