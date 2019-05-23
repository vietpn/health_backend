<?php

use App\Models\Pin;
use App\Repositories\PinRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PinRepositoryTest extends TestCase
{
    use MakePinTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PinRepository
     */
    protected $pinRepo;

    public function setUp()
    {
        parent::setUp();
        $this->pinRepo = App::make(PinRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePin()
    {
        $pin = $this->fakePinData();
        $createdPin = $this->pinRepo->create($pin);
        $createdPin = $createdPin->toArray();
        $this->assertArrayHasKey('id', $createdPin);
        $this->assertNotNull($createdPin['id'], 'Created Pin must have id specified');
        $this->assertNotNull(Pin::find($createdPin['id']), 'Pin with given id must be in DB');
        $this->assertModelData($pin, $createdPin);
    }

    /**
     * @test read
     */
    public function testReadPin()
    {
        $pin = $this->makePin();
        $dbPin = $this->pinRepo->find($pin->id);
        $dbPin = $dbPin->toArray();
        $this->assertModelData($pin->toArray(), $dbPin);
    }

    /**
     * @test update
     */
    public function testUpdatePin()
    {
        $pin = $this->makePin();
        $fakePin = $this->fakePinData();
        $updatedPin = $this->pinRepo->update($fakePin, $pin->id);
        $this->assertModelData($fakePin, $updatedPin->toArray());
        $dbPin = $this->pinRepo->find($pin->id);
        $this->assertModelData($fakePin, $dbPin->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePin()
    {
        $pin = $this->makePin();
        $resp = $this->pinRepo->delete($pin->id);
        $this->assertTrue($resp);
        $this->assertNull(Pin::find($pin->id), 'Pin should not exist in DB');
    }
}
