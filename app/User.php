<?php

namespace App;

use App\Models\BaseModel;
use App\Models\Message;
use App\Models\OauthAccessTokens;
use App\Models\Post;
use App\Models\PostFavorite;
use App\Models\PostLike;
use App\Models\ProfileBussines;
use App\Models\ProfileHistory;
use App\Models\ProfileUser;
use App\Models\Shop;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\HasApiTokens;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;


/**
 * App\User
 *
 * @property int $id
 * @property string|null $username
 * @property string $name
 * @property string|null $email
 * @property string|null $location Địa chỉ
 * @property string|null $country Quê quán
 * @property string $password
 * @property string|null $remember_token
 * @property int|null $point Số điểm của profile
 * @property mixed $avatar_path Ảnh đại diện
 * @property string|null $cover_path Ảnh cover
 * @property float|null $longitude
 * @property string|null $img ảnh bên ngoài
 * @property float|null $latitude
 * @property int|null $is_business 1: profile doanh nghiệp 0: là profile thường
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $last_updated Cập nhập mới nhất
 * @property string|null $last_login
 * @property string|null $imei
 * @property integer|null $is_deleted
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProfileHistory[] $ProfileHistory
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-write mixed $birthday
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAvatarPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCoverPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsBusiness($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastUpdated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereZodiacSign($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastLogin($value)
 * @mixin \Eloquent
 * @property string|null $same_person Người giống nhau
 * =======
 * @property string|null $ same_person Người giống nhau
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSamePerson($value)
 * @property int|null $online_status Trạng thái online, 0: đang offline, 1: đang online
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereOnlineStatus($value)
 * @property int|null $status 1: user con hoạt động , 0 : đã ngừng hoạt động
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereImei($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsDeleted($value)
 */
