<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempQuestion extends Model
{
    protected $table = 'Temp_Question';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =
        [
            'id','description','question','email','user_id','date_add'
        ];


    public function doctor()
    {
        return $this->belongsTo('App\User');
    }

    public function answer()
    {
        return $this->hasOne('App\Answer');
    }
}
