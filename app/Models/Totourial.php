<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Totourial extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'tips', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function addTask($body)
    {
        $task = $this->tasks()->create($body);

        $this->createActive('create_without_complete_task', $this->id);

        return $task;
    }

    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

    public function createActive($title, $id)
    {
        Activity::updateOrCreate([
            'title' => $title,
            'totourial_id' => $id
        ]);
    }

    public function completing()
    {
        $this->tasks()->update(['complete' => true]);

        $this->createActive('create_with_complete_task', $this->id);
    }

    public function inCompleting()
    {
        $this->tasks()->update(['complete' => true]);

        $this->createActive('create_with_incomplete_task', $this->id);
    }
}
