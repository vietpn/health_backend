<?php

use App\Models\IapAndroid;
use App\Repositories\IapAndroidRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class IapAndroidRepositoryTest extends TestCase
{
    use MakeIapAndroidTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var IapAndroidRepository
     */
    protected $iapAndroidRepo;

    public function setUp()
    {
        parent::setUp();
        $this->iapAndroidRepo = App::make(IapAndroidRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateIapAndroid()
    {
        $iapAndroid = $this->fakeIapAndroidData();
        $createdIapAndroid = $this->iapAndroidRepo->create($iapAndroid);
        $createdIapAndroid = $createdIapAndroid->toArray();
        $this->assertArrayHasKey('id', $createdIapAndroid);
        $this->assertNotNull($createdIapAndroid['id'], 'Created IapAndroid must have id specified');
        $this->assertNotNull(IapAndroid::find($createdIapAndroid['id']), 'IapAndroid with given id must be in DB');
        $this->assertModelData($iapAndroid, $createdIapAndroid);
    }

    /**
     * @test read
     */
    public function testReadIapAndroid()
    {
        $iapAndroid = $this->makeIapAndroid();
        $dbIapAndroid = $this->iapAndroidRepo->find($iapAndroid->id);
        $dbIapAndroid = $dbIapAndroid->toArray();
        $this->assertModelData($iapAndroid->toArray(), $dbIapAndroid);
    }

    /**
     * @test update
     */
    public function testUpdateIapAndroid()
    {
        $iapAndroid = $this->makeIapAndroid();
        $fakeIapAndroid = $this->fakeIapAndroidData();
        $updatedIapAndroid = $this->iapAndroidRepo->update($fakeIapAndroid, $iapAndroid->id);
        $this->assertModelData($fakeIapAndroid, $updatedIapAndroid->toArray());
        $dbIapAndroid = $this->iapAndroidRepo->find($iapAndroid->id);
        $this->assertModelData($fakeIapAndroid, $dbIapAndroid->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteIapAndroid()
    {
        $iapAndroid = $this->makeIapAndroid();
        $resp = $this->iapAndroidRepo->delete($iapAndroid->id);
        $this->assertTrue($resp);
        $this->assertNull(IapAndroid::find($iapAndroid->id), 'IapAndroid should not exist in DB');
    }
}
