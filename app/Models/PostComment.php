<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class PostComment
 *
 * @package App\Models\V2
 * @version July 11, 2017, 6:15 am UTC
 * @property int $id
 * @property int $profile_id Id của profile
 * @property int $number_like
 * @property int $is_like
 * @property int $post_id Id của bài post
 * @property string $photo Ảnh của comment
 * @property string $content Nội dung comment
 * @property bool $is_deleted Trạng thái xóa: 0: chưa xóa; 1: đã xóa
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\Models\Post $post
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostCommentLike[] $postCommentLikes
 * @property-read \App\User $profile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereIsDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PostComment extends Model
{

    public $table = 'e_post_comment';
//    public $is_like;
    public $timestamps = false;
//    protected $number_like;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'is_deleted', 'updated_at'
    ];

    public $fillable = [
        'profile_id',
        'post_id',
        'photo',
        'content',
        'is_deleted',
        'created_at',
        'updated_at',
        'profile',
        'is_like',
        'number_like',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'profile_id' => 'integer',
        'post_id' => 'integer',
        'photo' => 'string',
        'content' => 'string',
        'is_deleted' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'content' => 'required_without:photo',
//        'photo' => 'image|mimes:jpg,jpeg,png|max:8000'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function post()
    {
        return $this->belongsTo(\App\Models\Post::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function profile()
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function postCommentLikes()
    {
        return $this->hasMany(\App\Models\PostCommentLike::class);
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
        return isset($this->attributes['photo']) ? $this->attributes['photo'] : "";
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['profile'] = $this->profile;
        $array['is_like'] = $this->is_like;
        $array['number_like'] = $this->number_like;
        foreach ($this->getMutatedAttributes() as $key) {
            if (!array_key_exists($key, $array)) {
                $array[$key] = $this->{$key};
            }
        }
        return $array;
    }

    /**
     * lấy thông profile đăng comment
     * @return array
     */
    public function getProfileAttribute()
    {
        $profile = $this->profile()->first()->toArray();
        $dataProfile = [];
        if ($profile) {
            $dataProfile['id'] = $profile['id'];
            $dataProfile['name'] = $profile['name'];
            $dataProfile['avatar'] = $profile['avatar_path'];
        }
        return $dataProfile;
    }

    /**
     * Lấy thông tin số like comment
     * @return int
     */
    public function getNumberLikeAttribute()
    {
        $postComment = $this->postCommentLikes()->count();
        return $postComment;
    }

    public function getIsLikeAttribute()
    {
        $user = \Auth::user();
        $idUser = $user->id;
        $commentLike = $this->postCommentLikes()->where('profile_id', intval($idUser))->count();
        return ($commentLike > 0) ? true : false;
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

//        self::created(function ($model) {
//            BaseModel::updateElastichsearchPost($model->post_id);
//        });
//
//        self::updating(function ($model) {
//            $model->updated_at = date('Y-m-d H:i:s');
//        });
//
//        self::updated(function ($model) {
//            BaseModel::updateElastichsearchPost($model->post_id);
//        });
//
//        self::deleted(function ($model) {
//            BaseModel::updateElastichsearchPost($model->post_id);
//        });

    }
}
