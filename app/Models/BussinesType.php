<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class BussinesType
 *
 * @package App\Models\Backend
 * @version July 11, 2017, 2:46 am UTC
 * @property int $id
 * @property string $title
 * @property bool $status
 * @property string|null $created_at
 * @property int $created_id
 * @property string|null $updated_at
 * @property int $updated_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BussinesType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BussinesType whereCreatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BussinesType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BussinesType whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BussinesType whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BussinesType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BussinesType whereUpdatedId($value)
 * @mixin \Eloquent
 */
class BussinesType extends Model
{

    public $table = 'e_bussines_type';
    
    public $timestamps = false;



    public $fillable = [
        'title',
        'status',
        'created_at',
        'created_id',
        'updated_at',
        'updated_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'status' => 'boolean',
        'created_id' => 'integer',
        'updated_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

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

    public static function getListBussinesType(){
        return BussinesType::pluck('title', 'id');
    }

    public static function getBussinesTypeName($status){
        $arr = self::getListBussinesType();
        if (isset($arr[$status])) {
            return $arr[$status];
        } else {
            return "N/A";
        }
    }
}
