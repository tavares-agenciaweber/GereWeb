<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'description', 'duration', 'completed', 'type'  // Removido 'user_id'
    ];

    // Removido o método de relacionamento com o User
}
