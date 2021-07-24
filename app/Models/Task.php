<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded=[];

    // protected $touches = ['totourial'];

    public function totourial()
    {
        return $this->belongsTo(Totourial::class);
    }
}
