<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'width',
        'height',
        'orientation',
        'image_url',
    ];

    /**
     * User Relationship
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
