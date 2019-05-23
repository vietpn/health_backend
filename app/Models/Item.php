<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Item
 *
 * @package App\Models\Backend
 * @version July 5, 2017, 7:06 am UTC
 * @property int $id
 * @property string $name
 * @property string $avatar type PNG
 * @property int $point
 * @property string $description
 * @property bool $status 1: Enable ; 0:Disable
 * @property int $position
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int $created_id
 * @property int $updated_id
 * @property int $category_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereCreatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereUpdatedId($value)
 * @mixin \Eloquent
 */
class Item extends Model
{

    public $table = 'e_item';
    
    public $timestamps = false;

    protected $appends = ['is_buy', 'category_code'];

    public $fillable = [
        'name',
        'avatar',
        'point',
        'description',
        'status',
        'created_at',
        'updated_at',
        'created_id',
        'updated_id',
        'position',
        'category_id',
        'is_set',
        'is_buy',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'avatar' => 'string',
        'point' => 'integer',
        'description' => 'string',
        'status' => 'boolean',
        'created_id' => 'integer',
        'updated_id' => 'integer',
        'position' => 'integer',
        'category_id' => 'integer',
        'category_code' => 'integer',
        'is_set' => 'integer',
        'is_buy' => 'boolean'
    ];

    protected $hidden = [
        'furigana', 'item_relation','start_buying','end_buying'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'avatar' => 'required|image|mimes:png',
        'point' => 'required',
        'position' => 'required',
    ];

    /**
     * @inheritdoc
     */
    public function getAvatarAttribute()
    {
        if (strpos(\Route::getCurrentRoute()->getActionName(), 'Http\\Controllers\\API') !== false) {
            $this->attributes['avatar'] = env('APP_STORAGE_URL', '') . $this->attributes['avatar'];
        }
        return $this->attributes['avatar'];
    }

    /**
     * @inheritdoc
     * Check item da duoc mua chua
     */
    public function getIsBuyAttribute()
    {
        if (strpos(\Route::getCurrentRoute()->getActionName(), 'Http\\Controllers\\API') !== false) {
            $profile = \Auth::user();
            $itemBuy = ProfileItemHistory::select('id')->where('item_id', $this->id)->where('profile_id', $profile->id)->first();
            if (isset($itemBuy)){
                return true;
            }
        }
        return false;
    }

    public function getCategoryCodeAttribute()
    {
        if (strpos(\Route::getCurrentRoute()->getActionName(), 'Http\\Controllers\\API') !== false) {
            $category = CategoryItem::select('code')->where('id', $this->category_id)->first();
            if (isset($category)){
                return $category->code;
            }
        }
    }

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

    public function category()
    {
        return $this->hasOne(CategoryItem::class, 'id', 'category_id');
    }

}
