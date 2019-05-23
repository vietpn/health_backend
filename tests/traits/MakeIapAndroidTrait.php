<?php

use Faker\Factory as Faker;
use App\Models\IapAndroid;
use App\Repositories\IapAndroidRepository;

trait MakeIapAndroidTrait
{
    /**
     * Create fake instance of IapAndroid and save it in database
     *
     * @param array $iapAndroidFields
     * @return IapAndroid
     */
    public function makeIapAndroid($iapAndroidFields = [])
    {
        /** @var IapAndroidRepository $iapAndroidRepo */
        $iapAndroidRepo = App::make(IapAndroidRepository::class);
        $theme = $this->fakeIapAndroidData($iapAndroidFields);
        return $iapAndroidRepo->create($theme);
    }

    /**
     * Get fake instance of IapAndroid
     *
     * @param array $iapAndroidFields
     * @return IapAndroid
     */
    public function fakeIapAndroid($iapAndroidFields = [])
    {
        return new IapAndroid($this->fakeIapAndroidData($iapAndroidFields));
    }

    /**
     * Get fake data of IapAndroid
     *
     * @param array $postFields
     * @return array
     */
    public function fakeIapAndroidData($iapAndroidFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'product_id' => $fake->word,
            'avatar' => $fake->word,
            'display_name' => $fake->word,
            'package' => $fake->word,
            'description' => $fake->word,
            'price' => $fake->randomDigitNotNull,
            'point' => $fake->randomDigitNotNull,
            'status' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'created_id' => $fake->randomDigitNotNull,
            'updated_id' => $fake->randomDigitNotNull
        ], $iapAndroidFields);
    }
}
