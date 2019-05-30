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
 */
class User extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;
    protected $table = 'e_profile';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * validation login
     * @var array
     */
    public static $rulesLogin = [
        'username' => 'required:',
        'password' => 'required:'
    ];

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
    }
}
