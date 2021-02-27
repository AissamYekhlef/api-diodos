<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListTodos extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function todos(){
        return $this->hasMany(Todo::class);
    }
}
