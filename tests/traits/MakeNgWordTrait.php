<?php

use Faker\Factory as Faker;
use App\Models\NgWord;
use App\Repositories\NgWordRepository;

trait MakeNgWordTrait
{
    /**
     * Create fake instance of NgWord and save it in database
     *
     * @param array $ngWordFields
     * @return NgWord
     */
    public function makeNgWord($ngWordFields = [])
    {
        /** @var NgWordRepository $ngWordRepo */
        $ngWordRepo = App::make(NgWordRepository::class);
        $theme = $this->fakeNgWordData($ngWordFields);
        return $ngWordRepo->create($theme);
    }

    /**
     * Get fake instance of NgWord
     *
     * @param array $ngWordFields
     * @return NgWord
     */
    public function fakeNgWord($ngWordFields = [])
    {
        return new NgWord($this->fakeNgWordData($ngWordFields));
    }

    /**
     * Get fake data of NgWord
     *
     * @param array $postFields
     * @return array
     */
    public function fakeNgWordData($ngWordFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'word' => $fake->word,
            'pronounce' => $fake->word,
            'description' => $fake->word,
            'status' => $fake->word,
            'created_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_id' => $fake->randomDigitNotNull,
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $ngWordFields);
    }
}
