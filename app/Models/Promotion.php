<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Promotion
 * @package App\Models
 * @version May 28, 2019, 4:55 pm +07
 */
class Promotion extends Model
{

    public $table = 'e_promotion';
    
    public $timestamps = false;



    public $fillable = [
        'content',
        'img_path',
        'code',
        'value',
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
        'content' => 'string',
        'img_path' => 'string',
        'code' => 'string',
        'value' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
