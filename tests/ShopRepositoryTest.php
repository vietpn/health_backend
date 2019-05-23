<?php

use App\Models\ProfileBussines;
use App\Repositories\ShopRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShopRepositoryTest extends TestCase
{
    use MakeShopTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ShopRepository
     */
    protected $shopRepo;

    public function setUp()
    {
        parent::setUp();
        $this->shopRepo = App::make(ShopRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateShop()
    {
        $shop = $this->fakeShopData();
        $createdShop = $this->shopRepo->create($shop);
        $createdShop = $createdShop->toArray();
        $this->assertArrayHasKey('id', $createdShop);
        $this->assertNotNull($createdShop['id'], 'Created Shop must have id specified');
        $this->assertNotNull(ProfileBussines::find($createdShop['id']), 'Shop with given id must be in DB');
        $this->assertModelData($shop, $createdShop);
    }

    /**
     * @test read
     */
    public function testReadShop()
    {
        $shop = $this->makeShop();
        $dbShop = $this->shopRepo->find($shop->id);
        $dbShop = $dbShop->toArray();
        $this->assertModelData($shop->toArray(), $dbShop);
    }

    /**
     * @test update
     */
    public function testUpdateShop()
    {
        $shop = $this->makeShop();
        $fakeShop = $this->fakeShopData();
        $updatedShop = $this->shopRepo->update($fakeShop, $shop->id);
        $this->assertModelData($fakeShop, $updatedShop->toArray());
        $dbShop = $this->shopRepo->find($shop->id);
        $this->assertModelData($fakeShop, $dbShop->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteShop()
    {
        $shop = $this->makeShop();
        $resp = $this->shopRepo->delete($shop->id);
        $this->assertTrue($resp);
        $this->assertNull(ProfileBussines::find($shop->id), 'Shop should not exist in DB');
    }
}
