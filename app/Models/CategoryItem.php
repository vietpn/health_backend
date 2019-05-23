<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class CategoryItem
 *
 * @package App\Models\Backend
 * @version July 4, 2017, 3:05 am UTC
 * @mixin \Eloquent
 * @property int $id
 * @property string $title
 * @property string $avatar Avatar of category
 * @property bool $status 1:Enable ; 0:Disable
 * @property int $sort_order
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int $created_id
 * @property int $updated_id
 * @property int $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryItem whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryItem whereCreatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryItem whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryItem whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryItem whereUpdatedId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Item[] $items
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryItem whereType($value)
 */
class CategoryItem extends Model
{

    public $table = 'e_category_item';
    
    public $timestamps = false;



    public $fillable = [
        'title',
        'avatar',
        'status',
        'created_at',
        'updated_at',
        'created_id',
        'updated_id',
        'type',
        'code',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'sort_order' => 'integer',
        'avatar' => 'string',
        'status' => 'boolean',
        'created_id' => 'integer',
        'updated_id' => 'integer',
        'type' => 'integer',
        'code'  => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'avatar' => 'image|mimes:png',
    ];


    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $user = \Sentinel::check();
            if (isset($user)){
                $model->created_id = $user->getUserId();
            }
            $model->updated_at = date('Y-m-d H:i:s');
        });

        self::updating(function ($model) {
            $user = \Sentinel::check();
            if (isset($user)){
                $model->updated_id = $user->getUserId();
            }
            $model->updated_at = date('Y-m-d H:i:s');
        });
    }

    public static function getCategoryItems($item_id){
        $cate = NmCategoryItem::where(['item_id'=> $item_id])->get();
        $strListCate = '';
        foreach ($cate as $item) {
            $category = CategoryItem::find($item['category_item_id']);
            if (isset($category)) {
                $strListCate = $strListCate . $category->title . ',';
            }
        }
        return $strListCate;
    }

    public static function getListCategory(){
        return CategoryItem::pluck('title', 'id');
    }

    public function items(){
        return $this->belongsToMany(Item::class, 'e_nm_category_item',
            'category_item_id', 'item_id');
    }

    public function getAvatarAttribute()
    {
        if (strpos(\Route::getCurrentRoute()->getActionName(), 'Http\\Controllers\\API') !== false) {
            $this->attributes['avatar'] = env('APP_STORAGE_URL', '') . $this->attributes['avatar'];
        }
        return $this->attributes['avatar'];
    }
}
