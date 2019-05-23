<?php

use App\Models\CategoryItem;
use App\Repositories\CategoryItemRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryItemRepositoryTest extends TestCase
{
    use MakeCategoryItemTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CategoryItemRepository
     */
    protected $categoryItemRepo;

    public function setUp()
    {
        parent::setUp();
        $this->categoryItemRepo = App::make(CategoryItemRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateCategoryItem()
    {
        $categoryItem = $this->fakeCategoryItemData();
        $createdCategoryItem = $this->categoryItemRepo->create($categoryItem);
        $createdCategoryItem = $createdCategoryItem->toArray();
        $this->assertArrayHasKey('id', $createdCategoryItem);
        $this->assertNotNull($createdCategoryItem['id'], 'Created CategoryItem must have id specified');
        $this->assertNotNull(CategoryItem::find($createdCategoryItem['id']), 'CategoryItem with given id must be in DB');
        $this->assertModelData($categoryItem, $createdCategoryItem);
    }

    /**
     * @test read
     */
    public function testReadCategoryItem()
    {
        $categoryItem = $this->makeCategoryItem();
        $dbCategoryItem = $this->categoryItemRepo->find($categoryItem->id);
        $dbCategoryItem = $dbCategoryItem->toArray();
        $this->assertModelData($categoryItem->toArray(), $dbCategoryItem);
    }

    /**
     * @test update
     */
    public function testUpdateCategoryItem()
    {
        $categoryItem = $this->makeCategoryItem();
        $fakeCategoryItem = $this->fakeCategoryItemData();
        $updatedCategoryItem = $this->categoryItemRepo->update($fakeCategoryItem, $categoryItem->id);
        $this->assertModelData($fakeCategoryItem, $updatedCategoryItem->toArray());
        $dbCategoryItem = $this->categoryItemRepo->find($categoryItem->id);
        $this->assertModelData($fakeCategoryItem, $dbCategoryItem->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteCategoryItem()
    {
        $categoryItem = $this->makeCategoryItem();
        $resp = $this->categoryItemRepo->delete($categoryItem->id);
        $this->assertTrue($resp);
        $this->assertNull(CategoryItem::find($categoryItem->id), 'CategoryItem should not exist in DB');
    }
}
