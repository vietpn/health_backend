<?php

namespace App\Repositories\Backend;

use App\Repositories\EloquentRepository;
use App\User;
use Elasticsearch\Endpoints\Indices\Validate\Query;
use InfyOm\Generator\Common\BaseRepository;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Exceptions\RepositoryException;

class ProfileRepository extends EloquentRepository implements ProfileRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return User::class;
    }

    public function querySearch($request)
    {
        $name = $request->get('name', "");
        $username = $request->get('username', "");
        $gender = $request->get('gender', 1);
        $blackUser = $request->get('black_user', 0);
        $memberRank = $request->get('member_rank', "");
        $location = $request->get('location', "");
        $isBusiness = $request->get('is_business', 0);
        $fromAge = $request->get('from_age', 18);
        $wheres = [];
        $join = [];
        $toAge = $request->get('to_age', 70);
        if (!empty($name)) {
            $wheres[] = ['name', 'like', $name];
        }
        if (!empty($username)) {
            $wheres[] = ['username', 'like', $username];
        }
        if (!empty($location)) {
            $wheres[] = ['location', 'like', $location];
        }
        if ($isBusiness == PROFILE_DEFAULT) {
            $tables = 'e_profile_user';
            $first = 'e_profile.id';
            $end = 'e_profile_user.profile_id';
            $wheres[] = ['e_profile.is_business', PROFILE_DEFAULT];
            $wheres[] = ['e_profile_user.gender', intval($gender)];
            if (!empty($fromAge) && !empty($toAge)) {
                $wheres[] = ['e_profile_user.birth_year', '>=', intval($fromAge)];
                $wheres[] = ['e_profile_user.birth_year', '<=', intval($toAge)];
            }
            $join[] = [$tables,$first,'=',$end];
        } elseif ($isBusiness == PROFILE_BUSSINESS) {
            $tables = 'e_profile_bussines';
            $first = 'e_profile.id';
            $end = 'e_profile_bussines.profile_id';
            $wheres[] = ['e_profile.is_business', PROFILE_BUSSINESS];
        }
        if ($blackUser == 1) {
            $tablesReport = 'e_profile_report';
            $firstReport = 'e_profile.id';
            $endReport = 'e_profile_report.profile_id_report';
//            $query .= ' AND '
            $user = $this->_model
                ->select('e_profile.id', 'e_profile.name', 'e_profile.avatar_path', 'e_profile.is_business', 'e_profile.created_at','e_profile.status')
                ->where($wheres)
                ->orderBy('e_profile.id',SORT_DESC)
                ->join($tables, $first, '=', $end)->join($tablesReport, $firstReport, '=', $endReport);
        } else {
            $user = $this->_model
                ->select('e_profile.id', 'e_profile.name', 'e_profile.avatar_path', 'e_profile.is_business', 'e_profile.created_at','e_profile.status')
                ->leftJoin($tables, $first, '=', $end)
                ->where($wheres)
                ->orderBy('e_profile.id',SORT_DESC);
        }
        return $user;
    }
}
