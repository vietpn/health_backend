<?php

namespace App\Repositories\Backend;

use App\Define\Systems;
use App\Models\Backend\RankConfig;
use App\Models\BaseModel;
use App\User;
use InfyOm\Generator\Common\BaseRepository;

class RankConfigRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'begin',
        'end',
        'time',
        'created_at',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return RankConfig::class;
    }

    public function getAllRank()
    {
        $return = ['success' => false, 'message' => 'error'];
        try {

            $lowestRank = RankConfig::min('begin');
            $time = Systems::getTimeRank();
            if (!empty($time)) {
                $profile = User::where('status', BaseModel::STATUS_ENABLE)
                    ->where('is_deleted', BaseModel::STATUS_DISABLE)
                    ->where('point', '>', $lowestRank)
                    ->where('created_at', '>=', date('Y-08-d 00:00:00'))
                    ->where('created_at', '<=', date('Y-m-d 23:59:59', strtotime('+' . $time['time'] . ' month')))
                    ->orderBy('point', SORT_DESC);
                $return['success'] = true;
                $return['message'] = $profile;
            }

        } catch (\Exception $ex) {
            $return['message'] = $ex->getMessage();
        }
        return $return;
    }

    public function findModelName($name)
    {
        try {
            return $this->findByField('name', $name)->first();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
