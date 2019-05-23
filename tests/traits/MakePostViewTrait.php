<?php

use Faker\Factory as Faker;
use App\Models\V2\PostView;
use App\Repositories\V2\PostViewRepository;

trait MakePostViewTrait
{
    /**
     * Create fake instance of PostView and save it in database
     *
     * @param array $postViewFields
     * @return PostView
     */
    public function makePostView($postViewFields = [])
    {
        /** @var PostViewRepository $postViewRepo */
        $postViewRepo = App::make(PostViewRepository::class);
        $theme = $this->fakePostViewData($postViewFields);
        return $postViewRepo->create($theme);
    }

    /**
     * Get fake instance of PostView
     *
     * @param array $postViewFields
     * @return PostView
     */
    public function fakePostView($postViewFields = [])
    {
        return new PostView($this->fakePostViewData($postViewFields));
    }

    /**
     * Get fake data of PostView
     *
     * @param array $postFields
     * @return array
     */
    public function fakePostViewData($postViewFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'profile_id' => $fake->randomDigitNotNull,
            'post_id' => $fake->randomDigitNotNull,
            'is_deleted' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $postViewFields);
    }
}
