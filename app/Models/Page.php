<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Page
 *
 * @package App\Models
 * @version June 29, 2017, 4:52 am UTC
 * @property int $id
 * @property string $title
 * @property string $alias
 * @property string $content_en
 * @property int $created_id
 * @property int $updated_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereContentEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereCreatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereUpdatedId($value)
 * @mixin \Eloquent
 */
class Page extends Model
{

    public $table = 'e_page';

    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'created_id', 'updated_id'
    ];

    public $fillable = [
        'title',
        'alias',
        'content_en',
        'created_id',
        'updated_id',
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
        'title' => 'string',
        'alias' => 'string',
        'content_en' => 'string',
        'created_id' => 'integer',
        'updated_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|min:5|max:150',
        'alias' => 'required|alpha_dash|min:5|max:150|unique:e_page,alias'
    ];


    /**
     * @inheritdoc
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $user = \Sentinel::check();
            $model->created_id = $user->getUserId();
            $model->updated_id = $user->getUserId();
            $model->created_at = date('Y-m-d H:i:s');
            $model->updated_at = date('Y-m-d H:i:s');
        });

        self::updating(function ($model) {
            $user = \Sentinel::check();
            $model->updated_id = $user->getUserId();
            $model->updated_at = date('Y-m-d H:i:s');
        });
    }
}
