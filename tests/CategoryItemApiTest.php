<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryItemApiTest extends TestCase
{
    use MakeCategoryItemTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateCategoryItem()
    {
        $categoryItem = $this->fakeCategoryItemData();
        $this->json('POST', '/api/v1/categoryItems', $categoryItem);

        $this->assertApiResponse($categoryItem);
    }

    /**
     * @test
     */
    public function testReadCategoryItem()
    {
        $categoryItem = $this->makeCategoryItem();
        $this->json('GET', '/api/v1/categoryItems/'.$categoryItem->id);

        $this->assertApiResponse($categoryItem->toArray());
    }

    /**
     * @test
     */
    public function testUpdateCategoryItem()
    {
        $categoryItem = $this->makeCategoryItem();
        $editedCategoryItem = $this->fakeCategoryItemData();

        $this->json('PUT', '/api/v1/categoryItems/'.$categoryItem->id, $editedCategoryItem);

        $this->assertApiResponse($editedCategoryItem);
    }

    /**
     * @test
     */
    public function testDeleteCategoryItem()
    {
        $categoryItem = $this->makeCategoryItem();
        $this->json('DELETE', '/api/v1/categoryItems/'.$categoryItem->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/categoryItems/'.$categoryItem->id);

        $this->assertResponseStatus(404);
    }
}
