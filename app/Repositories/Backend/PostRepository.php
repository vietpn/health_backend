<?php

namespace App\Repositories\Backend;

use App\Models\Post;
use InfyOm\Generator\Common\BaseRepository;
use DB;

class PostRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'profile_id',
        'content',
        'photo',
        'pin_id',
        'longitude',
        'latitude',
        'is_deleted',
        'created_at',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Post::class;
    }


    /**
     * @inheritdocn
     * @param $id
     * @param array $columns
     */
    public function findWithoutFail($id, $columns = [])
    {
        try {
            $query = DB::table('e_post')
                ->leftJoin('e_profile', 'e_profile.id', '=', 'e_post.profile_id')
                ->leftJoin('e_profile_user', 'e_profile_user.profile_id', '=', 'e_post.profile_id')
                ->leftJoin('e_post_comment', 'e_post_comment.post_id', '=', 'e_post.id')
                ->leftJoin('e_post_like', 'e_post_like.post_id', '=', 'e_post.id')
                ->leftJoin('e_post_report', 'e_post_report.post_id', '=', 'e_post.id')
                ->leftJoin('e_post_view', 'e_post_view.post_id', '=', 'e_post.id')
                ->select('e_post.*', 'e_profile.name',
                    DB::raw('count(DISTINCT e_post_comment.id) as comments'),
                    DB::raw('count(DISTINCT e_post_like.id) as likes'),
                    DB::raw('count(DISTINCT e_post_report.id) as reports'),
                    DB::raw('count(DISTINCT e_post_view.id) as views'))
                ->groupBy('e_post.id');
            $query->where('e_post.id', '=', $id);

            return $query->get()[0];
        } catch (\Exception $e) {
            return;
        }
    }
}
