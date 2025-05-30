<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'completed',
        'task_list_id',
    ];

    public function list()
    {
        return $this->belongsTo(TaskList::class, 'task_list_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


}
