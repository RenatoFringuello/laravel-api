<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'bg_color'];

    public function projects(){
        return $this->belongsToMany(Projects::class);
    }
}
