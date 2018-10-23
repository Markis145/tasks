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
//        return $this->hasOne('App\Class');
    }
    public function assignFile(File $file)
    {
        $file->task_id = $this->id;
        $file->save();
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function addTag($tag)
    {
        $this->tags()->save($tag);
    }
    public function addTags(array $tags)
    {
        $this->tags()->saveMany($tags);
    }
    public function assignUser(User $user)
    {
        $this->user()->associate($user);
        $this->save();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}