<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class ProfileReport
 *
 * @package App\Models\V2
 * @version July 17, 2017, 3:16 pm ICT
 * @property int $id
 * @property int $profile_id
 * @property int $profile_id_report
 * @property bool $status Trạng thai xử lý: 0 chưa xử lý, 1 đã xử lý
 * @property string $des Miêu tả thêm
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\User $eProfile
 * @property-read \App\User $eProfileReport
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileReport whereDes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileReport whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileReport whereProfileIdReport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileReport whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileReport whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProfileReport extends Model
{

    public $table = 'e_profile_report';
    
    public $timestamps = false;



    public $fillable = [
        'profile_id',
        'profile_id_report',
        'status',
        'des',
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
        'profile_id_report' => 'integer',
        'status' => 'boolean',
        'des' => 'string'
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
    public function eProfile()
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function eProfileReport()
    {
        return $this->belongsTo(\App\User::class);
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
