<?php

use Faker\Factory as Faker;
use App\Models\CategoryItem;
use App\Repositories\CategoryItemRepository;

trait MakeCategoryItemTrait
{
    /**
     * Create fake instance of CategoryItem and save it in database
     *
     * @param array $categoryItemFields
     * @return CategoryItem
     */
    public function makeCategoryItem($categoryItemFields = [])
    {
        /** @var CategoryItemRepository $categoryItemRepo */
        $categoryItemRepo = App::make(CategoryItemRepository::class);
        $theme = $this->fakeCategoryItemData($categoryItemFields);
        return $categoryItemRepo->create($theme);
    }

    /**
     * Get fake instance of CategoryItem
     *
     * @param array $categoryItemFields
     * @return CategoryItem
     */
    public function fakeCategoryItem($categoryItemFields = [])
    {
        return new CategoryItem($this->fakeCategoryItemData($categoryItemFields));
    }

    /**
     * Get fake data of CategoryItem
     *
     * @param array $postFields
     * @return array
     */
    public function fakeCategoryItemData($categoryItemFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'title' => $fake->word,
            'avatar' => $fake->word,
            'status' => $fake->word,
            'sort_order' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'created_id' => $fake->randomDigitNotNull,
            'updated_id' => $fake->randomDigitNotNull
        ], $categoryItemFields);
    }
}
