<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function scopeStatusesList($query)
    {
        return $query->select('id', 'name', 'created_at')->orderByDesc('created_at');
    }
}