class User extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;
    protected $table = 'e_profile';

    const PLUS = 1;      //Cong point
    const DEDUCTION = 2; //Tru point

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'avatar_path', 'password', 'is_business', 'last_updated',
        'longitude', 'location', 'latitude', 'online_status', 'img', 'status', 'last_login', 'imei', 'is_deleted'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'last_updated'
    ];
    protected $casts = [
        'is_business' => 'integer',
        'status' => 'integer',
    ];
    /**
     * validation login
     * @var array
     */
    public static $rulesLogin = [
        'email' => 'required:',
        'password' => 'required:'
    ];
    /**
     * validation register
     * @var array
     */
    public static $rulesRegisterProfileUser = [
        'name' => 'required|max:255|unique_name',
        'password' => 'required|min:8',
        'gender' => 'required|integer',
        'gender_visivility' => 'required|integer',
        'birthday' => 'required|date|date_long_time',
        'birthday_visivility' => 'required|integer',
        'email' => 'required|email|unique_email',
//        'imei' => 'required|unique_imei',
        'is_business' => 'required',
        'longitude' => 'float|longtitue',
        'latitude' => 'float|latitue',
    ];
    public static $rulesRegisterProfileBusiness = [
        'name' => 'required|max:255|unique_name',
        'password' => 'required|min:8',
        'email' => 'required|email|unique_email',
//        'imei' => 'required|unique_imei',
        'is_business' => 'required',
        'longitude' => 'float|longtitue',
        'latitude' => 'float|latitue',
        'avatar' => 'max:2000000',
        'hyperlink' => 'required|max:255|url',
        'bussines_type_id' => 'required',
        'mobile' => 'required|numeric',
    ];
    public static $rulesUploadAvatar = [
        'avatar' => 'required|image|mimes:jpg,jpeg,png|max:8000'
    ];
    /**
     * validation update profile
     * @var array
     */
    public static $ruleUpdateProfile = [
        'gender' => 'range_number',
        'gender_visivility' => 'range_number',
        'birthday' => 'date_long_time',
        'birthday_visivility' => 'range_number',
        'zodiac_sign' => '',
        'blood_type' => '',
        'description' => 'max:255',
        'hometown' => 'max:200',
        'personnality' => 'max:255',
        'special_skills' => 'max:255',
        'hobbies' => 'max:255',
        'my_current_obsession' => 'max:255',
        'achievement' => 'max:255',
        'favorite_place' => 'max:255',
        'favorite_food' => 'max:255',
        'favorite_celebrity' => 'max:255',
        'favorite_music' => 'max:255',
        'favorite_sport' => 'max:255',
        'favorite_word' => 'max:255',
        'hairstyle' => 'max:255',
        'language' => 'max:255',
        'height' => 'float',
        'weight' => 'float',
        'longitude' => 'float|longtitue',
        'latitude' => 'float|latitue',
    ];

    public static $rulesSearchProfile = [
        'start_age' => 'integer',
        'end_age' => 'integer',
        'gender' => 'integer',
    ];
    public static $ruleUnBlockProfile = [
        'profile_id_block' => 'required|integer|exists:e_profile_block,profile_id_block'
    ];

    public static $ruleFavoriteProfile = [
        'profile_id_favorite' => 'required|integer|exists:e_profile,id|unique:e_profile_favorite,profile_id_favorite,profile_id'
    ];
    public static $ruleUnFavoriteProfile = [
        'profile_id_favorite' => 'required|integer|exists:e_profile_favorite,profile_id_favorite'
    ];

    public static $ruleFavoritePost = [
        'post_id' => 'required|integer|exists:e_post,id'
    ];
    public static $ruleUnFavoritePost = [
        'post_id' => 'required|integer|exists:e_post_favorite,post_id'
    ];

    public static $ruleReportProfile = [
        'profile_id_report' => 'required|integer|exists:e_profile,id'
    ];
    public static $rulePasswordReset = [
        'email' => 'required|email|exists:e_profile,email'
    ];
    public static $ruleSearchNearby = [
        'top_left_lat' => 'required|float|latitue',
        'top_left_lon' => 'required|float|longtitue',
        'bottom_right_lat' => 'required|float|latitue',
        'bottom_right_lon' => 'required|float|longtitue',
        'page' => 'integer',
        'limit' => 'integer',
    ];
    public static $ruleUpdateLocation = [
        'longitude' => 'required|float|longtitue',
        'latitude' => 'required|float|latitue',
    ];
    public static $buyItem = [
        //'item_id' => 'required|integer',
    ];
    public static $rulesOnlineStatus = [
        'online_status' => 'required',
    ];
    public static $rulesSearchFavoriteProfile = [
        [],
    ];
    public static $rulesDonatePoint = [
        'point' => 'required|integer',
        'receiver_id' => 'required|integer',
    ];

    public static $itemListByUser = [
        'category_id' => 'integer',
    ];

    public static $ruleChangeEmail = [
        'email' => 'required|email|unique_email'
    ];

    /**
     * Set the user's username.
     *
     * @param  string $value
     * @return void
     */
    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday'] = $value;
    }

    public function ProfileHistory()
    {
        return $this->hasMany(ProfileHistory::class, 'profile_id', 'id')->orderBy('id', SORT_DESC);
    }

    /**
     * @param $type
     * @param int $point
     * @return array
     * @throws \Exception
     */
    public static function billingPoint($type, $point = 0)
    {
        $profile = \Auth::user();
        $param = [];
        $param['user_id'] = $profile->id;
        $param['type'] = $type;
        $param['point'] = $point;

        Log::info('LOGS_HISTORY_BILLING_POINT_FOR_ID_USER' . $profile->id, $param);
        if ($type == User::PLUS) {
            $profile->point = intval($profile->point) + intval($point);
        }

        //Trừ point
        if ($type == User::DEDUCTION) {
            if (!empty($point) && $profile->point < $point) {
                throw new UnprocessableEntityHttpException(trans('app.point.not.enough'));
            }

            $profile->point = intval($profile->point) - intval($point);
        }
        if (!$profile->save()) {
            throw new \Exception(trans('app.billing.error'));
        }

        return [
            'success' => 200,
            'dataUser' => $profile
        ];
    }

    public function getLocationAttribute($value)
    {
        return ucfirst($value);
    }

    public function getCountryAttribute($value)
    {
        return ucfirst($value);
    }

    public function getPointAttribute($value)
    {
        return intval($value);
    }

    public function getCoverPathAttribute($value)
    {
        return intval($value);
    }

    /**
     *
     * @param $token
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public static function findIdentityByAccessToken($token)
    {
        $oat = OauthAccessTokens::select(['id', 'user_id'])->where(['token' => $token])->first();
        if (empty($oat)) {
            throw new \Exception(trans('app.profile.not.exit'), 422);
        }

        $profile = User::findOrFail($oat->user_id);
        if (empty($profile)) {
            throw new \Exception(trans('app.profile.not.exit'), 422);
        }

        return $profile;
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['img'] = $this->img;
        foreach ($this->getMutatedAttributes() as $key) {
            if (!array_key_exists($key, $array)) {
                $array[$key] = $this->{$key};
            }
        }
        return $array;
    }

    /**
     * @return string
     */
    public function getImgAttribute()
    {
        $img = env('APP_URL', '') . MEN;
        if ($this->is_business == PROFILE_BUSSINESS) {
            $img = env('APP_URL', '') . SHOP;
        } elseif ($this->is_business == PROFILE_DEFAULT) {
            $profileUser = $this->getProfileUsers()->first();
            if ($profileUser) {
                if ($profileUser->gender == 1 || $profileUser->gender == -1) {

                    $img = env('APP_URL', '') . MEN;
                } elseif ($profileUser->gender == 0) {
                    $img = env('APP_URL', '') . WOMENT;

                }

            }
        }
        return $img;
    }

    /**
     *
     * @return mixed
     */
    public function getAvatarPathAttribute()
    {
        //Custom when call API
        if (empty($this->attributes['avatar_path'])) {
            if ($this->attributes['is_business'] == PROFILE_DEFAULT) {
                $profileUser = ProfileUser::where('profile_id', $this->attributes['id'])->first();
                if ($profileUser) {
                    if ($profileUser->gender == 1 || $profileUser->gender == -1) {
                        $avatar_path = env('APP_URL', '') . AVATAR_MEN;
                    } elseif ($profileUser->gender == 0) {
                        $avatar_path = env('APP_URL', '') . AVATAR_WOMENT;
                    }
                } else {
                    $avatar_path = env('APP_URL', '') . SHOP;
                }

            } elseif ($this->attributes['is_business'] == PROFILE_BUSSINESS) {
                $avatar_path = env('APP_URL', '') . SHOP;
            }
//            $this->attributes['avatar_path'] = $avatar_path;

            return $avatar_path;
        } else {
            return env('APP_STORAGE_URL', '') . $this->attributes['avatar_path'];
        }

    }

    /**
     * lấy thông tin profile nếu là tài khoản thường
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getProfileUsers()
    {
        return $this->hasOne(ProfileUser::class, 'profile_id', 'id');
    }

    /**
     * Lấy thông tin Profile nếu là tài khoản doanh nghiệp
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getProfileBussiness()
    {
        return $this->hasOne(ProfileBussines::class, 'profile_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getMesssage()
    {
        return $this->hasMany(Message::class, 'profile_id', 'id');
    }

    public function getLike()
    {
        return $this->hasOne(PostLike::class, 'profile_id', 'id');
    }

    public function getFavorite()
    {
        return $this->hasOne(PostFavorite::class, 'profile_id', 'id');
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

        self::updating(function ($model) {
            $model->updated_at = date('Y-m-d H:i:s');

        });
        self::created(function ($model) {
            BaseModel::updateProfileElasticsearch($model->id);
        });
        self::updated(function ($model) {
            BaseModel::updateProfileElasticsearch($model->id);
        });
        self::updated(function ($model) {
            if ($model->is_deleted === DELETE_PROFILE) {
                BaseModel::deleteProfileElasticsearch($model->id);
                //delete post in elastichsearch update in post is_delete ==1
                $post = Post::select('id')->where('profile_id', $model->id)->get();
                if ($post) {
                    foreach ($post as $item) {
                        BaseModel::deletePostElasticsearch($item->id);
                        Post::find($item->id)->update([
                            'is_deleted' => DELETE_PROFILE,
                        ]);

                    }
                }
                //update trạng thái trong message is_delete =1;
                Message::where('profile_sent', $model->id)->update([
                    'is_deleted' => DELETE_PROFILE,
                ]);
                Message::where('profile_recive', $model->id)->update([
                    'is_deleted' => DELETE_PROFILE,
                ]);
            } else {
                BaseModel::updateProfileElasticsearch($model->id);
            }
        });

        self::deleted(function ($model) {
            BaseModel::deleteProfileElasticsearch($model->id);
        });
    }


}
