<?php

use App\Models\Promotion;
use App\Repositories\PromotionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PromotionRepositoryTest extends TestCase
{
    use MakePromotionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PromotionRepository
     */
    protected $promotionRepo;

    public function setUp()
    {
        parent::setUp();
        $this->promotionRepo = App::make(PromotionRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePromotion()
    {
        $promotion = $this->fakePromotionData();
        $createdPromotion = $this->promotionRepo->create($promotion);
        $createdPromotion = $createdPromotion->toArray();
        $this->assertArrayHasKey('id', $createdPromotion);
        $this->assertNotNull($createdPromotion['id'], 'Created Promotion must have id specified');
        $this->assertNotNull(Promotion::find($createdPromotion['id']), 'Promotion with given id must be in DB');
        $this->assertModelData($promotion, $createdPromotion);
    }

    /**
     * @test read
     */
    public function testReadPromotion()
    {
        $promotion = $this->makePromotion();
        $dbPromotion = $this->promotionRepo->find($promotion->id);
        $dbPromotion = $dbPromotion->toArray();
        $this->assertModelData($promotion->toArray(), $dbPromotion);
    }

    /**
     * @test update
     */
    public function testUpdatePromotion()
    {
        $promotion = $this->makePromotion();
        $fakePromotion = $this->fakePromotionData();
        $updatedPromotion = $this->promotionRepo->update($fakePromotion, $promotion->id);
        $this->assertModelData($fakePromotion, $updatedPromotion->toArray());
        $dbPromotion = $this->promotionRepo->find($promotion->id);
        $this->assertModelData($fakePromotion, $dbPromotion->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePromotion()
    {
        $promotion = $this->makePromotion();
        $resp = $this->promotionRepo->delete($promotion->id);
        $this->assertTrue($resp);
        $this->assertNull(Promotion::find($promotion->id), 'Promotion should not exist in DB');
    }
}
