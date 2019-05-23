<?php

use Faker\Factory as Faker;
use App\Models\BussinesType;
use App\Repositories\BussinesTypeRepository;

trait MakeBussinesTypeTrait
{
    /**
     * Create fake instance of BussinesType and save it in database
     *
     * @param array $bussinesTypeFields
     * @return BussinesType
     */
    public function makeBussinesType($bussinesTypeFields = [])
    {
        /** @var BussinesTypeRepository $bussinesTypeRepo */
        $bussinesTypeRepo = App::make(BussinesTypeRepository::class);
        $theme = $this->fakeBussinesTypeData($bussinesTypeFields);
        return $bussinesTypeRepo->create($theme);
    }

    /**
     * Get fake instance of BussinesType
     *
     * @param array $bussinesTypeFields
     * @return BussinesType
     */
    public function fakeBussinesType($bussinesTypeFields = [])
    {
        return new BussinesType($this->fakeBussinesTypeData($bussinesTypeFields));
    }

    /**
     * Get fake data of BussinesType
     *
     * @param array $postFields
     * @return array
     */
    public function fakeBussinesTypeData($bussinesTypeFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'title' => $fake->word,
            'status' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'created_id' => $fake->randomDigitNotNull,
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'updated_id' => $fake->randomDigitNotNull
        ], $bussinesTypeFields);
    }
}
