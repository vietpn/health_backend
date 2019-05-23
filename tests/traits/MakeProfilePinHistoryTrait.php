<?php

use Faker\Factory as Faker;
use App\Models\ProfilePinHistory;
use App\Repositories\ProfilePinHistoryRepository;

trait MakeProfilePinHistoryTrait
{
    /**
     * Create fake instance of ProfilePinHistory and save it in database
     *
     * @param array $profilePinHistoryFields
     * @return ProfilePinHistory
     */
    public function makeProfilePinHistory($profilePinHistoryFields = [])
    {
        /** @var ProfilePinHistoryRepository $profilePinHistoryRepo */
        $profilePinHistoryRepo = App::make(ProfilePinHistoryRepository::class);
        $theme = $this->fakeProfilePinHistoryData($profilePinHistoryFields);
        return $profilePinHistoryRepo->create($theme);
    }

    /**
     * Get fake instance of ProfilePinHistory
     *
     * @param array $profilePinHistoryFields
     * @return ProfilePinHistory
     */
    public function fakeProfilePinHistory($profilePinHistoryFields = [])
    {
        return new ProfilePinHistory($this->fakeProfilePinHistoryData($profilePinHistoryFields));
    }

    /**
     * Get fake data of ProfilePinHistory
     *
     * @param array $postFields
     * @return array
     */
    public function fakeProfilePinHistoryData($profilePinHistoryFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'profile_id' => $fake->randomDigitNotNull,
            'pin_id' => $fake->randomDigitNotNull,
            'post_id' => $fake->randomDigitNotNull,
            'point' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s')
        ], $profilePinHistoryFields);
    }
}
