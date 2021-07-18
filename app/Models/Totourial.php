<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Totourial extends Model
{
    use HasFactory;

    protected $fillable = ['title','body','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class,'totourial_id');
    }

    public function addTask($body)
    {
        return $this->tasks()->create(['body' => $body]);
    }
}
