<?php

namespace App\Repositories\Api;

use App\Define\Systems;
use App\Models\PostComment;
use InfyOm\Generator\Common\BaseRepository;

class PostCommentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'profile_id',
        'post_id',
        'photo',
        'content',
        'is_deleted',
        'created_at',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PostComment::class;
    }

    /**
     * @inheritdoc
     */
    public function create(array $attributes)
    {
        $image = $attributes['photo'];
        if (isset($image)) {

                $file = 'comment/photo' . DIRECTORY_SEPARATOR . date("Y/m/d/H");
                $avatar_name = $attributes['post_id'] . time() . '.jpg';
                $avatar_path = Systems::uploadBasse64($image, $file, $avatar_name);
                if ($avatar_path) {
                    $attributes['photo'] = $avatar_path;
                }
        }
//        if (!empty($attributes['photo'])) {
//            $photo_path = Systems::uploadPhoto(
//                $attributes['photo'],
//                'comment/photo' . DIRECTORY_SEPARATOR . date("Y/m/d/H")
//            );
//            $attributes['photo'] = ($photo_path) ? $photo_path : null;
//        }

        return parent::create($attributes);
    }

    /**
     * @inheritdoc
     */
    public function update(array $attributes, $id)
    {
        if (!empty($attributes['photo'])) {
            $photo_path = Systems::uploadPhoto(
                $attributes['photo'],
                'comment/photo' . DIRECTORY_SEPARATOR . date("Y/m/d/H")
            );
            $attributes['photo'] = ($photo_path) ? $photo_path : null;
        }

        return parent::update($attributes, $id);
    }
}
