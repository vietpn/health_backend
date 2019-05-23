<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Post
 *
 * @package App\Models
 * @version July 6, 2017, 6:53 am UTC
 * @property int $id
 * @property int $profile_id
 * @property string $content
 * @property string $photo Ảnh cover
 * @property int $pin_id
 * @property float $longitude
 * @property float $latitude
 * @property bool $is_deleted Trạng thái xóa: 0: chưa xóa; 1: đã xóa
 * @property string|null $province
 * @property string|null $district
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\User $eProfile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereIsDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post wherePinId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostComment[] $postComments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostLike[] $postLikes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostView[] $postViews
 * @property-read \App\User $profile
 * @property string|null $location_string
 * @property-read \App\Models\Pin|null $pin
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereLocationString($value)
 */
class Post extends Model
{

    public $table = 'e_post';

    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public $fillable = [
        'profile_id',
        'content',
        'photo',
        'pin_id',
        'longitude',
        'latitude',
        'is_deleted',
        'created_at',
        'updated_at',
        'location_string',
        'province',
        'district'
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
        'photo' => 'string',
        'pin_id' => 'integer',
        'longitude' => 'float',
        'latitude' => 'float',
        'is_deleted' => 'boolean',
        'location_string' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'content' => 'required_without:photo',
        'longitude' => 'required|float|longtitue',
        'latitude' => 'required|float|latitue',
//        'photo' => 'image|mimes:jpg,jpeg,png|max:8000',
        'pin_id' => 'integer|exists:e_pin,id'
    ];
    public static $rulesSearchPost = [
        'top_left_lat' => 'required|float|latitue',
        'top_left_lon' => 'required|float|longtitue',
        'bottom_right_lat' => 'required|float|latitue',
        'bottom_right_lon' => 'required|float|longtitue',
        'page' => 'integer',
        'limit' => 'integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function profile()
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pin()
    {
        return $this->belongsTo(Pin::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function postComments()
    {
        return $this->hasMany(\App\Models\PostComment::class, 'post_id', 'id')->where('e_post_comment.is_deleted', 0);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function postLikes()
    {
        return $this->hasMany(\App\Models\PostLike::class, 'post_id', 'id')->where('e_post_like.is_deleted', 0);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function postFavorites()
    {
        return $this->hasMany(\App\Models\PostFavorite::class, 'post_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function postViews()
    {
        return $this->hasMany(\App\Models\PostView::class, 'post_id', 'id');
    }

    /**
     * @inheritdoc
     */
    public function getPhotoAttribute()
    {
        //Custom when call API
        if (!empty($this->attributes['photo'])) {
            $this->attributes['photo'] = env('APP_STORAGE_URL', '') . $this->attributes['photo'];
        }
        return $this->attributes['photo'];
    }

    /**
     * @inheritdoc
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->created_at = date('Y-m-d H:i:s');
            $model->updated_at = date('Y-m-d H:i:s');
        });
        self::created(function ($model) {
            BaseModel::updateElastichsearchPost($model->id);
        });
        self::updating(function ($model) {
            $model->updated_at = date('Y-m-d H:i:s');
        });
        self::deleted(function ($model) {
            BaseModel::deletePostElasticsearch($model->id);
        });
    }
}
