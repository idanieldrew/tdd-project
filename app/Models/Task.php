<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'totourial_id'];

    public function totourial()
    {
        return $this->belongsTo(Totourial::class,'id');
    }
}
