<?php

use Faker\Factory as Faker;
use App\Models\ProfileCostume;
use App\Repositories\ProfileCostumeRepository;

trait MakeProfileCostumeTrait
{
    /**
     * Create fake instance of ProfileCostume and save it in database
     *
     * @param array $profileCostumeFields
     * @return ProfileCostume
     */
    public function makeProfileCostume($profileCostumeFields = [])
    {
        /** @var ProfileCostumeRepository $profileCostumeRepo */
        $profileCostumeRepo = App::make(ProfileCostumeRepository::class);
        $theme = $this->fakeProfileCostumeData($profileCostumeFields);
        return $profileCostumeRepo->create($theme);
    }

    /**
     * Get fake instance of ProfileCostume
     *
     * @param array $profileCostumeFields
     * @return ProfileCostume
     */
    public function fakeProfileCostume($profileCostumeFields = [])
    {
        return new ProfileCostume($this->fakeProfileCostumeData($profileCostumeFields));
    }

    /**
     * Get fake data of ProfileCostume
     *
     * @param array $postFields
     * @return array
     */
    public function fakeProfileCostumeData($profileCostumeFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'id' => $fake->randomDigitNotNull,
            'profile_id' => $fake->randomDigitNotNull,
            'item_ids' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $profileCostumeFields);
    }
}
