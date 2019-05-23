<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class NmCategoryItem
 *
 * @package App\Models
 * @version July 5, 2017, 7:52 am UTC
 * @property int $id
 * @property int $category_item_id
 * @property int $item_id
 * @property string|null $created_at
 * @property int $created_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NmCategoryItem whereCategoryItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NmCategoryItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NmCategoryItem whereCreatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NmCategoryItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NmCategoryItem whereItemId($value)
 * @mixin \Eloquent
 */
class NmCategoryItem extends Model
{

    public $table = 'e_nm_category_item';
    
    public $timestamps = false;



    public $fillable = [
        'category_item_id',
        'item_id',
        'created_at',
        'created_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'category_item_id' => 'integer',
        'item_id' => 'integer',
        'created_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $user = \Sentinel::check();
            if (isset($user)){
                $model->created_id = $user->getUserId();
            }
        });
    }
}
