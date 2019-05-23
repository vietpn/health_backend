<?php

use Faker\Factory as Faker;
use App\Models\Pin;
use App\Repositories\PinRepository;

trait MakePinTrait
{
    /**
     * Create fake instance of Pin and save it in database
     *
     * @param array $pinFields
     * @return Pin
     */
    public function makePin($pinFields = [])
    {
        /** @var PinRepository $pinRepo */
        $pinRepo = App::make(PinRepository::class);
        $theme = $this->fakePinData($pinFields);
        return $pinRepo->create($theme);
    }

    /**
     * Get fake instance of Pin
     *
     * @param array $pinFields
     * @return Pin
     */
    public function fakePin($pinFields = [])
    {
        return new Pin($this->fakePinData($pinFields));
    }

    /**
     * Get fake data of Pin
     *
     * @param array $postFields
     * @return array
     */
    public function fakePinData($pinFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'avatar' => $fake->word,
            'point' => $fake->randomDigitNotNull,
            'status' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'created_id' => $fake->randomDigitNotNull
        ], $pinFields);
    }
}
