<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description',
        'created_by_id', 'status_id',
        'assigned_to_id'
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function assign(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(
            Label::class,
            'label_task',
            'task_id',
            'label_id')
            ->withTimestamps();
    }
}
