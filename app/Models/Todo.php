<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;


    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function list(){
        return $this->belongsTo(ListTodos::class);
    }
}
