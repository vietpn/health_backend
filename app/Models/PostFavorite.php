<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class e_post_favorite
 *
 * @package App\Models
 * @version July 5, 2017, 7:06 am UTC
 * @property int $id
 * @property int $profile_id
 * @property int $Post_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\User $eProfile
 * @property-read \App\User $eProfileFavorite
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileFavorite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileFavorite whereId($value)
 * @mixin \Eloquent
 */
class PostFavorite extends Model
{

    public $table = 'e_post_favorite';
    
    public $timestamps = false;

    protected $appends = ['content'];

    protected $hidden = [
        'updated_at', 'id'
    ];

    public $fillable = [
        'profile_id',
        'post_id',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'profile_id' => 'integer',
        'post_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function profile()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['content'] = $this->content;
        foreach ($this->getMutatedAttributes() as $key) {
            if (!array_key_exists($key, $array)) {
                $array[$key] = $this->{$key};
            }
        }
        return $array;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function postFavorite()
    {
        return $this->belongsTo(\App\Models\Post::class);
    }

    public function getContentAttribute() {
        $post = Post::findOrFail($this->post_id);
        return $post->content;
    }

}
