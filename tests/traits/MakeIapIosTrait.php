<?php

use Faker\Factory as Faker;
use App\Models\IapIos;
use App\Repositories\IapIosRepository;

trait MakeIapIosTrait
{
    /**
     * Create fake instance of IapIos and save it in database
     *
     * @param array $iapIosFields
     * @return IapIos
     */
    public function makeIapIos($iapIosFields = [])
    {
        /** @var IapIosRepository $iapIosRepo */
        $iapIosRepo = App::make(IapIosRepository::class);
        $theme = $this->fakeIapIosData($iapIosFields);
        return $iapIosRepo->create($theme);
    }

    /**
     * Get fake instance of IapIos
     *
     * @param array $iapIosFields
     * @return IapIos
     */
    public function fakeIapIos($iapIosFields = [])
    {
        return new IapIos($this->fakeIapIosData($iapIosFields));
    }

    /**
     * Get fake data of IapIos
     *
     * @param array $postFields
     * @return array
     */
    public function fakeIapIosData($iapIosFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'apple_id' => $fake->word,
            'product_id' => $fake->word,
            'avatar' => $fake->word,
            'display_name' => $fake->word,
            'description' => $fake->word,
            'price' => $fake->randomDigitNotNull,
            'point' => $fake->randomDigitNotNull,
            'status' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'created_id' => $fake->randomDigitNotNull,
            'updated_id' => $fake->randomDigitNotNull
        ], $iapIosFields);
    }
}
