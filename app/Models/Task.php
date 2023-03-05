<?php

namespace App\Models;

use App\Observers\TaskObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected static $observers = [
        TaskObserver::class
    ];
    protected $table = 'tasks';
    protected $fillable = [
      'name',
      'done'
    ];
}
