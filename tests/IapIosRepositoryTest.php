<?php

use App\Models\IapIos;
use App\Repositories\IapIosRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class IapIosRepositoryTest extends TestCase
{
    use MakeIapIosTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var IapIosRepository
     */
    protected $iapIosRepo;

    public function setUp()
    {
        parent::setUp();
        $this->iapIosRepo = App::make(IapIosRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateIapIos()
    {
        $iapIos = $this->fakeIapIosData();
        $createdIapIos = $this->iapIosRepo->create($iapIos);
        $createdIapIos = $createdIapIos->toArray();
        $this->assertArrayHasKey('id', $createdIapIos);
        $this->assertNotNull($createdIapIos['id'], 'Created IapIos must have id specified');
        $this->assertNotNull(IapIos::find($createdIapIos['id']), 'IapIos with given id must be in DB');
        $this->assertModelData($iapIos, $createdIapIos);
    }

    /**
     * @test read
     */
    public function testReadIapIos()
    {
        $iapIos = $this->makeIapIos();
        $dbIapIos = $this->iapIosRepo->find($iapIos->id);
        $dbIapIos = $dbIapIos->toArray();
        $this->assertModelData($iapIos->toArray(), $dbIapIos);
    }

    /**
     * @test update
     */
    public function testUpdateIapIos()
    {
        $iapIos = $this->makeIapIos();
        $fakeIapIos = $this->fakeIapIosData();
        $updatedIapIos = $this->iapIosRepo->update($fakeIapIos, $iapIos->id);
        $this->assertModelData($fakeIapIos, $updatedIapIos->toArray());
        $dbIapIos = $this->iapIosRepo->find($iapIos->id);
        $this->assertModelData($fakeIapIos, $dbIapIos->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteIapIos()
    {
        $iapIos = $this->makeIapIos();
        $resp = $this->iapIosRepo->delete($iapIos->id);
        $this->assertTrue($resp);
        $this->assertNull(IapIos::find($iapIos->id), 'IapIos should not exist in DB');
    }
}
