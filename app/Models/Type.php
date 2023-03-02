<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    use HasFactory;

    protected $fillable =['name'];

    /**
     * get all the projects related to the user
     *
     * @return HasMany
     */
    public function projects():HasMany{
        return $this->hasMany(Project::class);
    }
}
