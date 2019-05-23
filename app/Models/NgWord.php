<?php

namespace App\Models;

use Eloquent as Model;
use App\Define\Systems;

/**
 * Class NgWord
 *
 * @package App\Models\Backend
 * @version July 18, 2017, 9:18 am ICT
 * @property int $id
 * @property string $word
 * @property string $pronounce
 * @property string $description
 * @property bool $status
 * @property int $created_id
 * @property string|null $created_at
 * @property int $updated_id
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NgWord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NgWord whereCreatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NgWord whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NgWord wherePronounce($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NgWord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NgWord whereWord($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NgWord whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NgWord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NgWord whereUpdatedId($value)
 * @mixin \Eloquent
 */
class NgWord extends Model
{

    public $table = 'e_ngword';

    public $timestamps = false;
    /**
     * @var Systems
     */

    public $fillable = [
        'word',
        'pronounce',
        'description',
        'status',
        'created_id',
        'created_at',
        'updated_id',
        'updated_at',
        'type',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'word' => 'string',
        'pronounce' => 'string',
        'description' => 'string',
        'status' => 'boolean',
        'created_id' => 'integer',
        'updated_id' => 'integer',
        'type'      => 'integer',
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
        self::creating(function ($model) {
            $user = \Sentinel::check();
            if (isset($user)) {
                $model->created_id = $user->getUserId();
            }
            $model->updated_at = date('Y-m-d H:i:s');
        });
        self::created(function ($model) {
            self::getListNgWord();
        });
        self::updating(function ($model) {
            $user = \Sentinel::check();
            if (isset($user)) {
                $model->updated_id = $user->getUserId();
            }
            $model->updated_at = date('Y-m-d H:i:s');
        });
        self::updated(function ($model) {

            self::getListNgWord();
        });
        self::deleted(function ($model) {
            self::getListNgWord();
        });
        parent::boot();
    }

    protected static function getListNgWord()
    {

        $listWord = NgWord::select('word')
            ->where('status', BaseModel::STATUS_ENABLE)
            ->get()->toArray();
        if ($listWord) {
            $tep = [];
            foreach ($listWord as $item) {
                array_push($tep, $item['word']);
            }
            Systems::_setRedis('NG_WORD',json_encode($tep));
        }
    }

}
