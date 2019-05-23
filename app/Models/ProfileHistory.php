<?php

namespace App\Models;

use App\Define\Systems;
use App\User;
use Eloquent as Model;

/**
 * Class ProfileHistory
 *
 * @package App\Models\Backend
 * @version July 1, 2017, 7:37 pm UTC
 * @property int $id
 * @property int $profile_id
 * @property int $item_id
 * @property string $type_name
 * @property int $point
 * @property int $type_point
 * @property bool $type kiểu sử dụng point ví dụ như: mua item, search
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileHistory whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileHistory wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileHistory whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileHistory whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProfileHistory extends Model
{

    public $table = 'e_profile_history';

    public $timestamps = false;


    public $fillable = [
        'profile_id',
        'item_id',
        'point',
        'type',
        'created_at',
        'type'
    ];
    public $hidden = [
        'updated_at'
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'profile_id' => 'integer',
        'item_id' => 'integer',
        'point' => 'integer',
        'type_point' => 'boolean',
        'type' => 'integer'
    ];

    public function toArray()
    {
        $array = parent::toArray();
        $array['type_name'] = $this->type_name;
        $array['type_point'] = $this->type_point;
        foreach ($this->getMutatedAttributes() as $key) {
            if (!array_key_exists($key, $array)) {
                $array[$key] = $this->{$key};
            }
        }
        return $array;
    }

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function getTypeNameAttribute()
    {
        $typeHistory = Systems::statusProfileHistory();
        $string = isset($typeHistory[$this->type]) ? $typeHistory[$this->type] : "";
        $this->attributes['type_name'] = $string;
        return $this->attributes['type_name'];
    }

    public function getTypePointAttribute()
    {
        $typePoint =false;
        $typeDeduction = Systems::statusDeduction();
        $typePlus = Systems::statusPlus();
        if(in_array($this->type ,$typeDeduction)){
            $typePoint =false;
        }elseif (in_array($this->type ,$typePlus)){
            $typePoint =true;
        }
        $this->attributes['type_point'] = $typePoint;
        return $this->attributes['type_point'];
    }

    public function getProfile()
    {
        return $this->belongsTo(User::class, 'profile_id', 'id');
    }

}
