<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description',
        'created_by_id', 'assigned_to_id',
        'status_id'
    ];

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
        return $query->join('task_statuses as statuses', 'tasks.status_id', '=', 'statuses.id')
            ->join('users', 'tasks.created_by_id', '=', 'users.id')
            ->selectRaw('tasks.*, statuses.name as status_name, users.name as creator_name');
    }
}
