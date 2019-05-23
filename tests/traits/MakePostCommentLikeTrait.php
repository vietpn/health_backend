<?php

use Faker\Factory as Faker;
use App\Models\V2\PostCommentLike;
use App\Repositories\V2\PostCommentLikeRepository;

trait MakePostCommentLikeTrait
{
    /**
     * Create fake instance of PostCommentLike and save it in database
     *
     * @param array $postCommentLikeFields
     * @return PostCommentLike
     */
    public function makePostCommentLike($postCommentLikeFields = [])
    {
        /** @var PostCommentLikeRepository $postCommentLikeRepo */
        $postCommentLikeRepo = App::make(PostCommentLikeRepository::class);
        $theme = $this->fakePostCommentLikeData($postCommentLikeFields);
        return $postCommentLikeRepo->create($theme);
    }

    /**
     * Get fake instance of PostCommentLike
     *
     * @param array $postCommentLikeFields
     * @return PostCommentLike
     */
    public function fakePostCommentLike($postCommentLikeFields = [])
    {
        return new PostCommentLike($this->fakePostCommentLikeData($postCommentLikeFields));
    }

    /**
     * Get fake data of PostCommentLike
     *
     * @param array $postFields
     * @return array
     */
    public function fakePostCommentLikeData($postCommentLikeFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'profile_id' => $fake->randomDigitNotNull,
            'post_comment_id' => $fake->randomDigitNotNull,
            'is_deleted' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $postCommentLikeFields);
    }
}
