<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class OauthAccessTokens
 *
 * @package App\Models
 * @version July 3, 2017, 7:14 am UTC
 * @property string $id
 * @property int $user_id
 * @property int $client_id
 * @property string $name
 * @property string $scopes
 * @property bool $revoked
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $expires_at
 * @property string $token
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthAccessTokens whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthAccessTokens whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthAccessTokens whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthAccessTokens whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthAccessTokens whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthAccessTokens whereRevoked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthAccessTokens whereScopes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthAccessTokens whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthAccessTokens whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthAccessTokens whereUserId($value)
 * @mixin \Eloquent
 */
class OauthAccessTokens extends Model
{

    public $table = 'oauth_access_tokens';
    
    public $timestamps = false;

    public $fillable = [
        'user_id',
        'client_id',
        'name',
        'scopes',
        'revoked',
        'created_at',
        'updated_at',
        'expires_at',
        'token'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'user_id' => 'integer',
        'client_id' => 'integer',
        'name' => 'string',
        'scopes' => 'string',
        'revoked' => 'boolean',
        'token' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
