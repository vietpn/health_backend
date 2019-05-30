<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Feedback
 * @package App\Models
 * @version May 30, 2019, 8:47 am +07
 */
class Feedback extends Model
{

    public $table = 'e_feedback';
    
    public $timestamps = false;



    public $fillable = [
        'profile_id',
        'content',
        'img_path',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'profile_id' => 'integer',
        'content' => 'string',
        'img_path' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
