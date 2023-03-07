<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'level',
        'name',
    ];

    /**
     * get the user data related to the project
     */
    public function users(){
        return $this->belongsToMany(User::class);
    }
}
