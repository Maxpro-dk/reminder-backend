<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'execution_datetime',
        'status_id'
    ];

    protected $casts = [
        'execution_datetime' => 'datetime',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}