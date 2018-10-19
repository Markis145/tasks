<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];
//    protected $fillable = ['name','completed'];

    public function file()
    {
        return $this->hasOne(File::class);
    }

    public function assignFile(File $file)
    {
        //relaciona el id de file en el de tasques
        $file->task_id = $this->id;
        $file->save();
    }
}
