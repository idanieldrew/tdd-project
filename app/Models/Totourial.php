<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Totourial extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'tips', 'user_id'];

    public $old = [];

    // rel with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // rel with task
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // rel with activity
    public function activities()
    {
        return $this->morphMany(Activity::class, 'activitable');
    }

    // add task 
    public function addTask($body)
    {
        $task = $this->tasks()->create($body);

        $this->createActive("create_with_task", 'App\Models\Task', $this->id);

        return $task;
    }

    // add activity
    public function createActive($title, $model, $id)
    {
        Activity::updateOrCreate([
            'title' => $title,
            'activitable_type' => $model,
            'activitable_id' => $id,
            'changes' => [
                'before' => array_diff($this->old, $this->getAttributes()),
                'after' => array_diff($this->getAttributes(), $this->old),
            ]
        ]);
    }

    // complete 'complete' role in task table
    public function completing()
    {
        $this->tasks()->update(['complete' => true]);

        $this->createActive('create_with_complete_task', 'App\Models\Task', $this->id);
    }

    // inComplete 'complete' role in task table
    public function inCompleting()
    {
        $this->tasks()->update(['complete' => false]);

        $this->createActive('create_with_incomplete_task', 'App\Models\Task', $this->id);
    }
}
