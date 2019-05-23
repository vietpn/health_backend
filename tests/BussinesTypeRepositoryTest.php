<?php

use App\Models\BussinesType;
use App\Repositories\BussinesTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BussinesTypeRepositoryTest extends TestCase
{
    use MakeBussinesTypeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var BussinesTypeRepository
     */
    protected $bussinesTypeRepo;

    public function setUp()
    {
        parent::setUp();
        $this->bussinesTypeRepo = App::make(BussinesTypeRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateBussinesType()
    {
        $bussinesType = $this->fakeBussinesTypeData();
        $createdBussinesType = $this->bussinesTypeRepo->create($bussinesType);
        $createdBussinesType = $createdBussinesType->toArray();
        $this->assertArrayHasKey('id', $createdBussinesType);
        $this->assertNotNull($createdBussinesType['id'], 'Created BussinesType must have id specified');
        $this->assertNotNull(BussinesType::find($createdBussinesType['id']), 'BussinesType with given id must be in DB');
        $this->assertModelData($bussinesType, $createdBussinesType);
    }

    /**
     * @test read
     */
    public function testReadBussinesType()
    {
        $bussinesType = $this->makeBussinesType();
        $dbBussinesType = $this->bussinesTypeRepo->find($bussinesType->id);
        $dbBussinesType = $dbBussinesType->toArray();
        $this->assertModelData($bussinesType->toArray(), $dbBussinesType);
    }

    /**
     * @test update
     */
    public function testUpdateBussinesType()
    {
        $bussinesType = $this->makeBussinesType();
        $fakeBussinesType = $this->fakeBussinesTypeData();
        $updatedBussinesType = $this->bussinesTypeRepo->update($fakeBussinesType, $bussinesType->id);
        $this->assertModelData($fakeBussinesType, $updatedBussinesType->toArray());
        $dbBussinesType = $this->bussinesTypeRepo->find($bussinesType->id);
        $this->assertModelData($fakeBussinesType, $dbBussinesType->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteBussinesType()
    {
        $bussinesType = $this->makeBussinesType();
        $resp = $this->bussinesTypeRepo->delete($bussinesType->id);
        $this->assertTrue($resp);
        $this->assertNull(BussinesType::find($bussinesType->id), 'BussinesType should not exist in DB');
    }
}
