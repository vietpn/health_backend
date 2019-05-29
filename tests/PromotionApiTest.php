<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PromotionApiTest extends TestCase
{
    use MakePromotionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePromotion()
    {
        $promotion = $this->fakePromotionData();
        $this->json('POST', '/api/v1/promotions', $promotion);

        $this->assertApiResponse($promotion);
    }

    /**
     * @test
     */
    public function testReadPromotion()
    {
        $promotion = $this->makePromotion();
        $this->json('GET', '/api/v1/promotions/'.$promotion->id);

        $this->assertApiResponse($promotion->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePromotion()
    {
        $promotion = $this->makePromotion();
        $editedPromotion = $this->fakePromotionData();

        $this->json('PUT', '/api/v1/promotions/'.$promotion->id, $editedPromotion);

        $this->assertApiResponse($editedPromotion);
    }

    /**
     * @test
     */
    public function testDeletePromotion()
    {
        $promotion = $this->makePromotion();
        $this->json('DELETE', '/api/v1/promotions/'.$promotion->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/promotions/'.$promotion->id);

        $this->assertResponseStatus(404);
    }
}
