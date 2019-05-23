<?php

use Faker\Factory as Faker;
use App\Models\ProfileBussines;
use App\Repositories\ShopRepository;

trait MakeShopTrait
{
    /**
     * Create fake instance of Shop and save it in database
     *
     * @param array $shopFields
     * @return ProfileBussines
     */
    public function makeShop($shopFields = [])
    {
        /** @var ShopRepository $shopRepo */
        $shopRepo = App::make(ShopRepository::class);
        $theme = $this->fakeShopData($shopFields);
        return $shopRepo->create($theme);
    }

    /**
     * Get fake instance of Shop
     *
     * @param array $shopFields
     * @return ProfileBussines
     */
    public function fakeShop($shopFields = [])
    {
        return new ProfileBussines($this->fakeShopData($shopFields));
    }

    /**
     * Get fake data of Shop
     *
     * @param array $postFields
     * @return array
     */
    public function fakeShopData($shopFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'profile_id' => $fake->randomDigitNotNull,
            'name' => $fake->word,
            'avatar' => $fake->word,
            'hyperlink' => $fake->word,
            'bussines_type_id' => $fake->randomDigitNotNull,
            'mobile' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_id' => $fake->randomDigitNotNull,
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $shopFields);
    }
}
