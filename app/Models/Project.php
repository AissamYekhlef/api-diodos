<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'created_at', 
        'updated_at'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    } 
    
    public function lists(){
        return $this->hasMany(ListTodos::class);
    }
}
