<?php

use App\Models\ProfilePinHistory;
use App\Repositories\ProfilePinHistoryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProfilePinHistoryRepositoryTest extends TestCase
{
    use MakeProfilePinHistoryTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProfilePinHistoryRepository
     */
    protected $profilePinHistoryRepo;

    public function setUp()
    {
        parent::setUp();
        $this->profilePinHistoryRepo = App::make(ProfilePinHistoryRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateProfilePinHistory()
    {
        $profilePinHistory = $this->fakeProfilePinHistoryData();
        $createdProfilePinHistory = $this->profilePinHistoryRepo->create($profilePinHistory);
        $createdProfilePinHistory = $createdProfilePinHistory->toArray();
        $this->assertArrayHasKey('id', $createdProfilePinHistory);
        $this->assertNotNull($createdProfilePinHistory['id'], 'Created ProfilePinHistory must have id specified');
        $this->assertNotNull(ProfilePinHistory::find($createdProfilePinHistory['id']), 'ProfilePinHistory with given id must be in DB');
        $this->assertModelData($profilePinHistory, $createdProfilePinHistory);
    }

    /**
     * @test read
     */
    public function testReadProfilePinHistory()
    {
        $profilePinHistory = $this->makeProfilePinHistory();
        $dbProfilePinHistory = $this->profilePinHistoryRepo->find($profilePinHistory->id);
        $dbProfilePinHistory = $dbProfilePinHistory->toArray();
        $this->assertModelData($profilePinHistory->toArray(), $dbProfilePinHistory);
    }

    /**
     * @test update
     */
    public function testUpdateProfilePinHistory()
    {
        $profilePinHistory = $this->makeProfilePinHistory();
        $fakeProfilePinHistory = $this->fakeProfilePinHistoryData();
        $updatedProfilePinHistory = $this->profilePinHistoryRepo->update($fakeProfilePinHistory, $profilePinHistory->id);
        $this->assertModelData($fakeProfilePinHistory, $updatedProfilePinHistory->toArray());
        $dbProfilePinHistory = $this->profilePinHistoryRepo->find($profilePinHistory->id);
        $this->assertModelData($fakeProfilePinHistory, $dbProfilePinHistory->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteProfilePinHistory()
    {
        $profilePinHistory = $this->makeProfilePinHistory();
        $resp = $this->profilePinHistoryRepo->delete($profilePinHistory->id);
        $this->assertTrue($resp);
        $this->assertNull(ProfilePinHistory::find($profilePinHistory->id), 'ProfilePinHistory should not exist in DB');
    }
}
