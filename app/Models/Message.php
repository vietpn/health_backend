<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Message
 *
 * @property int $id
 * @property string|null $messages
 * @property int|null $profile_id
 * @property int|null $profile_sent
 * @property int|null $profile_recive
 * @property string|null $image
 * @property int|null $is_image 1: là ảnh 0: là text
 * @property int|null $is_deleted
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int|null $time_sent
 * @property-read \App\User|null $profile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereMessages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereProfileRecive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereProfileSent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereReplyProfile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereIsImage($value)
 * @property int|null $is_read_all 1: đã đọc tất cả ,0: chưa đọc hết
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereIsReadAll($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereTimeSent($value)
 */
class Message extends Model
{
    protected $table = 'e_messages';


    protected $fillable = ['messages', 'profile_id', 'profile_sent', 'profile_recive', 'is_image', 'created_at', 'time_sent', 'is_read', 'is_read_all', 'image','is_deleted'];
    protected $hidden = ['updated_at', 'created_at', 'is_read_all'];
    /**
     * @var array
     */
    public static $updateStatusMsg = [
        'msg_id' => 'required|integer|exists:e_messages,id',
    ];
    public static $ruleUpdateAll = [
        'profile_id' => 'integer|exists:e_profile,id',
    ];
    public static $ruleSentMessage = [
        'receiver_id' => 'required|integer|exists:e_profile,id',
    ];
    protected $casts = [
        'is_image' => 'boolean',
        'image' => 'string',
    ];
    protected $attributes = [
        'is_image' => false,
        'image' => "",
        'messages' => "",
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile()
    {
        return $this->belongsTo(User::class, 'profile_id', 'id');
    }

    public function profileSend()
    {
        return $this->belongsTo(User::class, 'profile_sent', 'id');
    }

    public function profileReceive()
    {
        return $this->belongsTo(User::class, 'profile_recive', 'id');
    }

//    public function setImageAttribute($value)
//    {
//        $this->attributes['image'] = env('APP_STORAGE_URL', '') . $value;
//    }
    public function getImageAttribute()
    {
        if (!empty($this->attributes['image'])) {
            return env('APP_STORAGE_URL', '') . $this->attributes['image'];
        }
        return !empty($this->attributes['image']) ? $this->attributes['image'] : "";
    }

    /**
     * @inheritdoc
     */
//    public function getTimeSentAttribute()
//    {
//        //Custom when call API
//        $this->attributes['time_sent'] = (int)$this->attributes['time_sent'];
//        return $this->attributes['time_sent'];
//    }

    /**
     * @inheritdoc
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->time_sent = self::milliseconds();
        });
//        self::created(function ($model) {
//            \Redis::set('')
//        });
    }

    public static function milliseconds()
    {
        $mt = explode(' ', microtime());
        return ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));
    }

}
