<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'creator_by_id', 'assigned_to_id'];

    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function assign()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeTaskList($query)
    {
        return $query->join('task_statuses', 'tasks.status_id', '=', 'task_statuses.id')->select('tasks.*', 'task_statuses.name')
            ->orderByDesc('updated_at')
            ->get();
    }
}
