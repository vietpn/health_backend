<?php

use App\Models\ProfileCostume;
use App\Repositories\ProfileCostumeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProfileCostumeRepositoryTest extends TestCase
{
    use MakeProfileCostumeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProfileCostumeRepository
     */
    protected $profileCostumeRepo;

    public function setUp()
    {
        parent::setUp();
        $this->profileCostumeRepo = App::make(ProfileCostumeRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateProfileCostume()
    {
        $profileCostume = $this->fakeProfileCostumeData();
        $createdProfileCostume = $this->profileCostumeRepo->create($profileCostume);
        $createdProfileCostume = $createdProfileCostume->toArray();
        $this->assertArrayHasKey('id', $createdProfileCostume);
        $this->assertNotNull($createdProfileCostume['id'], 'Created ProfileCostume must have id specified');
        $this->assertNotNull(ProfileCostume::find($createdProfileCostume['id']), 'ProfileCostume with given id must be in DB');
        $this->assertModelData($profileCostume, $createdProfileCostume);
    }

    /**
     * @test read
     */
    public function testReadProfileCostume()
    {
        $profileCostume = $this->makeProfileCostume();
        $dbProfileCostume = $this->profileCostumeRepo->find($profileCostume->id);
        $dbProfileCostume = $dbProfileCostume->toArray();
        $this->assertModelData($profileCostume->toArray(), $dbProfileCostume);
    }

    /**
     * @test update
     */
    public function testUpdateProfileCostume()
    {
        $profileCostume = $this->makeProfileCostume();
        $fakeProfileCostume = $this->fakeProfileCostumeData();
        $updatedProfileCostume = $this->profileCostumeRepo->update($fakeProfileCostume, $profileCostume->id);
        $this->assertModelData($fakeProfileCostume, $updatedProfileCostume->toArray());
        $dbProfileCostume = $this->profileCostumeRepo->find($profileCostume->id);
        $this->assertModelData($fakeProfileCostume, $dbProfileCostume->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteProfileCostume()
    {
        $profileCostume = $this->makeProfileCostume();
        $resp = $this->profileCostumeRepo->delete($profileCostume->id);
        $this->assertTrue($resp);
        $this->assertNull(ProfileCostume::find($profileCostume->id), 'ProfileCostume should not exist in DB');
    }
}
