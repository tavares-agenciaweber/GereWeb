<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskDefault extends Model
{
    protected $table = 'tasks_default';

    protected $fillable = [
        'description'
    ];
}
