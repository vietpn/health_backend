<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Profile
 * @package App\Models\Backend
 * @version May 29, 2019, 3:10 pm +07
 */
class Profile extends Model
{

    public $table = 'e_profile';
    
    public $timestamps = false;



    public $fillable = [
        'username',
        'name',
        'email',
        'phone_number',
        'birthday',
        'password',
        'remember_token',
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
        'username' => 'string',
        'name' => 'string',
        'email' => 'string',
        'phone_number' => 'string',
        'birthday' => 'date',
        'password' => 'string',
        'remember_token' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
}
