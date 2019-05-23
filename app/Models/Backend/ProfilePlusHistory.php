<?php

namespace App\Models\Backend;

use App\User;
use Eloquent as Model;

/**
 * Class ProfilePlusHistory
 *
 * @package App\Models\Backend
 * @version August 24, 2017, 9:59 am ICT
 * @property int $id
 * @property int $profile_id
 * @property int $point
 * @property bool $type 1:nạp từ iap_android;2:nap tự iap_ios;3:cộng từ chat
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read mixed $type_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\ProfilePlusHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\ProfilePlusHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\ProfilePlusHistory wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\ProfilePlusHistory whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\ProfilePlusHistory whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\ProfilePlusHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProfilePlusHistory extends Model
{

    public $table = 'e_profile_plus_history';

    public $timestamps = false;


    public $fillable = [
        'profile_id',
        'point',
        'type',
        'created_at',
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
        'point' => 'integer',
        'type' => 'boolean'
    ];
    public function toArray()
    {
        $array = parent::toArray();
        $array['type_name'] = $this->type_name;
        foreach ($this->getMutatedAttributes() as $key) {
            if (!array_key_exists($key, $array)) {
                $array[$key] = $this->{$key};
            }
        }
        return $array;
    }
    public function getTypeNameAttribute(){
        $string = "";
        if($this->type == CHAT){
            $string ='Chat';
        }elseif ($this->type==CARD_IAP_ANDROID){
            $string ='Card Iap Android';
        }elseif ($this->type ==CARD_IAP_IOS){
            $string ="Card Iap Ios";
        }
        $this->attributes['type_name'] = $string;
        return $this->attributes['type_name'];
    }
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function getProfile()
    {
        return $this->belongsTo(User::class, 'profile_id', 'id');
    }

}
