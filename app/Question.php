<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'Question';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =
        [
            'id','description','question','user_email','user_id','date_finish','status','date_add','answer_id'
        ];


    public function doctor()
    {
        return $this->belongsTo('App\User');
    }
    public function doctorName($id){
        $user = User::find($id);
        return $user->name;
    }
    public function answer()
    {
        return $this->hasOne('App\Answer');

    }

   public function uploadFile($file)
    {
        if($file->file == null) { return; }

        $filename = str_random(10) . '.' . $file->extension();
        $file->storeAs('/public/storage/question/', $filename);
        /*$this->file = $filename;*/
        /*$this->update();*/
    }

    public function removeFie()
    {
        if($this->file != null)
        {
            Storage::delete('uploads/' . $this->file);
        }
    }

    public function getFile()
    {
        if($this->file == null)
        {
            return '/file/no-file.pdf';
        }

        return '/uploads/' . $this->file;
    }
}

