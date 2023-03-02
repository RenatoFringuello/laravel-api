<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type_id',
        'slug',
        'title',
        'content',
        'start_date',
        'end_date',
        'image',
        // url,
        // github_uri, //must be {{user->github_nickname/(project->slug || project->github_title)}}
    ];
    protected $dates = [
        'start_date',
        'end_date'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * get the user data related to the project
     *
     * @return BelongsTo
     */
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
    
    /**
     * get the user data related to the project
     *
     * @return BelongsTo
     */
    public function type():BelongsTo{
        return $this->belongsTo(Type::class);
    }

    /**
     * get the user data related to the project
     */
    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }
}