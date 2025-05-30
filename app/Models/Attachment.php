<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = ['task_list_id', 'file_path','name'];

    public function task()
    {
        return $this->belongsTo(TaskList::class, 'task_list_id');
    }
}
